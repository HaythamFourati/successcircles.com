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
	<div class="sc-section">
		<div class="sc-huddle sc-huddle--reverse">

			<div class="sc-huddle__media">
				<figure class="sc-huddle__figure">
					<img
						src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/hero-huddle.jpg?v=' . successcircles_asset_version( '/assets/img/hero-huddle.jpg' ) ); ?>"
						alt="<?php esc_attr_e( 'An entrepreneur joining a video call from a shared workspace', 'successcircles' ); ?>"
						width="1170"
						height="780"
						loading="lazy"
						decoding="async"
					>
				</figure>

				<blockquote class="sc-huddle__quote">
					<?php echo esc_html( wp_specialchars_decode( $sc_problem['quote'] ) ); ?>
				</blockquote>
			</div>

			<div class="sc-huddle__copy">
				<?php successcircles_eyebrow( $sc_problem['index'], $sc_problem['eyebrow'] ); ?>

				<h2 id="sc-problem-title" class="sc-display sc-display--lg">
					<?php echo successcircles_inline( $sc_problem['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</h2>

				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_problem['lede'] ) ); ?></p>

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

		</div>
	</div>
</section>
