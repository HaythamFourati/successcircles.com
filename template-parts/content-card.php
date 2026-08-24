<?php
/**
 * Archive card for a single post in a listing.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'sc-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail(
				'successcircles-episode',
				array(
					'class'   => 'sc-card__thumb',
					'loading' => 'lazy',
				)
			);
			?>
		</a>
	<?php endif; ?>

	<p class="sc-card__meta">
		<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
			<?php echo esc_html( get_the_date() ); ?>
		</time>
	</p>

	<h2 class="sc-card__title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>

	<p class="sc-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
</article>
