<?php
/**
 * Trustpilot band, styled after Trustpilot's dark Carousel TrustBox.
 *
 * Rating and count are live (inc/trustpilot.php, hourly); the quotes are the
 * reviews pasted into inc/trustpilot-reviews.json. Sits on the dark run after the trust bar so
 * the problem section's curtain still lifts over a dark band.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_tp      = successcircles_trustpilot();
$sc_reviews = successcircles_trustpilot_reviews();
$sc_profile = successcircles_content( 'trustpilot.profile_url' );

// The brand file's dark wordmark follows the band's text colour; the green star stays.
$sc_logo = str_replace( '#191919', 'currentColor', (string) file_get_contents( SUCCESSCIRCLES_DIR . '/assets/img/trustpilot.svg' ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions
$sc_logo = str_replace( '<svg ', '<svg class="sc-tpw__logo" role="img" aria-label="Trustpilot" ', $sc_logo );
?>
<section class="sc-tpw sc-band--dark" aria-label="<?php esc_attr_e( 'Trustpilot reviews', 'successcircles' ); ?>" data-sc-tpw>
	<div class="sc-tpw__inner">
		<a class="sc-tpw__summary" href="<?php echo esc_url( $sc_profile ); ?>" target="_blank" rel="noopener">
			<strong class="sc-tpw__label"><?php echo esc_html( $sc_tp['label'] ); ?></strong>
			<?php successcircles_trustpilot_stars( (float) $sc_tp['stars'], 'sc-tpw__stars--lg' ); ?>
			<span class="sc-tpw__count">
				<?php
				/* translators: %s: number of reviews */
				echo esc_html( sprintf( _n( 'Based on %s review', 'Based on %s reviews', (int) $sc_tp['total'], 'successcircles' ), number_format_i18n( (int) $sc_tp['total'] ) ) );
				?>
			</span>
			<?php echo $sc_logo; // phpcs:ignore WordPress.Security.EscapeOutput -- theme's own SVG file. ?>
		</a>

		<?php if ( $sc_reviews ) : ?>
		<div class="sc-tpw__carousel">
			<button class="sc-tpw__arrow" type="button" data-sc-tpw-step="-1" aria-label="<?php esc_attr_e( 'Previous reviews', 'successcircles' ); ?>" hidden>&#8249;</button>
			<ul class="sc-tpw__track" role="list" tabindex="0">
				<?php foreach ( $sc_reviews as $sc_review ) : ?>
				<li class="sc-tpw__card">
					<figure>
						<?php successcircles_trustpilot_stars( $sc_review['rating'] ); ?>
						<blockquote class="sc-tpw__text">
							<p class="sc-tpw__title"><?php echo esc_html( $sc_review['title'] ); ?></p>
							<?php if ( '' !== $sc_review['text'] ) : ?>
							<p><?php echo esc_html( $sc_review['text'] ); ?></p>
							<?php endif; ?>
						</blockquote>
						<figcaption class="sc-tpw__meta">
							<strong><?php echo esc_html( $sc_review['name'] ); ?></strong>,
							<time datetime="<?php echo esc_attr( gmdate( 'Y-m-d', $sc_review['date'] ) ); ?>"><?php echo esc_html( date_i18n( 'M j, Y', $sc_review['date'] ) ); ?></time>
						</figcaption>
					</figure>
				</li>
				<?php endforeach; ?>
			</ul>
			<button class="sc-tpw__arrow" type="button" data-sc-tpw-step="1" aria-label="<?php esc_attr_e( 'Next reviews', 'successcircles' ); ?>" hidden>&#8250;</button>
		</div>
		<?php endif; ?>
	</div>
</section>
