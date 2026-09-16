<?php
/**
 * The Contact page.
 *
 * Automatically used for a page with the slug "contact-us". Copy lives in the
 * `contact` block of inc/content.php; the form is rendered by
 * successcircles_contact_form() — Contact Form 7 when it is active (see
 * inc/cf7.php), the theme's own plugin-free form otherwise.
 *
 * Composition — the direct lines come first, because most people arriving here
 * already know how they want to reach us: a direct opener followed by a row of
 * contact channels, each one a real link. The
 * form sits below on its own shaded band, paired with the three things that
 * happen after you press send, so the page answers "and then what?" without
 * being asked. ContactPage / Organization structured data closes it out.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_copy     = (array) successcircles_content( 'contact', array() );
$sc_channels = (array) ( $sc_copy['channels'] ?? array() );
$sc_steps    = (array) ( $sc_copy['steps'] ?? array() );
$sc_form     = (array) ( $sc_copy['form'] ?? array() );
$sc_social   = (array) successcircles_content( 'footer.social', array() );

get_header();
?>

<article <?php post_class( 'sc-contactpage ct-page' ); ?>>

	<section class="sc-section sc-contactpage__open" aria-labelledby="sc-contact-title">

		<div class="sc-contactpage__intro">
			<?php successcircles_eyebrow( '', $sc_copy['eyebrow'] ); ?>

			<h1 id="sc-contact-title" class="sc-display sc-display--xl">
				<?php echo successcircles_inline( $sc_copy['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h1>

			<p class="sc-contactpage__lede">
				<?php echo esc_html( wp_specialchars_decode( $sc_copy['lede'] ) ); ?>
			</p>
			<div class="sc-actions sc-actions--center ct-actions">
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( successcircles_page_link( 'contact_us_sc_contact_form' ) ); ?>"><?php esc_html_e( 'Send Us a Message', 'successcircles' ); ?></a>
				<a class="ct-faq-link" href="<?php echo esc_url( successcircles_page_link( 'contact_us_faq' ) ); ?>"><?php esc_html_e( 'Browse Common Questions', 'successcircles' ); ?> <span aria-hidden="true">↗</span></a>
			</div>

			<?php
			while ( have_posts() ) :
				the_post();

				if ( trim( get_the_content() ) ) :
					?>
					<div class="sc-prose sc-contactpage__body"><?php the_content(); ?></div>
					<?php
				endif;
			endwhile;
			?>
		</div>

		<ul class="sc-channels">
			<?php foreach ( $sc_channels as $sc_channel ) : ?>
				<li class="sc-channel">
					<p class="sc-channel__label"><?php echo esc_html( wp_specialchars_decode( $sc_channel['label'] ) ); ?></p>

					<a class="sc-channel__value" href="<?php echo successcircles_url( $sc_channel['url'] ); ?>"<?php echo 0 === strpos( $sc_channel['url'], 'http' ) ? ' rel="noopener"' : ''; ?>>
						<?php echo esc_html( wp_specialchars_decode( $sc_channel['value'] ) ); ?>
					</a>

					<?php if ( ! empty( $sc_channel['detail'] ) ) : ?>
						<p class="sc-channel__detail"><?php echo esc_html( wp_specialchars_decode( $sc_channel['detail'] ) ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $sc_channel['links'] ) ) : ?>
						<ul class="sc-channel__links">
							<?php foreach ( (array) $sc_channel['links'] as $sc_chip ) : ?>
								<li>
									<a class="sc-channel__chip" href="<?php echo esc_url( $sc_chip['url'] ); ?>" rel="noopener">
										<?php
										$sc_chip_icon = strtolower( $sc_chip['label'] );
										if ( 'whatsapp' === $sc_chip_icon ) :
											?>
											<svg class="sc-social-icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.47 14.38c-.3-.15-1.75-.86-2.02-.96-.27-.1-.47-.15-.67.15-.2.3-.79.96-.94 1.16-.15.2-.3.22-.6.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.48-1.77-1.65-2.07-.17-.3-.02-.46.13-.61.13-.13.3-.35.44-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.6-.92-2.19-.24-.57-.49-.48-.67-.49h-.57c-.2 0-.52.07-.79.37-.27.3-1.03 1.01-1.03 2.46 0 1.45 1.06 2.86 1.2 3.06.15.2 2.07 3.31 5.03 4.52 2.46 1 2.96.8 3.49.75.53-.05 1.72-.7 1.96-1.38.24-.68.24-1.26.17-1.38-.07-.12-.27-.2-.57-.35zM12.05 21.8h-.01a9.7 9.7 0 0 1-4.95-1.36l-.35-.21-3.68.96.99-3.59-.23-.37a9.7 9.7 0 0 1-1.49-5.19c0-5.37 4.37-9.74 9.74-9.74a9.68 9.68 0 0 1 9.73 9.75c0 5.37-4.37 9.75-9.75 9.75zM20.52 3.49A11.78 11.78 0 0 0 12.05 0C5.5 0 .18 5.32.17 11.86c0 2.09.55 4.13 1.59 5.93L0 24l6.35-1.67a11.85 11.85 0 0 0 5.69 1.45h.01c6.54 0 11.86-5.32 11.87-11.87 0-3.17-1.23-6.15-3.4-8.42z"/></svg>
											<?php
										elseif ( 'telegram' === $sc_chip_icon ) :
											?>
											<svg class="sc-social-icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.23-1.86 8.79c-.14.62-.51.77-1.03.48l-2.85-2.1-1.37 1.32c-.15.15-.28.28-.57.28l.2-2.9 5.3-4.79c.23-.2-.05-.32-.35-.12l-6.55 4.12-2.82-.88c-.61-.19-.62-.61.13-.9l11.02-4.25c.51-.18.96.12.8.85z"/></svg>
											<?php
										endif;
										?>
										<span><?php echo esc_html( $sc_chip['label'] ); ?></span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<p class="sc-channel__note"><?php echo esc_html( wp_specialchars_decode( $sc_channel['note'] ) ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php if ( $sc_social ) : ?>
			<div class="sc-contactpage__social">
				<p class="sc-contactpage__social-label">
					<?php echo esc_html( wp_specialchars_decode( $sc_copy['social']['label'] ) ); ?>
				</p>
				<ul class="sc-contactpage__social-list">
					<?php foreach ( $sc_social as $sc_link ) : ?>
						<li>
							<a href="<?php echo esc_url( successcircles_social_url( $sc_link ) ); ?>" rel="noopener">
								<?php
								echo successcircles_social_icon( $sc_link['label'] ); // phpcs:ignore WordPress.Security.EscapeOutput
								?>
								<span><?php echo esc_html( $sc_link['label'] ); ?></span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

	</section>

	<section class="sc-band--shade sc-band--hairline" aria-labelledby="sc-contact-form-title">
		<div class="sc-section sc-contactpage__form-band">

			<div class="sc-contactpage__aside">
				<?php successcircles_eyebrow( '', $sc_form['eyebrow'] ); ?>

				<h2 id="sc-contact-form-title" class="sc-display sc-display--md">
					<?php echo esc_html( wp_specialchars_decode( $sc_form['title'] ) ); ?>
				</h2>

				<p class="sc-contactpage__form-lede">
					<?php echo esc_html( wp_specialchars_decode( $sc_form['lede'] ) ); ?>
				</p>

				<?php if ( $sc_steps ) : ?>
					<ol class="sc-steps">
						<?php foreach ( $sc_steps as $sc_i => $sc_step ) : ?>
							<li class="sc-steps__item">
								<span class="sc-steps__num" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $sc_i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
								<h3 class="sc-steps__title"><?php echo esc_html( wp_specialchars_decode( $sc_step['title'] ) ); ?></h3>
								<p class="sc-steps__text"><?php echo esc_html( wp_specialchars_decode( $sc_step['text'] ) ); ?></p>
							</li>
						<?php endforeach; ?>
					</ol>
				<?php endif; ?>
			</div>

			<div class="sc-contactpage__form" id="sc-contact-form">
				<p class="ct-form-label"><?php esc_html_e( 'Your message', 'successcircles' ); ?></p>
				<?php successcircles_contact_form(); ?>
			</div>

		</div>
	</section>

	<?php // ContactPage + Organization structured data lives in inc/schema.php. ?>

</article>

<?php
get_footer();
