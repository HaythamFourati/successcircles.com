<?php
/**
 * 03 / Programs.
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
			<?php successcircles_eyebrow( $sc_programs['index'], $sc_programs['eyebrow'] ); ?>
			<h2 id="sc-programs-title" class="sc-display sc-display--xl sc-programs__title">
				<?php echo successcircles_inline( $sc_programs['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h2>
			<div class="sc-programs__lede-grid">
				<span aria-hidden="true"></span>
				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_programs['lede'] ) ); ?></p>
			</div>
		</div>

		<div class="sc-programs__cards">
			<?php foreach ( (array) $sc_programs['cards'] as $sc_index => $sc_card ) : ?>
				<article class="sc-program<?php echo $sc_card['featured'] ? ' sc-program--featured' : ''; ?>">
					<div class="sc-program__meta">
						<span class="sc-program__kind"><?php echo esc_html( $sc_card['kind'] ); ?></span>
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

					<p class="sc-program__text">
						<?php if ( '' !== $sc_card['flag'] ) : ?>
							<span class="sc-program__flag"><?php echo esc_html( $sc_card['flag'] ); ?></span>
						<?php endif; ?>
						<?php echo esc_html( wp_specialchars_decode( $sc_card['text'] ) ); ?>
					</p>

					<ul class="sc-program__list">
						<?php foreach ( (array) $sc_card['features'] as $sc_feature ) : ?>
							<li><?php echo esc_html( $sc_feature ); ?></li>
						<?php endforeach; ?>
					</ul>

					<a
						class="sc-btn sc-btn--sm <?php echo $sc_card['featured'] ? 'sc-btn--primary' : 'sc-btn--ghost'; ?>"
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

		<div class="sc-includes">
			<?php foreach ( (array) $sc_programs['includes'] as $sc_item ) : ?>
				<div class="sc-includes__item">
					<h3 class="sc-includes__title"><?php echo esc_html( $sc_item['title'] ); ?></h3>
					<p class="sc-includes__text"><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
