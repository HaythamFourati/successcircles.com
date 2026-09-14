<?php
/**
 * Trust bar: press mentions and endorsements.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_trust = (array) successcircles_content( 'trust', array() );
$sc_parts = array();

foreach ( (array) $sc_trust['logos'] as $sc_logo ) {
	$sc_parts[] = array(
		'type' => 'logo',
		'data' => $sc_logo,
	);
}

foreach ( (array) $sc_trust['names'] as $sc_name ) {
	$sc_parts[] = array(
		'type' => 'name',
		'data' => $sc_name,
	);
}

?>
<section class="sc-trust sc-band--dark" aria-label="<?php esc_attr_e( 'Press and endorsements', 'successcircles' ); ?>">
	<div class="sc-trust__inner">
		<p class="sc-trust__label"><?php echo esc_html( $sc_trust['label'] ); ?></p>

		<div class="sc-trust__items">
		<?php foreach ( $sc_parts as $sc_index => $sc_part ) : ?>
			<div class="sc-trust__item">

			<?php if ( 'logo' === $sc_part['type'] ) : ?>
				<?php if ( '' !== $sc_part['data']['note'] ) : ?>
					<span class="sc-trust__group">
						<?php
						successcircles_image(
							array(
								'src'   => $sc_part['data']['src'],
								'alt'   => $sc_part['data']['alt'],
								'class' => 'sc-trust__logo',
							'width' => 'Inc.' === $sc_part['data']['alt'] ? 220 : 1133,
							'height' => 'Inc.' === $sc_part['data']['alt'] ? 76 : 278,
							)
						);
						?>
						<span class="sc-trust__note"><?php echo esc_html( $sc_part['data']['note'] ); ?></span>
					</span>
				<?php else : ?>
					<?php
					successcircles_image(
						array(
							'src'   => $sc_part['data']['src'],
							'alt'   => $sc_part['data']['alt'],
							'class' => 'sc-trust__logo',
							'width' => 'Inc.' === $sc_part['data']['alt'] ? 220 : 1133,
							'height' => 'Inc.' === $sc_part['data']['alt'] ? 76 : 278,
						)
					);
					?>
				<?php endif; ?>
			<?php else : ?>
				<span class="sc-trust__name">
					<?php echo esc_html( $sc_part['data']['name'] ); ?>
					<span><?php echo esc_html( $sc_part['data']['note'] ); ?></span>
				</span>
			<?php endif; ?>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
</section>
