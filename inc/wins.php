<?php
/**
 * Weekly Wins — local posts in production, cached REST feed on staging.
 *
 * On the source site, read the published category directly so deployment does
 * not depend on a migrated cache, WP-Cron or a loopback HTTP request. Elsewhere,
 * a daily job caches the remote category and preserves the last good copy.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

/**
 * Where the wins are pulled from. Filterable so a staging site can point
 * somewhere else without touching the theme.
 *
 * @return string Site root, no trailing slash.
 */
function successcircles_wins_source() {
	return (string) apply_filters( 'successcircles_wins_source', 'https://www.successcircles.com' );
}

/**
 * The category slug the wins live in.
 *
 * @return string
 */
function successcircles_wins_category() {
	return (string) apply_filters( 'successcircles_wins_category', 'weekly-wins' );
}

/**
 * The cached wins, newest first.
 *
 * Returns an empty array before the first successful sync — the template shows
 * its empty state rather than blocking the visitor on a network call.
 *
 * @return array<int, array{id:int, name:string, text:string, date:string, stamp:string}>
 */
function successcircles_wins() {
	if ( successcircles_wins_is_local() ) {
		return successcircles_wins_from_posts();
	}

	$wins = get_option( 'sc_wins', array() );

	if ( ! is_array( $wins ) || ! $wins ) {
		// Nothing cached yet: let cron do the fetching, out of this request.
		if ( ! wp_next_scheduled( 'sc_refresh_wins' ) ) {
			wp_schedule_single_event( time() + 30, 'sc_refresh_wins' );
		}

		return array();
	}

	return $wins;
}

/** The production site already owns these posts; do not request its own REST API. */
function successcircles_wins_is_local() {
	$source = strtolower( (string) wp_parse_url( successcircles_wins_source(), PHP_URL_HOST ) );
	$home = strtolower( (string) wp_parse_url( home_url(), PHP_URL_HOST ) );
	return $source && preg_replace( '/^www\./', '', $source ) === preg_replace( '/^www\./', '', $home );
}

/** Read the complete published archive directly, including category descendants. */
function successcircles_wins_from_posts() {
	$category = get_category_by_slug( successcircles_wins_category() );
	if ( ! $category ) { return array(); }
	$posts = get_posts( array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'has_password' => false,
		'posts_per_page' => -1,
		'cat' => $category->term_id,
		'orderby' => 'date',
		'order' => 'DESC',
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	) );
	$wins = array();
	foreach ( $posts as $post ) {
		$win = successcircles_wins_parse( array(
			'id' => $post->ID,
			'title' => array( 'rendered' => $post->post_title ),
			'content' => array( 'rendered' => strip_shortcodes( $post->post_content ) ),
			'date_gmt' => $post->post_date_gmt,
		) );
		if ( $win ) { $wins[] = $win; }
	}
	return $wins;
}

/**
 * When the cache was last filled.
 *
 * @return int Unix timestamp, 0 if never.
 */
function successcircles_wins_synced() {
	return (int) get_option( 'sc_wins_synced', 0 );
}

/**
 * Turn one REST post into a win, or null if it is not one.
 *
 * The live category is not tidy: titles vary between "Weekly Wins of Pete",
 * "Weekly Wins Tinah Jan 12" and the occasional post that is not a win at all
 * ("Holiday Party at St. Marks Comedy Club"), and roughly one in twelve has an
 * empty body. Anything that does not read as a member win is dropped rather
 * than published to the testimonials page.
 *
 * @param array<string, mixed> $post Decoded REST post.
 * @return array<string, mixed>|null
 */
function successcircles_wins_parse( $post ) {
	if ( empty( $post['id'] ) ) {
		return null;
	}

	$title = trim( html_entity_decode( wp_strip_all_tags( isset( $post['title']['rendered'] ) ? $post['title']['rendered'] : '' ), ENT_QUOTES, 'UTF-8' ) );
	$text  = isset( $post['content']['rendered'] ) ? $post['content']['rendered'] : '';
	$text  = trim( preg_replace( '/\s+/u', ' ', html_entity_decode( wp_strip_all_tags( $text ), ENT_QUOTES, 'UTF-8' ) ) );

	// A win with nothing in it is not a testimonial.
	if ( mb_strlen( $text ) < 10 ) {
		return null;
	}

	// Only posts that actually announce a win. Everything else in the category
	// is site news and has no business on this page.
	if ( ! preg_match( '/^\s*weekly\s+win[s]?\b[\s:,\x{2013}\x{2014}-]*(?:of|for|from|by)?\s*(.*)$/iu', $title, $match ) ) {
		return null;
	}

	$name = trim( $match[1] );

	// Titles usually end in the date the win was shared, sometimes behind a
	// connector: "Rahul Bohara last Feb 5", "Joseph Varghese on August 4".
	// Strip date then connector, repeatedly, until the name stops shrinking.
	// The separator before the month is REQUIRED. Without it the pattern eats
	// any name that merely starts with a month's letters — Marjah, Marc,
	// Marianne, Marybeth, Martin all vanished to "Mar" + [a-z]* until this bit.
	do {
		$before = $name;
		$name   = preg_replace( '/[\s,\x{2013}\x{2014}-]+(?:jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)[a-z]*\.?\s*\d{0,2}(?:st|nd|rd|th)?\s*,?\s*\d{0,4}\s*$/iu', '', $name );
		$name   = preg_replace( '/\s+(?:last|this|on|for|of|the|week|weeks|update|updates)\s*$/iu', '', $name );
		$name   = trim( $name, " \t\n\r\0\x0B-,\xE2\x80\x93\xE2\x80\x94" );
	} while ( $name !== $before );

	if ( '' === $name ) {
		return null;
	}

	$stamp = isset( $post['date_gmt'] ) ? strtotime( $post['date_gmt'] . ' GMT' ) : 0;

	return array(
		'id'    => (int) $post['id'],
		'name'  => $name,
		'text'  => $text,
		'date'  => $stamp ? date_i18n( (string) get_option( 'date_format' ), $stamp ) : '',
		'stamp' => (string) $stamp,
	);
}

