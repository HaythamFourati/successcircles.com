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

<article <?php post_class( 'sc-contactpage' ); ?>>

	<section class="sc-section sc-contactpage__open" aria-labelledby="sc-contact-title">

		<div class="sc-contactpage__intro">
			<?php successcircles_eyebrow( '', $sc_copy['eyebrow'] ); ?>

			<h1 id="sc-contact-title" class="sc-display sc-display--xl">
				<?php echo successcircles_inline( $sc_copy['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h1>

			<p class="sc-contactpage__lede">
				<?php echo esc_html( wp_specialchars_decode( $sc_copy['lede'] ) ); ?>
			</p>

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
								<?php echo esc_html( $sc_link['label'] ); ?>
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
				<?php successcircles_contact_form(); ?>
			</div>

		</div>
	</section>

	<?php // ContactPage + Organization structured data lives in inc/schema.php. ?>

</article>

<?php
get_footer();
