<?php
/**
 * 07 / Founder.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_founder = (array) successcircles_content( 'founder', array() );
$sc_link    = (array) $sc_founder['link'];

?>
<section id="founder" class="sc-founder sc-band--sand sc-band--curtain" aria-labelledby="sc-founder-title">
	<div class="sc-section sc-section--taller sc-split sc-split--narrow sc-split--center sc-founder__inner">

		<div class="sc-founder__media">
			<span class="sc-founder__ring" aria-hidden="true"></span>
			<span class="sc-founder__ring-dashed" aria-hidden="true"></span>

			<figure class="sc-founder__frame">
				<?php
				successcircles_image(
					array(
						'src' => $sc_founder['portrait'],
						'alt' => $sc_founder['portrait_alt'],
					)
				);
				?>
			</figure>

			<span class="sc-founder__pip sc-founder__pip--a" aria-hidden="true"></span>
			<span class="sc-founder__pip sc-founder__pip--b" aria-hidden="true"></span>
		</div>

		<div class="sc-founder__copy">
			<?php
			// The index belongs to the homepage's 01-09 sequence; on About it
			// would point at a run of sections that isn't there.
			successcircles_eyebrow( is_front_page() ? $sc_founder['index'] : '', $sc_founder['eyebrow'] );
			?>

			<h2 id="sc-founder-title" class="sc-display sc-display--md sc-founder__title">
				<?php echo esc_html( $sc_founder['name'] ); ?>
			</h2>

			<p class="sc-founder__text"><?php echo esc_html( wp_specialchars_decode( $sc_founder['bio'] ) ); ?></p>
			<p class="sc-founder__text sc-founder__text--secondary"><?php echo esc_html( wp_specialchars_decode( $sc_founder['bio_secondary'] ) ); ?></p>

			<?php
			successcircles_image(
				array(
					'src'   => $sc_founder['signature'],
					'alt'   => $sc_founder['signature_alt'],
					'class' => 'sc-founder__signature',
					'width' => 259,
					'height' => 45,
				)
			);
			?>

			<p class="sc-founder__link-wrap">
				<a class="sc-link-rule sc-founder__link" href="<?php echo esc_url( successcircles_url( $sc_link['url'] ) ); ?>">
					<?php echo esc_html( $sc_link['label'] ); ?>
					<span aria-hidden="true">↗</span>
				</a>
			</p>
		</div>

	</div>
</section>
