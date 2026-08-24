<?php
/**
 * 06 / The Entrepreneur Test.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_test = (array) successcircles_content( 'test', array() );

?>
<section id="test" class="sc-test sc-band--dark" aria-labelledby="sc-test-title">
	<span class="sc-test__ring-a" aria-hidden="true"></span>
	<span class="sc-test__ring-b" aria-hidden="true"></span>

	<div class="sc-test__inner">
		<div class="sc-test__col">
			<?php successcircles_eyebrow( $sc_test['index'], $sc_test['eyebrow'] ); ?>

			<h2 id="sc-test-title" class="sc-display sc-test__title">
				<?php echo successcircles_inline( $sc_test['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h2>

			<p class="sc-lede sc-test__lede"><?php echo esc_html( wp_specialchars_decode( $sc_test['lede'] ) ); ?></p>

			<div class="sc-actions sc-test__actions">
				<a class="sc-btn sc-btn--primary" <?php successcircles_test_link_attrs(); ?>>
					<?php echo esc_html( $sc_test['cta'] ); ?>
				</a>
				<span class="sc-test__note"><?php echo esc_html( $sc_test['note'] ); ?></span>
			</div>
		</div>
	</div>
</section>
