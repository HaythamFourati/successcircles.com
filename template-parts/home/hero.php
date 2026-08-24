<?php
/**
 * Hero: the single H1 for the homepage, plus the orbiting portrait.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_hero = (array) successcircles_content( 'hero', array() );

?>
<section class="sc-hero" aria-labelledby="sc-hero-title">
	<div class="sc-hero__col">
		<p class="sc-eyebrow sc-eyebrow--accent sc-rise" style="--sc-rise-delay:1s">
			<?php echo esc_html( $sc_hero['eyebrow'] ); ?>
		</p>

		<h1 id="sc-hero-title" class="sc-display sc-display--hero sc-hero__title sc-rise" style="--sc-rise-delay:1.08s">
			<?php echo successcircles_inline( $sc_hero['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</h1>

		<p class="sc-hero__lede sc-rise" style="--sc-rise-delay:1.16s">
			<?php echo esc_html( wp_specialchars_decode( $sc_hero['lede'] ) ); ?>
		</p>

		<div class="sc-actions sc-rise" style="--sc-rise-delay:1.24s">
			<a class="sc-btn sc-btn--primary" <?php successcircles_test_link_attrs(); ?>>
				<?php echo esc_html( $sc_hero['primary_cta'] ); ?>
			</a>
			<a class="sc-btn sc-btn--ghost" href="<?php echo successcircles_url( '#programs' ); ?>">
				<?php echo esc_html( $sc_hero['secondary_cta'] ); ?>
			</a>
		</div>

		<ul class="sc-hero__meta sc-rise" style="--sc-rise-delay:1.32s">
			<?php foreach ( (array) $sc_hero['meta'] as $sc_item ) : ?>
				<li><?php echo esc_html( $sc_item ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="sc-orbit">
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
				src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/hero-huddle.jpg' ); ?>"
				alt="<?php echo esc_attr( $sc_hero['image_alt'] ); ?>"
				width="1267"
				height="713"
				fetchpriority="high"
				decoding="async"
			>
		</figure>

		<div class="sc-orbit__badge">
			<p class="sc-orbit__badge-label"><?php echo esc_html( wp_specialchars_decode( $sc_hero['badge_label'] ) ); ?></p>
			<p class="sc-orbit__badge-text"><?php echo esc_html( $sc_hero['badge_text'] ); ?></p>
		</div>
	</div>
</section>
