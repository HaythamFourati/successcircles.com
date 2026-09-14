<?php
/** Homepage huddle: focused introduction and a compact visual breakdown. */
defined( 'ABSPATH' ) || exit;
$sc_block = (array) successcircles_content( 'huddle', array() );
?>
<section id="huddle" class="hp-huddle sc-band--hairline" aria-labelledby="sc-huddle-title">
	<div class="sc-section">
		<header class="hp-intro">
			<?php successcircles_eyebrow( $sc_block['index'], $sc_block['eyebrow'] ); ?>
			<h2 id="sc-huddle-title" class="sc-display sc-display--lg"><?php echo successcircles_inline( $sc_block['title'] ); ?></h2>
			<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_block['lede'] ) ); ?></p>
		</header>
		<div class="sc-call" data-sc-call>
			<div class="sc-call__object">
				<div class="sc-call__stage" aria-hidden="true">
					<div class="sc-call__world">
						<div class="sc-call__ground"></div>
						<div class="sc-call__rotor">
							<?php foreach ( (array) $sc_block['items'] as $sc_index => $sc_item ) : ?>
								<div class="sc-call__segment<?php echo 0 === $sc_index ? ' is-active' : ''; ?>" style="--position:<?php echo esc_attr( $sc_index ); ?>">
									<?php for ( $sc_layer = 0; $sc_layer < 6; $sc_layer++ ) : ?>
										<svg class="sc-call__slice" style="--layer:<?php echo esc_attr( $sc_layer ); ?>" viewBox="-230 -230 460 460"><path d="M172.02 -120.45 A210 210 0 0 1 172.02 120.45 L95.02 66.53 A116 116 0 0 0 95.02 -66.53 Z"/><?php if ( 5 === $sc_layer ) : ?><text x="163" y="10" text-anchor="middle"><?php echo esc_html( sprintf( '%02d', $sc_index + 1 ) ); ?></text><?php endif; ?></svg>
									<?php endfor; ?>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="sc-call__hub"><div class="sc-call__hub-face"><span>FOCUSED CALL</span><strong>30</strong><span>MINUTES</span></div></div>
					</div>
				</div>
				<div class="sc-call__controls" hidden>
					<button type="button" data-call-prev aria-label="Previous huddle step">←</button>
					<button type="button" data-call-next aria-label="Next huddle step">→</button>
				</div>
			</div>
			<div class="sc-call__content">
				<p class="sc-call__eyebrow">One conversation. Four moves.</p>
				<ol class="sc-call__steps">
					<?php foreach ( (array) $sc_block['items'] as $sc_index => $sc_item ) : ?>
						<li><button class="sc-call__step" type="button" aria-pressed="<?php echo 0 === $sc_index ? 'true' : 'false'; ?>" data-call-step="<?php echo esc_attr( $sc_index ); ?>"><span class="sc-call__number"><?php echo esc_html( sprintf( '%02d', $sc_index + 1 ) ); ?></span><span><strong><?php echo esc_html( wp_specialchars_decode( $sc_item['title'] ) ); ?></strong><span class="sc-call__description"><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></span></span><span class="sc-call__arrow" aria-hidden="true">↗</span></button></li>
					<?php endforeach; ?>
				</ol>
			</div>
			<p class="sc-call__caption"><?php echo esc_html( wp_specialchars_decode( $sc_block['quote'] ) ); ?></p>
		</div>
	</div>
</section>
