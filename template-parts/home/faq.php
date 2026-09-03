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
	<div id="faq" class="sc-section sc-faq__layout">
		<header class="sc-faq__head">
			<?php successcircles_eyebrow( $sc_faq['index'], $sc_faq['eyebrow'] ); ?>

			<h2 id="sc-faq-title" class="sc-display sc-display--md sc-faq__title">
				<?php echo successcircles_inline( $sc_faq['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h2>
		</header>

		<div class="sc-faq__items">
			<?php foreach ( (array) $sc_faq['items'] as $sc_index => $sc_item ) : ?>
				<details class="sc-faq__item"<?php echo 0 === $sc_index ? ' open' : ''; ?>>
					<summary class="sc-faq__question">
						<span><?php echo esc_html( wp_specialchars_decode( $sc_item['question'] ) ); ?></span>
						<span class="sc-faq__toggle" aria-hidden="true"></span>
					</summary>
					<p class="sc-faq__answer"><?php echo esc_html( wp_specialchars_decode( $sc_item['answer'] ) ); ?></p>
				</details>
			<?php endforeach; ?>
		</div>

		<a class="sc-link-rule sc-faq__link" href="<?php echo successcircles_url( $sc_link['url'] ); ?>">
			<?php echo esc_html( $sc_link['label'] ); ?>
		</a>
	</div>
</section>
