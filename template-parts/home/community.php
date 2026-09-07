<?php
/**
 * 04 / The community.
 *
 * Light band with a portrait image on the left and a numbered
 * feature grid on the right. Sits between the system and programs.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_community = (array) successcircles_content( 'community', array() );

?>
<section id="community" class="sc-band--shade sc-band--hairline" aria-labelledby="sc-community-title">
	<div class="sc-section sc-section--compact">
		<div class="sc-community">

			<div class="sc-community__media">
				<figure class="sc-community__figure">
					<img
						src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/team/members-live.jpg?v=' . successcircles_asset_version( '/assets/img/team/members-live.jpg' ) ); ?>"
						alt="<?php esc_attr_e( 'Success Circles members during a live community session', 'successcircles' ); ?>"
						width="1120"
						height="1400"
						loading="lazy"
						decoding="async"
					>
				</figure>
				<p class="sc-community__caption">Member gathering / Success Circles&trade;</p>
			</div>

			<div class="sc-community__body">
				<?php successcircles_eyebrow( $sc_community['index'], $sc_community['eyebrow'] ); ?>

				<h2 id="sc-community-title" class="sc-display sc-display--lg">
					<?php echo successcircles_inline( $sc_community['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</h2>

				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_community['lede'] ) ); ?></p>

				<ul class="sc-community__grid">
					<?php foreach ( (array) $sc_community['items'] as $sc_index => $sc_item ) : ?>
						<li class="sc-community__item">
							<span class="sc-community__num" aria-hidden="true">
								<?php echo esc_html( str_pad( (string) ( $sc_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>
							</span>
							<div class="sc-community__item-body">
								<h3 class="sc-community__item-title"><?php echo esc_html( $sc_item['title'] ); ?></h3>
								<p class="sc-community__item-text"><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>

			</div>

		</div>
	</div>
</section>
