<?php
/**
 * 08 / Questions.
 *
 * Wrapped in a shade band. The podcast section that used to sit above this one
 * carried the only tonal break between the founder band and the closing CTA;
 * with it removed, founder / FAQ / CTA all ran together as one sand field. The
 * band moves here so the rhythm survives the removal.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_faq  = (array) successcircles_content( 'faq', array() );
$sc_link = (array) $sc_faq['link'];

// FAQPage structured data for these items is emitted with the rest of the
// page's schema graph — see inc/schema.php.

?>
<section class="sc-band--shade sc-band--hairline" aria-labelledby="sc-faq-title">
	<div id="faq" class="sc-section sc-split sc-split--narrow sc-split--top">
		<div>
			<?php successcircles_eyebrow( $sc_faq['index'], $sc_faq['eyebrow'] ); ?>

			<h2 id="sc-faq-title" class="sc-display sc-display--md sc-faq__title">
				<?php echo successcircles_inline( $sc_faq['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h2>

			<a class="sc-link-rule" href="<?php echo successcircles_url( $sc_link['url'] ); ?>">
				<?php echo esc_html( $sc_link['label'] ); ?>
			</a>
		</div>

		<div class="sc-rows">
			<?php foreach ( (array) $sc_faq['items'] as $sc_item ) : ?>
				<div class="sc-row sc-faq__item">
					<h3 class="sc-faq__question"><?php echo esc_html( wp_specialchars_decode( $sc_item['question'] ) ); ?></h3>
					<p class="sc-faq__answer"><?php echo esc_html( wp_specialchars_decode( $sc_item['answer'] ) ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
