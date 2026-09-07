<?php
/**
 * Testimonials: a featured member film, video gallery and member letters.
 * Uses the existing content tree and click-to-play video component.
 * @package SuccessCircles
 */
defined( 'ABSPATH' ) || exit;
$sc_copy = (array) successcircles_content( 'testimonials', array() );
$sc_films = (array) $sc_copy['videos'];
$sc_quotes = (array) $sc_copy['quotes'];
$sc_link = (array) $sc_copy['link'];
$sc_lead = array_shift( $sc_films );
get_header();
?>
<article class="tv-page">
<section class="sc-section tv-hero" aria-labelledby="tv-title">
	<div class="tv-hero__copy">
		<p class="tv-label"><?php esc_html_e( 'The people behind the progress', 'successcircles' ); ?></p>
		<h1 id="tv-title" class="sc-display"><?php echo successcircles_inline( $sc_copy['title'] ); ?></h1>
		<p class="tv-lede"><?php echo esc_html( wp_specialchars_decode( $sc_copy['lede'] ) ); ?></p>
		<div class="sc-actions">
			<?php if ( $sc_films ) : ?><a class="sc-btn sc-btn--primary" href="#member-films"><?php esc_html_e( 'Watch Member Stories', 'successcircles' ); ?></a><?php endif; ?>
			<?php if ( $sc_quotes ) : ?><a class="tv-text-link" href="#member-letters"><?php esc_html_e( 'Read Their Experiences', 'successcircles' ); ?> <span aria-hidden="true">↓</span></a><?php endif; ?>
		</div>
	</div>
	<?php if ( $sc_lead ) : ?>
		<div class="tv-feature">
			<div class="tv-feature__label"><span><?php echo esc_html( $sc_copy['eyebrow'] ); ?></span><span aria-hidden="true">↗</span></div>
			<?php get_template_part( 'template-parts/film', null, array( 'film' => $sc_lead, 'featured' => true ) ); ?>
		</div>
	<?php endif; ?>
</section>
<?php while ( have_posts() ) : the_post(); if ( trim( get_the_content() ) ) : ?>
<div class="sc-section tv-editorial"><div class="sc-prose"><?php the_content(); ?></div></div>
<?php endif; endwhile; ?>
<?php if ( $sc_films ) : ?>
<section id="member-films" class="sc-band--dark" aria-labelledby="tv-films-title">
	<div class="sc-section">
		<header class="tv-heading">
			<p class="tv-label"><?php echo esc_html( $sc_copy['films_eyebrow'] ); ?></p>
			<h2 id="tv-films-title" class="sc-display"><?php echo successcircles_inline( $sc_copy['films_title'] ); ?></h2>
			<p class="tv-lede"><?php echo esc_html( $sc_copy['films_note'] ); ?></p>
		</header>
		<div class="tv-gallery">
			<?php foreach ( $sc_films as $sc_film ) : ?>
				<?php get_template_part( 'template-parts/film', null, array( 'film' => $sc_film ) ); ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>
<?php if ( $sc_quotes ) : ?>
<section id="member-letters" class="sc-section tv-letters" aria-labelledby="tv-letters-title">
	<header class="tv-heading">
		<p class="tv-label"><?php echo esc_html( $sc_copy['written_eyebrow'] ); ?></p>
		<h2 id="tv-letters-title" class="sc-display"><?php echo successcircles_inline( $sc_copy['written_title'] ); ?></h2>
	</header>
	<div class="tv-quotes">
		<?php foreach ( $sc_quotes as $sc_index => $sc_quote ) : ?>
			<?php if ( 2 === $sc_index ) : ?>
				</div><details class="tv-more"><summary><?php esc_html_e( 'Read More Member Experiences', 'successcircles' ); ?><span aria-hidden="true">+</span></summary><div class="tv-quotes">
			<?php endif; ?>
			<figure class="tv-letter">
				<span class="tv-letter__mark" aria-hidden="true">“</span>
				<blockquote><?php echo esc_html( wp_specialchars_decode( $sc_quote['text'] ) ); ?></blockquote>
				<figcaption><strong><?php echo esc_html( $sc_quote['name'] ); ?></strong><?php if ( $sc_quote['role'] ) : ?><span><?php echo esc_html( wp_specialchars_decode( $sc_quote['role'] ) ); ?></span><?php endif; ?></figcaption>
			</figure>
		<?php endforeach; ?>
	</div>
	<?php if ( count( $sc_quotes ) > 2 ) : ?></details><?php endif; ?>
</section>
<?php endif; ?>
<aside class="tv-wins">
	<div class="sc-section">
		<div><p class="tv-label"><?php esc_html_e( 'Progress keeps happening', 'successcircles' ); ?></p><h2 class="sc-display"><?php esc_html_e( 'See what moved this week.', 'successcircles' ); ?></h2><p class="tv-lede"><?php esc_html_e( 'Explore the milestones, decisions, and everyday wins our members share along the way.', 'successcircles' ); ?></p></div>
		<a class="sc-btn sc-btn--ghost" href="<?php echo successcircles_url( $sc_link['url'] ); ?>"><?php echo esc_html( wp_specialchars_decode( $sc_link['label'] ) ); ?> <span aria-hidden="true">↗</span></a>
	</div>
</aside>
</article>
<?php get_template_part( 'template-parts/home/cta' ); ?>
<?php get_footer(); ?>
