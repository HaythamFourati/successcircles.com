<?php
/**
 * The 404 template.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

get_header();

?>
<div class="sc-page sc-404">
	<?php successcircles_eyebrow( '404', __( 'Not found', 'successcircles' ) ); ?>

	<h1 class="sc-display sc-display--xl">
		<?php esc_html_e( 'This page took a week off.', 'successcircles' ); ?>
	</h1>

	<p class="sc-lede">
		<?php esc_html_e( 'The link is broken or the page has moved. Head back to the homepage, or start with the test.', 'successcircles' ); ?>
	</p>

	<div class="sc-actions sc-actions--center">
		<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php esc_html_e( 'Back to homepage', 'successcircles' ); ?>
		</a>
		<a class="sc-btn sc-btn--ghost" <?php successcircles_test_link_attrs(); ?>>
			<?php esc_html_e( 'Take the Entrepreneur Test', 'successcircles' ); ?>
		</a>
	</div>
</div>
<?php

get_footer();
