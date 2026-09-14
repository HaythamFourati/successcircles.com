<?php
/**
 * Homepage hero with an inline Vimeo player inside the orbit.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_hero  = (array) successcircles_content( 'hero', array() );

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
			<a class="sc-btn sc-btn--primary" <?php successcircles_test_link_attrs( 'home_hero_test' ); ?>>
				<?php echo esc_html( $sc_hero['primary_cta'] ); ?>
			</a>
			<a class="sc-btn sc-btn--ghost" href="<?php echo esc_url( successcircles_page_link( 'home_hero_programs' ) ); ?>">
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

		<figure class="sc-orbit__figure sc-orbit__figure--video" data-sc-hero-video>
			<iframe
				class="sc-orbit__video"
				tabindex="-1"
				data-src="https://player.vimeo.com/video/1223972706?title=0&amp;byline=0&amp;portrait=0&amp;dnt=1&amp;autoplay=0&amp;controls=0&amp;playsinline=1"
				title="<?php esc_attr_e( 'Success Circles introduction video', 'successcircles' ); ?>"
				width="640"
				height="360"
				allow="autoplay; fullscreen; picture-in-picture; encrypted-media"
				allowfullscreen
			></iframe>
			<img class="sc-orbit__poster" <?php echo successcircles_responsive_source( 'story-poster.png', array( 480, 800, 1200 ), '(max-width: 999px) min(90vw, 420px), 420px' ); ?> alt="" width="1914" height="1075" fetchpriority="high">
			<button class="sc-orbit__toggle" type="button" aria-label="<?php esc_attr_e( 'Play introduction video', 'successcircles' ); ?>">
				<svg class="sc-orbit__icon-play" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 4v16l13-8z" fill="currentColor"/></svg>
				<svg class="sc-orbit__icon-pause" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 4h4v16H6zm8 0h4v16h-4z" fill="currentColor"/></svg>
			</button>
			<a class="sc-orbit__video-fallback" href="<?php echo esc_url( successcircles_page_link( 'home_hero_https_vimeo_com_1223972706' ) ); ?>" hidden>Watch on Vimeo</a>
			<noscript><a class="sc-orbit__video-fallback" href="<?php echo esc_url( successcircles_page_link( 'home_hero_https_vimeo_com_1223972706' ) ); ?>">Watch on Vimeo</a></noscript>
		</figure>

		<div class="sc-orbit__badge">
			<p class="sc-orbit__badge-text"><?php echo esc_html( $sc_hero['badge_text'] ); ?></p>
		</div>
	</div>
</section>
