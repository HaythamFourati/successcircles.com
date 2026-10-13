<?php
/**
 * Trustpilot rating, kept current from Trustpilot's public TrustBox data.
 *
 * The account is on Trustpilot's free plan, which only unlocks the Review
 * Collector TrustBox — but that box's data endpoint still carries the live
 * TrustScore, star rating and review count. An hourly cron job stores them in
 * one option; the homepage only reads it, so nothing is fetched while rendering.
 * Review text is not in that payload (it needs a paid plan), so the cards
 * come from inc/trustpilot-reviews.json, pasted from the profile.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

/**
 * The current rating: cached live numbers over the content-tree defaults.
 *
 * @return array{score: float, stars: float, total: int, label: string}
 */
function successcircles_trustpilot() {
	$sc_defaults = (array) successcircles_content( 'trustpilot.fallback', array() );

	return wp_parse_args( (array) get_option( 'sc_trustpilot', array() ), $sc_defaults );
}

/**
 * Cron: pull the rating. A failed or empty response keeps the previous numbers.
 */
function successcircles_refresh_trustpilot() {
	$sc_url = add_query_arg(
		array(
			'businessUnitId' => successcircles_content( 'trustpilot.business_unit' ),
			'locale'         => 'en-US',
		),
		'https://widget.trustpilot.com/trustbox-data/' . successcircles_content( 'trustpilot.template' )
	);

	$sc_response = wp_remote_get( $sc_url, array( 'timeout' => 10 ) );

	if ( is_wp_error( $sc_response ) || 200 !== wp_remote_retrieve_response_code( $sc_response ) ) {
		return;
	}

	$sc_data = json_decode( wp_remote_retrieve_body( $sc_response ), true );
	$sc_unit = $sc_data['businessUnit'] ?? array();

	if ( empty( $sc_unit['numberOfReviews']['total'] ) ) {
		return;
	}

	update_option(
		'sc_trustpilot',
		array(
			'score' => (float) $sc_unit['trustScore'],
			'stars' => (float) $sc_unit['stars'],
			'total' => (int) $sc_unit['numberOfReviews']['total'],
			'label' => sanitize_text_field( $sc_data['starsString'] ?? '' ),
		),
		false
	);
}
add_action( 'sc_refresh_trustpilot', 'successcircles_refresh_trustpilot' );

/**
 * Keep the hourly refresh scheduled; stop it when the theme is switched away.
 */
function successcircles_schedule_trustpilot() {
	if ( ! wp_next_scheduled( 'sc_refresh_trustpilot' ) ) {
		wp_schedule_event( time() + 60, 'hourly', 'sc_refresh_trustpilot' );
	}
}
add_action( 'init', 'successcircles_schedule_trustpilot' );

function successcircles_unschedule_trustpilot() {
	wp_clear_scheduled_hook( 'sc_refresh_trustpilot' );
}
add_action( 'switch_theme', 'successcircles_unschedule_trustpilot' );

/**
 * The Trustpilot reviews, newest first, from inc/trustpilot-reviews.json — a
 * paste of the profile (review text is not available on the free plan). Add a
 * new review to the top of that file's `reviews` array.
 *
 * @return array<int, array{name: string, title: string, text: string, rating: int, date: int}>
 */
function successcircles_trustpilot_reviews() {
	$sc_data    = json_decode( (string) file_get_contents( __DIR__ . '/trustpilot-reviews.json' ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	$sc_reviews = array();

	foreach ( (array) ( $sc_data['reviews'] ?? array() ) as $sc_review ) {
		$sc_reviews[] = array(
			'name'   => (string) $sc_review['reviewer'],
			'title'  => (string) $sc_review['title'],
			'text'   => (string) $sc_review['text'],
			'rating' => (int) $sc_review['rating'],
			'date'   => (int) strtotime( $sc_review['date'] ),
		);
	}

	usort(
		$sc_reviews,
		static function ( $a, $b ) {
			return $b['date'] - $a['date'];
		}
	);

	return $sc_reviews;
}

/**
 * Trustpilot-style star row: green squares, filled to the rating.
 *
 * @param float  $rating Rating out of 5.
 * @param string $class  Extra class.
 */
function successcircles_trustpilot_stars( $rating, $class = '' ) {
	$sc_star = '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 2.5l2.8 6.6 7.1.6-5.4 4.7 1.6 7L12 17.7l-6.1 3.7 1.6-7-5.4-4.7 7.1-.6z"/></svg>';

	printf(
		'<span class="sc-tpw__stars %1$s" role="img" aria-label="%2$s">',
		esc_attr( $class ),
		/* translators: %s: star rating, e.g. 4.5 */
		esc_attr( sprintf( __( 'Rated %s out of 5 stars', 'successcircles' ), $rating ) )
	);

	for ( $sc_i = 0; $sc_i < 5; $sc_i++ ) {
		$sc_fill = max( 0, min( 1, $rating - $sc_i ) ) * 100;
		printf( '<span class="sc-tpw__star" style="--sc-tp-fill:%1$s%%">%2$s</span>', esc_attr( $sc_fill ), $sc_star ); // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG.
	}

	echo '</span>';
}
