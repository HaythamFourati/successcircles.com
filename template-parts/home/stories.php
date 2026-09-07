<?php
/**
 * 05 / Success stories.
 *
 * Quotes are the designed copy from inc/content.php, deliberately curated — the
 * live Weekly Wins feed drives the testimonials page only, so nothing external
 * can appear in the homepage's most-read section without review.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_stories = (array) successcircles_content( 'stories', array() );
$sc_video   = (array) $sc_stories['video'];
$sc_feature = (array) $sc_stories['feature_quote'];
$sc_quotes  = successcircles_testimonials( 2 );

// Combine the feature quote and compact quotes into one slider set.
$sc_all_quotes = array_merge( array( $sc_feature ), $sc_quotes );

?>
<section id="stories" class="sc-section" aria-labelledby="sc-stories-title">

	<div class="sc-section-head">
		<div>
			<?php successcircles_eyebrow( $sc_stories['index'], $sc_stories['eyebrow'] ); ?>
			<h2 id="sc-stories-title" class="sc-display sc-display--lg">
				<?php echo successcircles_inline( $sc_stories['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h2>
		</div>
	</div>

	<div class="sc-stories__feature">

		<figure class="sc-story-video">
			<div class="sc-story-video__frame">
				<button
					class="sc-story-video__trigger"
					type="button"
					data-sc-video="<?php echo esc_url( $sc_video['embed_url'] ); ?>"
					data-sc-video-title="<?php echo esc_attr( $sc_video['title'] ); ?>"
					aria-label="<?php echo esc_attr( sprintf( /* translators: %s: video title. */ __( 'Play: %s', 'successcircles' ), $sc_video['title'] ) ); ?>"
				>
					<img
						src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/story-poster.png' ); ?>"
						alt="<?php echo esc_attr( $sc_video['poster_alt'] ); ?>"
						width="1914"
						height="1075"
						loading="lazy"
						decoding="async"
					>
					<span class="sc-story-video__scrim" aria-hidden="true"></span>
					<span class="sc-story-video__ring" aria-hidden="true"></span>
					<span class="sc-story-video__disc" aria-hidden="true"></span>
					<span class="sc-story-video__tag" aria-hidden="true">
						<?php
						printf(
							/* translators: %s: duration. */
							esc_html__( 'Watch &nbsp;/&nbsp; %s', 'successcircles' ),
							esc_html( $sc_video['duration'] )
						);
						?>
					</span>
				</button>
			</div>
			<figcaption class="sc-story-video__caption">
				<?php echo esc_html( $sc_video['title'] ); ?> &nbsp;/&nbsp; <?php echo esc_html( $sc_video['duration'] ); ?>
			</figcaption>
		</figure>

		<div class="sc-reviews" data-sc-reviews>
			<span class="sc-reviews__mark" aria-hidden="true">
				<svg width="48" height="38" viewBox="0 0 48 38" fill="none" focusable="false">
					<path d="M0 38V21.6C0 15.2 1.3 9.9 3.9 5.7C6.5 1.5 10.3 -0.8 15.3 -1.2L16.8 4.2C13.4 5 10.8 6.6 9 9C7.2 11.4 6.3 14.5 6.3 18.3H14.4V38H0ZM31.2 38V21.6C31.2 15.2 32.5 9.9 35.1 5.7C37.7 1.5 41.5 -0.8 46.5 -1.2L48 4.2C44.6 5 42 6.6 40.2 9C38.4 11.4 37.5 14.5 37.5 18.3H45.6V38H31.2Z" fill="currentColor"/>
				</svg>
			</span>

			<div class="sc-reviews__body">
				<button class="sc-reviews__arrow" type="button" data-sc-reviews-prev aria-label="<?php esc_attr_e( 'Previous review', 'successcircles' ); ?>">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true" focusable="false">
						<path d="M13 5L7 10l6 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</button>

				<div class="sc-reviews__track">
					<?php foreach ( $sc_all_quotes as $sc_index => $sc_quote ) : ?>
						<figure class="sc-reviews__slide" data-sc-reviews-slide="<?php echo esc_attr( (string) $sc_index ); ?>">
							<blockquote class="sc-reviews__text"><?php echo esc_html( wp_specialchars_decode( $sc_quote['text'] ) ); ?></blockquote>
							<figcaption class="sc-reviews__by">
								<span class="sc-reviews__rule" aria-hidden="true"></span>
								<span class="sc-reviews__name"><?php echo esc_html( $sc_quote['name'] ); ?></span>
								<span class="sc-reviews__role"><?php echo esc_html( $sc_quote['role'] ); ?></span>
							</figcaption>
						</figure>
					<?php endforeach; ?>
				</div>

				<button class="sc-reviews__arrow" type="button" data-sc-reviews-next aria-label="<?php esc_attr_e( 'Next review', 'successcircles' ); ?>">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true" focusable="false">
						<path d="M7 5l6 5-6 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</button>
			</div>
		</div>

	</div>

		<div class="sc-section-head__links">
			<?php foreach ( (array) $sc_stories['links'] as $sc_link ) : ?>
				<a class="sc-link-rule sc-link-rule--arrow" href="<?php echo successcircles_url( $sc_link['url'] ); ?>">
					<?php echo esc_html( wp_specialchars_decode( $sc_link['label'] ) ); ?>
					<svg class="sc-link-rule__arrow" width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true" focusable="false">
						<path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</a>
			<?php endforeach; ?>
		</div>
</section>
