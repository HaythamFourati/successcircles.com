<?php
/**
 * 05 / Programs.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_programs = (array) successcircles_content( 'programs', array() );
$sc_note     = (array) $sc_programs['note'];

?>
<section id="programs" class="sc-band--sand sc-band--curtain" aria-labelledby="sc-programs-title">
	<div class="sc-section sc-section--taller">

		<div class="sc-programs__intro">
			<div class="sc-programs__intro-left">
				<?php successcircles_eyebrow( $sc_programs['index'], $sc_programs['eyebrow'] ); ?>
				<h2 id="sc-programs-title" class="sc-display sc-display--xl sc-programs__title">
					<?php echo successcircles_inline( $sc_programs['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</h2>
			</div>
			<div class="sc-programs__intro-right">
				<img class="sc-programs__seal" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/30-day guarantee.png' ); ?>" alt="<?php esc_attr_e( '30-day money-back guarantee', 'successcircles' ); ?>" width="80" height="80" loading="lazy">
				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_programs['lede'] ) ); ?></p>
			</div>
		</div>

		<div class="sc-programs__cards">
			<?php foreach ( (array) $sc_programs['cards'] as $sc_index => $sc_card ) :
				$sc_card_classes = 'sc-program';
				if ( ! empty( $sc_card['featured'] ) ) {
					$sc_card_classes .= ' sc-program--featured';
				}
				if ( false !== stripos( $sc_card['kind'], 'AI' ) ) {
					$sc_card_classes .= ' sc-program--ai';
				}
			?>
				<article class="<?php echo esc_attr( $sc_card_classes ); ?>">
					<div class="sc-program__meta">
						<span class="sc-program__kind">
							<?php echo esc_html( $sc_card['kind'] ); ?>
							<?php if ( false !== stripos( $sc_card['kind'], 'AI' ) ) : ?>
								<svg class="sc-program__spark" width="22" height="22" viewBox="0 0 16 16" fill="none" aria-hidden="true" focusable="false">
									<path d="M8 0.5C8.6 3.2 9.8 4.4 12.5 5C9.8 5.6 8.6 6.8 8 9.5C7.4 6.8 6.2 5.6 3.5 5C6.2 4.4 7.4 3.2 8 0.5Z" fill="var(--sc-orange)"/>
									<path d="M8 0.5C8.6 3.2 9.8 4.4 12.5 5C9.8 5.6 8.6 6.8 8 9.5C7.4 6.8 6.2 5.6 3.5 5C6.2 4.4 7.4 3.2 8 0.5Z" fill="oklch(var(--sc-orange) / 0.3)" transform="translate(3.5 3.5) scale(0.45)"/>
								</svg>
							<?php endif; ?>
						</span>
						<span class="sc-program__price">
							<?php
							printf(
								/* translators: %s: monthly price. */
								esc_html__( '%s/mo', 'successcircles' ),
								esc_html( successcircles_program_price( $sc_index, $sc_card['price'] ) )
							);
							?>
						</span>
					</div>

					<h3 class="sc-program__title"><?php echo esc_html( $sc_card['title'] ); ?></h3>

					<?php if ( '' !== $sc_card['flag'] ) : ?>
						<p class="sc-program__flag"><?php echo esc_html( $sc_card['flag'] ); ?></p>
					<?php endif; ?>

					<p class="sc-program__text"><?php echo esc_html( wp_specialchars_decode( $sc_card['text'] ) ); ?></p>

					<ul class="sc-program__list">
						<?php foreach ( (array) $sc_card['features'] as $sc_feature ) : ?>
							<li><?php echo esc_html( $sc_feature ); ?></li>
						<?php endforeach; ?>
					</ul>

					<a
						class="sc-btn sc-btn--sm <?php echo ! empty( $sc_card['featured'] ) ? 'sc-btn--primary' : 'sc-btn--ghost'; ?>"
						href="<?php echo successcircles_url( $sc_card['cta_url'] ); ?>"
						target="_blank" rel="noopener noreferrer"
					>
						<?php echo esc_html( $sc_card['cta'] ); ?>
					</a>
				</article>
			<?php endforeach; ?>
		</div>

		<p class="sc-programs__note">
			<?php echo esc_html( $sc_note['before'] ); ?>
			<a class="sc-inline-link" <?php successcircles_test_link_attrs(); ?>><?php echo esc_html( $sc_note['link'] ); ?></a>
			<?php echo esc_html( $sc_note['after'] ); ?>
		</p>

	</div>
</section>
