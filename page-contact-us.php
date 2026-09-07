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
				<a class="sc-btn sc-btn--primary" href="#sc-contact-form"><?php esc_html_e( 'Send Us a Message', 'successcircles' ); ?></a>
				<a class="ct-faq-link" href="<?php echo successcircles_url( '/faq/' ); ?>"><?php esc_html_e( 'Browse Common Questions', 'successcircles' ); ?> <span aria-hidden="true">↗</span></a>
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

					<a class="sc-channel__value" href="<?php echo esc_url( $sc_channel['url'] ); ?>"<?php echo 0 === strpos( $sc_channel['url'], 'http' ) ? ' rel="noopener"' : ''; ?>>
						<?php echo esc_html( wp_specialchars_decode( $sc_channel['value'] ) ); ?>
					</a>

					<?php if ( ! empty( $sc_channel['detail'] ) ) : ?>
						<p class="sc-channel__detail"><?php echo esc_html( wp_specialchars_decode( $sc_channel['detail'] ) ); ?></p>
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
								$sc_icon = strtolower( $sc_link['label'] );
								if ( 'linkedin' === $sc_icon ) :
									?>
									<svg class="sc-social-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.45-2.13 2.94v5.67H9.35V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.45v6.29zM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12zM7.12 20.45H3.55V9h3.57v11.45zM22.22 0H1.77C.79 0 0 .77 0 1.73v20.54C0 23.23.79 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.73V1.73C24 .77 23.2 0 22.22 0z"/></svg>
									<?php
								elseif ( 'youtube' === $sc_icon ) :
									?>
									<svg class="sc-social-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.5 6.2a3.02 3.02 0 0 0-2.12-2.14C19.5 3.55 12 3.55 12 3.55s-7.5 0-9.38.51A3.02 3.02 0 0 0 .5 6.2C0 8.08 0 12 0 12s0 3.92.5 5.8a3.02 3.02 0 0 0 2.12 2.14c1.88.51 9.38.51 9.38.51s7.5 0 9.38-.51a3.02 3.02 0 0 0 2.12-2.14C24 15.92 24 12 24 12s0-3.92-.5-5.8zM9.55 15.57V8.43L15.82 12l-6.27 3.57z"/></svg>
									<?php
								elseif ( 'facebook' === $sc_icon ) :
									?>
									<svg class="sc-social-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.02 1.79-4.69 4.53-4.69 1.31 0 2.69.24 2.69.24v2.97h-1.52c-1.49 0-1.96.93-1.96 1.89v2.25h3.33l-.53 3.49h-2.8V24C19.61 23.1 24 18.1 24 12.07z"/></svg>
									<?php
								elseif ( 'x' === $sc_icon ) :
									?>
									<svg class="sc-social-icon" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.9 1.15h3.68l-8.04 9.19L24 22.85h-7.41l-5.8-7.58-6.63 7.58H.48l8.6-9.83L0 1.15h7.6l5.24 6.93 6.06-6.93zm-1.29 19.5h2.04L6.49 3.24H4.3L17.61 20.65z"/></svg>
									<?php
								endif;
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
