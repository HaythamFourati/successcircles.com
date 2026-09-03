<?php
/**
 * Hero: the single H1 for the homepage, plus the orbiting portrait.
 *
 * The portrait doubles as a play surface for the same film the Success stories
 * section carries — the video data is read straight from `stories.video`, so the
 * two can never drift apart. Nothing is requested from Vimeo until the visitor
 * presses play; the iframe is built into the dialog on open and removed again on
 * close, which is also what stops playback. With JavaScript off the play control
 * is an ordinary link down to the stories section, where the same film lives.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_hero  = (array) successcircles_content( 'hero', array() );
$sc_video = (array) successcircles_content( 'stories.video', array() );

?>
<section class="sc-hero" aria-labelledby="sc-hero-title">
	<div class="sc-hero__col">
		<p class="sc-eyebrow sc-eyebrow--accent sc-rise" style="--sc-rise-delay:.4s">
			<?php echo esc_html( $sc_hero['eyebrow'] ); ?>
		</p>

		<h1 id="sc-hero-title" class="sc-display sc-display--hero sc-hero__title sc-rise" style="--sc-rise-delay:.48s">
			<?php echo successcircles_inline( $sc_hero['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</h1>

		<p class="sc-hero__lede sc-rise" style="--sc-rise-delay:.56s">
			<?php echo esc_html( wp_specialchars_decode( $sc_hero['lede'] ) ); ?>
		</p>

		<div class="sc-actions sc-rise" style="--sc-rise-delay:.64s">
			<a class="sc-btn sc-btn--primary" <?php successcircles_test_link_attrs(); ?>>
				<?php echo esc_html( $sc_hero['primary_cta'] ); ?>
			</a>
			<a class="sc-btn sc-btn--ghost" href="<?php echo successcircles_url( '#programs' ); ?>">
				<?php echo esc_html( $sc_hero['secondary_cta'] ); ?>
			</a>
		</div>

		<ul class="sc-hero__meta sc-rise" style="--sc-rise-delay:.72s">
			<?php foreach ( (array) $sc_hero['meta'] as $sc_item ) : ?>
				<li><?php echo esc_html( $sc_item ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="sc-orbit sc-rise" style="--sc-rise-delay:.48s">
		<div class="sc-orbit__rim" aria-hidden="true"></div>

		<div class="sc-orbit__track" aria-hidden="true">
			<span class="sc-orbit__dot sc-orbit__dot--a"></span>
			<span class="sc-orbit__dot sc-orbit__dot--b"></span>
		</div>

		<div class="sc-orbit__dash" aria-hidden="true"></div>

		<div class="sc-orbit__track sc-orbit__track--inner" aria-hidden="true">
			<span class="sc-orbit__dot sc-orbit__dot--c"></span>
			<span class="sc-orbit__dot sc-orbit__dot--d"></span>
		</div>

		<figure class="sc-orbit__figure">
			<img
				src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/hero-peer-call.jpg?v=' . successcircles_asset_version( '/assets/img/hero-peer-call.jpg' ) ); ?>"
				alt="<?php echo esc_attr( $sc_hero['image_alt'] ); ?>"
				width="1170"
				height="780"
				fetchpriority="high"
				decoding="async"
			>

			<?php if ( ! empty( $sc_video['embed_url'] ) ) : ?>
				<a
					class="sc-orbit__play"
					href="<?php echo successcircles_url( '#stories' ); ?>"
					data-sc-video="<?php echo esc_url( $sc_video['embed_url'] ); ?>"
					data-sc-video-title="<?php echo esc_attr( $sc_video['title'] ); ?>"
					data-sc-video-modal
					aria-label="<?php echo esc_attr( sprintf( /* translators: %s: video title. */ __( 'Play: %s', 'successcircles' ), $sc_video['title'] ) ); ?>"
				>
					<span class="sc-orbit__play-scrim" aria-hidden="true"></span>
					<span class="sc-orbit__play-ring" aria-hidden="true"></span>
					<span class="sc-orbit__play-disc" aria-hidden="true"></span>
				</a>
			<?php endif; ?>
		</figure>

		<div class="sc-orbit__badge">
			<p class="sc-orbit__badge-text"><?php echo esc_html( $sc_hero['badge_text'] ); ?></p>
		</div>
	</div>
</section>

<?php if ( ! empty( $sc_video['embed_url'] ) ) : ?>
	<dialog class="sc-video-modal" data-sc-video-dialog aria-label="<?php echo esc_attr( $sc_video['title'] ); ?>">
		<div class="sc-video-modal__panel">
			<button class="sc-video-modal__close" type="button" data-sc-video-close>
				<span class="sc-screen-reader-text"><?php esc_html_e( 'Close video', 'successcircles' ); ?></span>
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="sc-video-modal__frame" data-sc-video-mount></div>
			<p class="sc-video-modal__caption"><?php echo esc_html( $sc_video['title'] ); ?></p>
		</div>
	</dialog>
<?php endif; ?>
