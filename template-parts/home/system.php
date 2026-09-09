<?php
/**
 * 03 / The system — Momentum OS.
 *
 * Two columns: the copy and the formula on the left, the cycle on the right.
 *
 * The cycle is a ring of numbered nodes with the active step's detail in the
 * middle. Momentum OS is a weekly loop, so it is drawn as one — the previous
 * top-to-bottom timeline read as a journey with an end, and ran to 1990px for
 * six short steps.
 *
 * Progressive enhancement, on the same contract as the rest of the theme: every
 * step is server-rendered and visible, and initMomentumOs() in theme.js only
 * hides the inactive ones once it has taken over. With JavaScript off, or under
 * prefers-reduced-motion, the six steps read as an ordinary list and the ring
 * stays a static diagram.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_system = (array) successcircles_content( 'system', array() );
$sc_steps  = (array) $sc_system['steps'];
$sc_count  = max( 1, count( $sc_steps ) );

?>
<section id="system" class="sc-band--dark" aria-labelledby="sc-system-title">
	<div class="sc-section">
		<div class="sc-os">

			<div class="sc-os__copy">
				<?php successcircles_eyebrow( $sc_system['index'], $sc_system['eyebrow'] ); ?>

				<h2 id="sc-system-title" class="sc-display sc-display--lg">
					<?php echo successcircles_inline( $sc_system['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</h2>

				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_system['lede'] ) ); ?></p>

				<p class="sc-formula">
					<?php foreach ( (array) $sc_system['formula'] as $sc_index => $sc_term ) : ?>
						<span class="sc-formula__term">
						<?php if ( $sc_index > 0 ) : ?>
							<span class="sc-formula__op" aria-hidden="true">+</span>
						<?php endif; ?>
						<span><?php echo esc_html( $sc_term ); ?></span>
						</span>
					<?php endforeach; ?>
					<span class="sc-formula__term"><span class="sc-formula__arrow" aria-hidden="true">&rarr;</span>
					<span class="sc-formula__result"><?php echo esc_html( $sc_system['result'] ); ?></span></span>
				</p>
			</div>

			<div class="sc-os__cycle" data-sc-os>
				<div class="sc-os__ring">

					<svg class="sc-os__arc" viewBox="0 0 400 400" aria-hidden="true" focusable="false">
						<circle class="sc-os__arc-track" cx="200" cy="200" r="200" />
						<circle class="sc-os__arc-run" cx="200" cy="200" r="200" data-sc-os-arc />
					</svg>

					<ul class="sc-os__dial">
						<?php foreach ( $sc_steps as $sc_index => $sc_step ) : ?>
							<li
								class="sc-os__node"
								style="--sc-os-angle:<?php echo esc_attr( (string) ( -90 + ( $sc_index * ( 360 / $sc_count ) ) ) ); ?>deg"
							>
								<button
									class="sc-os__dot"
									type="button"
									data-sc-os-dot="<?php echo esc_attr( (string) $sc_index ); ?>"
									aria-label="
									<?php
									echo esc_attr(
										sprintf(
											/* translators: 1: step number, 2: step name. */
											__( 'Step %1$s: %2$s', 'successcircles' ),
											$sc_index + 1,
											$sc_step['title']
										)
									);
									?>
									"
								>
									<span aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $sc_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
								</button>
							</li>
						<?php endforeach; ?>
					</ul>

					<div class="sc-os__core">
						<ol class="sc-os__steps">
							<?php foreach ( $sc_steps as $sc_index => $sc_step ) : ?>
								<li class="sc-os__step" data-sc-os-step="<?php echo esc_attr( (string) $sc_index ); ?>">
									<p class="sc-os__step-index" aria-hidden="true">
										<?php echo esc_html( str_pad( (string) ( $sc_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>
									</p>
									<h3 class="sc-os__step-title"><?php echo esc_html( $sc_step['title'] ); ?></h3>
									<p class="sc-os__step-text"><?php echo esc_html( wp_specialchars_decode( $sc_step['text'] ) ); ?></p>
								</li>
							<?php endforeach; ?>
						</ol>
					</div>

				</div>

				<p class="sc-os-repeat"><span aria-hidden="true">&#8634;</span><?php esc_html_e( 'Repeat weekly', 'successcircles' ); ?></p>
			</div>

		</div>
	</div>
</section>
