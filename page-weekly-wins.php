<?php
/**
 * Weekly Wins: latest member dispatch and a paginated archive.
 * Reads the existing locally cached feed; never fetches during page rendering.
 * @package SuccessCircles
 */
defined( 'ABSPATH' ) || exit;
$sc_copy = (array) successcircles_content( 'buzz', array() );
$sc_link = (array) $sc_copy['link'];
$sc_wins = successcircles_wins();
$sc_lead = $sc_wins ? array_shift( $sc_wins ) : null;
$sc_per_page = 6;
$sc_pages = max( 1, (int) ceil( count( $sc_wins ) / $sc_per_page ) );
$sc_requested = isset( $_GET['wins_page'] ) && is_scalar( $_GET['wins_page'] ) ? absint( $_GET['wins_page'] ) : 1;
$sc_current = min( $sc_pages, max( 1, $sc_requested ) );
$sc_visible = array_slice( $sc_wins, ( $sc_current - 1 ) * $sc_per_page, $sc_per_page );
get_header();
?>
<article class="ww-page">
<section class="sc-section ww-hero" aria-labelledby="ww-title">
	<p class="ww-label"><?php echo esc_html( $sc_copy['eyebrow'] ); ?></p>
	<h1 id="ww-title" class="sc-display"><?php echo successcircles_inline( $sc_copy['title'] ); ?></h1>
	<p class="ww-lede"><?php echo esc_html( wp_specialchars_decode( $sc_copy['lede'] ) ); ?></p>
	<div class="sc-actions sc-actions--center">
		<?php if ( $sc_wins ) : ?><a class="sc-btn sc-btn--primary" href="<?php echo esc_url( successcircles_page_link( 'weekly_wins_wins' ) ); ?>"><?php esc_html_e( 'Explore Member Wins', 'successcircles' ); ?></a><?php endif; ?>
		<a class="ww-text-link" href="<?php echo successcircles_url( $sc_link['url'] ); ?>"><?php echo esc_html( wp_specialchars_decode( $sc_link['label'] ) ); ?><span aria-hidden="true">↗</span></a>
	</div>
	<?php while ( have_posts() ) : the_post(); if ( trim( get_the_content() ) ) : ?>
		<div class="sc-prose ww-intro"><?php the_content(); ?></div>
	<?php endif; endwhile; ?>
	<?php if ( $sc_lead && 1 === $sc_current ) : ?>
		<figure class="ww-feature">
			<div class="ww-feature__top"><span class="ww-label"><?php echo esc_html( $sc_copy['latest'] ); ?></span><span class="ww-date"><?php echo esc_html( $sc_lead['date'] ); ?></span></div>
			<span class="ww-quote-mark" aria-hidden="true">“</span>
			<blockquote><?php echo esc_html( $sc_lead['text'] ); ?></blockquote>
			<figcaption><span class="ww-member-mark" aria-hidden="true">↗</span><span><strong><?php echo esc_html( $sc_lead['name'] ); ?></strong><small><?php esc_html_e( 'In their own words', 'successcircles' ); ?></small></span></figcaption>
		</figure>
	<?php endif; ?>
</section>
<?php if ( $sc_wins || ! $sc_lead ) : ?>
<section id="wins" class="ww-archive" aria-labelledby="ww-archive-title">
	<div class="sc-section">
		<header class="ww-heading">
			<h2 id="ww-archive-title" class="sc-display"><?php echo successcircles_inline( $sc_copy['feed_title'] ); ?></h2>
			<p class="ww-lede"><?php echo esc_html( $sc_copy['feed_lede'] ); ?></p>
		</header>
		<?php if ( ! $sc_wins ) : ?>
			<div class="ww-empty"><p><?php echo esc_html( wp_specialchars_decode( $sc_copy['empty'] ) ); ?></p><a class="ww-text-link" href="<?php echo successcircles_url( $sc_link['url'] ); ?>"><?php echo esc_html( $sc_link['label'] ); ?> ↗</a></div>
		<?php else : ?>
			<div class="ww-archive__meta"><span><?php esc_html_e( 'From the community', 'successcircles' ); ?></span><span><?php printf( esc_html__( 'Page %1$d of %2$d', 'successcircles' ), $sc_current, $sc_pages ); ?></span></div>
			<div class="ww-grid">
				<?php foreach ( $sc_visible as $sc_win ) : ?>
					<figure class="ww-card">
						<figcaption><span class="ww-member-mark" aria-hidden="true">↗</span><span><strong><?php echo esc_html( $sc_win['name'] ); ?></strong><span class="ww-date"><?php echo esc_html( $sc_win['date'] ); ?></span></span></figcaption>
						<blockquote><?php echo esc_html( $sc_win['text'] ); ?></blockquote>
					</figure>
				<?php endforeach; ?>
			</div>
			<?php if ( $sc_pages > 1 ) : ?>
				<nav class="ww-pagination" aria-label="<?php esc_attr_e( 'Member wins pages', 'successcircles' ); ?>">
					<?php echo paginate_links( array(
						'base' => add_query_arg( 'wins_page', '%#%', get_permalink() ),
						'format' => '',
						'current' => $sc_current,
						'total' => $sc_pages,
						'mid_size' => 1,
						'end_size' => 1,
						'prev_text' => __( '← Newer', 'successcircles' ),
						'next_text' => __( 'Older →', 'successcircles' ),
						'add_fragment' => '#wins',
					) ); ?>
				</nav>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>
</article>
<?php get_template_part( 'template-parts/home/cta' ); ?>
<?php get_footer(); ?>
