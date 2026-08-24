<?php
/**
 * Loading curtain with the animated orbit brand mark.
 *
 * Decorative only: hidden from assistive technology, removed entirely under
 * prefers-reduced-motion, and stripped from the DOM once its animation ends.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="sc-loader" data-sc-loader aria-hidden="true">
	<div class="sc-loader__inner">
		<div class="sc-loader__mark">
			<?php successcircles_brand_mark(); ?>
		</div>
		<p class="sc-loader__label"><?php echo esc_html( successcircles_content( 'loader.label' ) ); ?></p>
	</div>
</div>
