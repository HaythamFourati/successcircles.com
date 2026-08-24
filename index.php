<?php
/**
 * The fallback template. Also serves the blog index and archives.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

get_header();

?>
<div class="sc-page">

	<header class="sc-page__header">
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<?php successcircles_eyebrow( '', __( 'Journal', 'successcircles' ) ); ?>
			<h1 class="sc-display sc-display--lg"><?php single_post_title(); ?></h1>
		<?php elseif ( is_search() ) : ?>
			<?php successcircles_eyebrow( '', __( 'Search', 'successcircles' ) ); ?>
			<h1 class="sc-display sc-display--lg">
				<?php
				printf(
					/* translators: %s: search query. */
					esc_html__( 'Results for &ldquo;%s&rdquo;', 'successcircles' ),
					esc_html( get_search_query() )
				);
				?>
			</h1>
		<?php elseif ( is_archive() ) : ?>
			<?php successcircles_eyebrow( '', __( 'Archive', 'successcircles' ) ); ?>
			<h1 class="sc-display sc-display--lg"><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
			<?php the_archive_description( '<div class="sc-lede">', '</div>' ); ?>
		<?php endif; ?>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="sc-archive">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content-card' );
			endwhile;
			?>
		</div>

		<?php successcircles_pagination(); ?>
	<?php else : ?>
		<p class="sc-lede"><?php esc_html_e( 'Nothing found here yet.', 'successcircles' ); ?></p>
	<?php endif; ?>

</div>
<?php

get_footer();
