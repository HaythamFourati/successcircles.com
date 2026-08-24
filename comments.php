<?php
/**
 * The comments area.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}

?>
<section class="sc-comments" aria-labelledby="sc-comments-title">

	<?php if ( have_comments() ) : ?>
		<h2 id="sc-comments-title" class="sc-display sc-display--sm">
			<?php
			printf(
				/* translators: %s: comment count. */
				esc_html( _n( '%s response', '%s responses', get_comments_number(), 'successcircles' ) ),
				esc_html( number_format_i18n( get_comments_number() ) )
			);
			?>
		</h2>

		<ol class="sc-comments__list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>

		<?php successcircles_pagination(); ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_submit'  => 'sc-btn sc-btn--primary',
			'title_reply'   => __( 'Leave a response', 'successcircles' ),
			'title_reply_before' => '<h2 id="reply-title" class="sc-display sc-display--sm">',
			'title_reply_after'  => '</h2>',
		)
	);
	?>

</section>
