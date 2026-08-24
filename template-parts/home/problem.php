<?php
/**
 * 01 / The problem.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_problem = (array) successcircles_content( 'problem', array() );

?>
<section class="sc-band--shade sc-band--curtain" aria-labelledby="sc-problem-title">
	<div class="sc-section sc-section--tall sc-split">
		<div class="sc-problem__intro">
			<?php successcircles_eyebrow( $sc_problem['index'], $sc_problem['eyebrow'] ); ?>
			<h2 id="sc-problem-title" class="sc-display sc-display--lg">
				<?php echo successcircles_inline( $sc_problem['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h2>

			<figure class="sc-problem__media">
				<img
					src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/problem-lonely.jpg' ); ?>"
					alt="<?php esc_attr_e( 'A solo entrepreneur working alone in a large empty office', 'successcircles' ); ?>"
					width="1074"
					height="805"
					loading="lazy"
					decoding="async"
				>
			</figure>
		</div>

		<ol class="sc-rows">
			<?php foreach ( (array) $sc_problem['items'] as $sc_index => $sc_item ) : ?>
				<li class="sc-row">
					<span class="sc-row__index" aria-hidden="true">
						<?php echo esc_html( str_pad( (string) ( $sc_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>
					</span>
					<div>
						<h3 class="sc-row__title"><?php echo esc_html( wp_specialchars_decode( $sc_item['title'] ) ); ?></h3>
						<p class="sc-row__text"><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
