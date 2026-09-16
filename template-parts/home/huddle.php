<?php
/** Homepage huddle: the daily loop as an interactive flywheel. */
defined( 'ABSPATH' ) || exit;
$sc_block = (array) successcircles_content( 'huddle', array() );
$sc_items = array_values( (array) $sc_block['items'] );
$sc_count = count( $sc_items );

// Arrowheads sit between the step slots on the ellipse, pointing the way round.
$sc_rx  = 232;
$sc_ry  = 118;
$sc_arrows = array();
for ( $sc_i = 0; $sc_i < $sc_count; $sc_i++ ) {
	$sc_a = deg2rad( 90 + ( $sc_i + 0.5 ) * ( 360 / $sc_count ) );
	$sc_x = 300 + $sc_rx * cos( $sc_a );
	$sc_y = 150 + $sc_ry * sin( $sc_a );
	// Tangent of the ellipse at that angle, in the direction of travel.
	$sc_r = rad2deg( atan2( $sc_ry * cos( $sc_a ), -$sc_rx * sin( $sc_a ) ) );
	$sc_arrows[] = sprintf( 'translate(%.1f %.1f) rotate(%.1f)', $sc_x, $sc_y, $sc_r );
}
?>
<section id="huddle" class="hp-huddle sc-band--hairline" aria-labelledby="sc-huddle-title">
	<div class="sc-section">
		<header class="hp-intro">
			<?php successcircles_eyebrow( $sc_block['index'], $sc_block['eyebrow'] ); ?>
			<h2 id="sc-huddle-title" class="sc-display sc-display--lg"><?php echo successcircles_inline( $sc_block['title'] ); ?></h2>
			<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_block['lede'] ) ); ?></p>
		</header>

		<div class="sc-fly" data-sc-fly style="--sc-fly-count:<?php echo esc_attr( (string) $sc_count ); ?>">
			<div class="sc-fly__ring">
				<svg class="sc-fly__path" viewBox="0 0 600 300" aria-hidden="true" focusable="false" preserveAspectRatio="xMidYMid meet">
					<ellipse cx="300" cy="150" rx="<?php echo esc_attr( (string) $sc_rx ); ?>" ry="<?php echo esc_attr( (string) $sc_ry ); ?>"/>
					<?php foreach ( $sc_arrows as $sc_transform ) : ?>
						<path class="sc-fly__tip" d="M -7 -7 L 1 0 L -7 7" transform="<?php echo esc_attr( $sc_transform ); ?>"/>
					<?php endforeach; ?>
				</svg>

				<p class="sc-fly__hub" aria-hidden="true"><?php echo esc_html( wp_specialchars_decode( $sc_block['hub'] ) ); ?></p>

				<ol class="sc-fly__nodes">
					<?php foreach ( $sc_items as $sc_index => $sc_item ) : ?>
						<li class="sc-fly__slot" style="--sc-fly-i:<?php echo esc_attr( (string) $sc_index ); ?>">
							<button class="sc-fly__node" type="button" data-sc-fly-step="<?php echo esc_attr( (string) $sc_index ); ?>" aria-pressed="<?php echo 0 === $sc_index ? 'true' : 'false'; ?>">
								<span class="sc-fly__num"><?php echo esc_html( sprintf( '%02d', $sc_index + 1 ) ); ?></span>
								<span class="sc-fly__title"><?php echo esc_html( wp_specialchars_decode( $sc_item['title'] ) ); ?></span>
								<span class="sc-fly__text"><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></span>
							</button>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>

			<div class="sc-fly__controls" hidden>
				<button type="button" data-sc-fly-prev aria-label="<?php esc_attr_e( 'Previous step', 'successcircles' ); ?>">&#8592;</button>
				<button type="button" data-sc-fly-next aria-label="<?php esc_attr_e( 'Next step', 'successcircles' ); ?>">&#8594;</button>
			</div>

			<p class="sc-fly__caption"><?php echo esc_html( wp_specialchars_decode( $sc_block['quote'] ) ); ?></p>
		</div>
	</div>
</section>
