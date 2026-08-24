<?php
/**
 * 04 / How it works.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_process = (array) successcircles_content( 'process', array() );

?>
<section class="sc-band--shade sc-band--hairline" aria-labelledby="sc-process-title">
	<div class="sc-section sc-section--short">
		<?php successcircles_eyebrow( $sc_process['index'], $sc_process['eyebrow'] ); ?>
		<h2 id="sc-process-title" class="sc-display sc-display--lg sc-process__title">
			<?php echo successcircles_inline( $sc_process['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</h2>

		<ol class="sc-process__steps">
			<?php foreach ( (array) $sc_process['steps'] as $sc_step ) : ?>
				<li class="sc-step" style="--sc-dot-alpha:<?php echo esc_attr( $sc_step['alpha'] ); ?>">
					<h3 class="sc-step__title"><?php echo esc_html( $sc_step['title'] ); ?></h3>
					<p class="sc-step__text"><?php echo esc_html( wp_specialchars_decode( $sc_step['text'] ) ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
