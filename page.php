<?php
/**
 * The default page template.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'sc-page' ); ?>>

		<header class="sc-page__header">
			<h1 class="sc-display sc-display--lg"><?php the_title(); ?></h1>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="sc-page__media">
				<?php the_post_thumbnail( 'full', array( 'loading' => 'eager' ) ); ?>
			</figure>
		<?php endif; ?>

		<div class="sc-prose">
			<?php the_content(); ?>
		</div>

	</article>
	<?php
	if ( comments_open() || get_comments_number() ) {
		echo '<div class="sc-page">';
		comments_template();
		echo '</div>';
	}
endwhile;

get_footer();