/**
 * Resolve the category id for the wins slug.
 *
 * @return int|WP_Error
 */
function successcircles_wins_category_id() {
	$cached = (int) get_option( 'sc_wins_cat', 0 );

	if ( $cached ) {
		return $cached;
	}

	$response = wp_remote_get(
		add_query_arg(
			array(
				'slug'     => successcircles_wins_category(),
				'_fields'  => 'id,slug',
				'per_page' => 1,
			),
			successcircles_wins_source() . '/wp-json/wp/v2/categories'
		),
		array( 'timeout' => 15 )
	);

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );

	if ( ! is_array( $body ) || empty( $body[0]['id'] ) ) {
		return new WP_Error( 'sc_wins_category', __( 'The Weekly Wins category was not found on the source site.', 'successcircles' ) );
	}

	update_option( 'sc_wins_cat', (int) $body[0]['id'], false );

	return (int) $body[0]['id'];
}

/**
 * Pull every page of the category and replace the cache.
 *
 * All or nothing: a failure part way through leaves the previous cache intact
 * rather than publishing a half-empty page.
 *
 * @return int|WP_Error Number of wins stored, or the failure.
 */
function successcircles_refresh_wins() {
	if ( successcircles_wins_is_local() ) {
		$wins = successcircles_wins_from_posts();
		update_option( 'sc_wins', $wins, false );
		update_option( 'sc_wins_synced', time(), false );
		return count( $wins );
	}

	$category = successcircles_wins_category_id();

	if ( is_wp_error( $category ) ) {
		return $category;
	}

	$endpoint = successcircles_wins_source() . '/wp-json/wp/v2/posts';
	$wins     = array();
	$seen     = array();
	$page     = 1;
	$pages    = 1;

	// The category runs to several hundred posts; the cap is a guard against a
	// source site that starts reporting a runaway page count.
	$max = (int) apply_filters( 'successcircles_wins_max_pages', 12 );

	do {
		$response = wp_remote_get(
			add_query_arg(
				array(
					'categories' => $category,
					'per_page'   => 100,
					'page'       => $page,
					'orderby'    => 'date',
					'order'      => 'desc',
					'_fields'    => 'id,date_gmt,title,content',
				),
				$endpoint
			),
			array( 'timeout' => 25 )
		);

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$code = (int) wp_remote_retrieve_response_code( $response );

		if ( 200 !== $code ) {
			/* translators: 1: page number, 2: HTTP status code. */
			return new WP_Error( 'sc_wins_http', sprintf( __( 'Page %1$d of the Weekly Wins feed returned HTTP %2$d.', 'successcircles' ), $page, $code ) );
		}

		if ( 1 === $page ) {
			$pages = max( 1, (int) wp_remote_retrieve_header( $response, 'x-wp-totalpages' ) );
			$pages = min( $pages, $max );
		}

		$batch = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( ! is_array( $batch ) ) {
			return new WP_Error( 'sc_wins_body', __( 'The Weekly Wins feed did not return a list of posts.', 'successcircles' ) );
		}

		foreach ( $batch as $post ) {
			$win = successcircles_wins_parse( $post );

			if ( $win && ! isset( $seen[ $win['id'] ] ) ) {
				$seen[ $win['id'] ] = true;
				$wins[]             = $win;
			}
		}

		++$page;
	} while ( $page <= $pages );

	update_option( 'sc_wins', $wins, false );
	update_option( 'sc_wins_synced', time(), false );

	return count( $wins );
}
add_action( 'sc_refresh_wins', 'successcircles_refresh_wins' );

/**
 * Keep the daily refresh scheduled.
 *
 * @return void
 */
function successcircles_schedule_wins() {
	if ( successcircles_wins_is_local() ) { return; }
	if ( ! wp_next_scheduled( 'sc_refresh_wins' ) ) {
		wp_schedule_event( time() + HOUR_IN_SECONDS, 'daily', 'sc_refresh_wins' );
	}
}
add_action( 'init', 'successcircles_schedule_wins' );
add_action( 'after_switch_theme', 'successcircles_schedule_wins' );

/**
 * Stop the cron job when the theme is switched away.
 *
 * @return void
 */
function successcircles_unschedule_wins() {
	wp_clear_scheduled_hook( 'sc_refresh_wins' );
}
add_action( 'switch_theme', 'successcircles_unschedule_wins' );
