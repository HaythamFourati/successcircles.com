<?php
/**
 * Closing call to action.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_cta = (array) successcircles_content( 'cta', array() );

?>
<section id="contact" class="sc-cta sc-band--hairline" aria-labelledby="sc-cta-title">
	<div class="sc-cta__inner">
		<span class="sc-cta__ring" aria-hidden="true"></span>
		<span class="sc-cta__ring-dashed" aria-hidden="true"></span>

		<h2 id="sc-cta-title" class="sc-display sc-cta__title">
			<?php echo successcircles_inline( $sc_cta['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</h2>

		<p class="sc-lede sc-cta__lede"><?php echo esc_html( wp_specialchars_decode( $sc_cta['lede'] ) ); ?></p>

		<div class="sc-actions sc-actions--center sc-cta__actions">
			<a class="sc-btn sc-btn--primary" <?php successcircles_test_link_attrs(); ?>>
				<?php echo esc_html( $sc_cta['primary_cta'] ); ?>
			</a>
			<a class="sc-btn sc-btn--ghost" href="<?php echo successcircles_url( '#programs' ); ?>">
				<?php echo esc_html( $sc_cta['secondary_cta'] ); ?>
			</a>
		</div>
	</div>
</section>
