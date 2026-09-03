<?php
/**
 * 02 / What is a huddle?
 *
 * Two columns: the copy and numbered items on the left, the image and
 * pull-quote on the right.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_huddle = (array) successcircles_content( 'huddle', array() );

?>
<section id="huddle" class="sc-band--hairline" aria-labelledby="sc-huddle-title">
	<div class="sc-section">
		<div class="sc-huddle">

			<div class="sc-huddle__copy">
				<?php successcircles_eyebrow( $sc_huddle['index'], $sc_huddle['eyebrow'] ); ?>

				<h2 id="sc-huddle-title" class="sc-display sc-display--lg">
					<?php echo successcircles_inline( $sc_huddle['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</h2>

				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_huddle['lede'] ) ); ?></p>

				<ol class="sc-rows">
					<?php foreach ( (array) $sc_huddle['items'] as $sc_index => $sc_item ) : ?>
						<li class="sc-row">
							<span class="sc-row__index" aria-hidden="true">
								<?php echo esc_html( str_pad( (string) ( $sc_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>
							</span>
							<div>
								<h3 class="sc-row__title"><?php echo esc_html( $sc_item['title'] ); ?></h3>
								<p class="sc-row__text"><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>

			<div class="sc-huddle__media">
				<figure class="sc-huddle__figure">
					<img
						src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/team/huddle-screen.jpg?v=' . successcircles_asset_version( '/assets/img/team/huddle-screen.jpg' ) ); ?>"
						alt="<?php esc_attr_e( 'A weekday huddle call between two business owners', 'successcircles' ); ?>"
						width="825"
						height="1100"
						loading="lazy"
						decoding="async"
					>
				</figure>

				<blockquote class="sc-huddle__quote">
					<?php echo esc_html( wp_specialchars_decode( $sc_huddle['quote'] ) ); ?>
				</blockquote>
			</div>

		</div>
	</div>
</section>
