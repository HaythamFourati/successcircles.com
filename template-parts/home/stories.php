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

?>
<section id="stories" class="sc-section" aria-labelledby="sc-stories-title">

	<div class="sc-section-head">
		<div>
			<?php successcircles_eyebrow( $sc_stories['index'], $sc_stories['eyebrow'] ); ?>
			<h2 id="sc-stories-title" class="sc-display sc-display--lg">
				<?php echo successcircles_inline( $sc_stories['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h2>
		</div>
		<div class="sc-section-head__links">
			<?php foreach ( (array) $sc_stories['links'] as $sc_link ) : ?>
				<a class="sc-link-rule" href="<?php echo successcircles_url( $sc_link['url'] ); ?>">
					<?php echo esc_html( wp_specialchars_decode( $sc_link['label'] ) ); ?>
				</a>
			<?php endforeach; ?>
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

		<figure class="sc-quote">
			<blockquote class="sc-quote__text"><?php echo esc_html( wp_specialchars_decode( $sc_feature['text'] ) ); ?></blockquote>
			<figcaption class="sc-quote__by">
				<span class="sc-quote__rule" aria-hidden="true"></span>
				<span class="sc-quote__name"><?php echo esc_html( $sc_feature['name'] ); ?></span>
				<span class="sc-quote__role"><?php echo esc_html( $sc_feature['role'] ); ?></span>
			</figcaption>
		</figure>

	</div>

	<div class="sc-stories__grid">
		<?php foreach ( $sc_quotes as $sc_quote ) : ?>
			<figure class="sc-quote sc-quote--compact">
				<blockquote class="sc-quote__text"><?php echo esc_html( wp_specialchars_decode( $sc_quote['text'] ) ); ?></blockquote>
				<figcaption class="sc-quote__by">
					<span class="sc-quote__rule" aria-hidden="true"></span>
					<span class="sc-quote__name"><?php echo esc_html( $sc_quote['name'] ); ?></span>
					<span class="sc-quote__role"><?php echo esc_html( $sc_quote['role'] ); ?></span>
				</figcaption>
			</figure>
		<?php endforeach; ?>
	</div>

</section>
