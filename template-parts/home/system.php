<?php
/**
 * 02 / The system — Momentum OS.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_system = (array) successcircles_content( 'system', array() );

?>
<section id="system" class="sc-band--dark" aria-labelledby="sc-system-title">
	<div class="sc-section">

		<div class="sc-split sc-split--bottom sc-system__head">
			<div>
				<?php successcircles_eyebrow( $sc_system['index'], $sc_system['eyebrow'] ); ?>
				<h2 id="sc-system-title" class="sc-display sc-display--lg">
					<?php echo successcircles_inline( $sc_system['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</h2>
			</div>
			<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_system['lede'] ) ); ?></p>
		</div>

		<p class="sc-formula">
			<?php foreach ( (array) $sc_system['formula'] as $sc_index => $sc_term ) : ?>
				<?php if ( $sc_index > 0 ) : ?>
					<span class="sc-formula__op" aria-hidden="true">+</span>
				<?php endif; ?>
				<span><?php echo esc_html( $sc_term ); ?></span>
			<?php endforeach; ?>
			<span class="sc-formula__arrow" aria-hidden="true">&rarr;</span>
			<span class="sc-formula__result"><?php echo esc_html( $sc_system['result'] ); ?></span>
		</p>

		<ol class="sc-os-grid">
			<?php foreach ( (array) $sc_system['steps'] as $sc_index => $sc_step ) : ?>
				<li class="sc-os-cell">
					<div class="sc-os-cell__meta">
						<span class="sc-os-cell__dot" style="--sc-dot-alpha:<?php echo esc_attr( $sc_step['alpha'] ); ?>" aria-hidden="true"></span>
						<span class="sc-os-cell__num" aria-hidden="true">
							<?php echo esc_html( str_pad( (string) ( $sc_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>
						</span>
					</div>
					<h3 class="sc-os-cell__title"><?php echo esc_html( $sc_step['title'] ); ?></h3>
					<p class="sc-os-cell__text"><?php echo esc_html( wp_specialchars_decode( $sc_step['text'] ) ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>

	</div>
</section>
