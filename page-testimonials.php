<?php
/**
 * The Testimonials page.
 *
 * Automatically used for a page with the slug "testimonials". Eleven member
 * films and eight written testimonials, all transcribed from
 * successcircles.com/testimonials/ into the `testimonials` block of
 * inc/content.php. Weekly member wins are a different thing entirely and live
 * on their own page — see page-weekly-wins.php.
 *
 * Composition: the opener splits, with the heading holding the left rail while
 * the first film plays at full width on the right. The remaining films fall
 * into a grid on a shade band, then the written testimonials take the quote
 * wall. Every film is a click-to-play facade — no Vimeo request on load.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_copy   = (array) successcircles_content( 'testimonials', array() );
$sc_link   = (array) $sc_copy['link'];
$sc_films  = (array) $sc_copy['videos'];
$sc_quotes = (array) $sc_copy['quotes'];

// The first film leads the page; the rest fall into the grid below.
$sc_lead = array_shift( $sc_films );

get_header();

?>
<section class="sc-section sc-voices" aria-labelledby="sc-voices-title">

	<div class="sc-voices__open sc-voices__open--film">

		<div class="sc-voices__rail">
			<?php successcircles_eyebrow( '', $sc_copy['eyebrow'] ); ?>
			<h1 id="sc-voices-title" class="sc-display sc-display--lg">
				<?php echo successcircles_inline( $sc_copy['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h1>
			<p class="sc-voices__lede">
				<?php echo esc_html( wp_specialchars_decode( $sc_copy['lede'] ) ); ?>
			</p>
			<a class="sc-link-rule" href="<?php echo successcircles_url( $sc_link['url'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
				<?php echo esc_html( wp_specialchars_decode( $sc_link['label'] ) ); ?>
			</a>
		</div>

		<?php
		if ( $sc_lead ) {
			get_template_part(
				'template-parts/film',
				null,
				array(
					'film'     => $sc_lead,
					'play'     => $sc_copy['play_label'],
					'featured' => true,
				)
			);
		}
		?>

	</div>

	<?php
	while ( have_posts() ) :
		the_post();

		if ( trim( get_the_content() ) ) :
			?>
			<div class="sc-prose sc-voices__intro"><?php the_content(); ?></div>
			<?php
		endif;
	endwhile;
	?>

</section>

<?php if ( $sc_films ) : ?>
	<section class="sc-band--shade sc-band--hairline" aria-labelledby="sc-films-title">
		<div class="sc-section">
			<div class="sc-films__head">
				<div>
					<?php successcircles_eyebrow( '', $sc_copy['films_eyebrow'] ); ?>
					<h2 id="sc-films-title" class="sc-display sc-display--md">
						<?php echo esc_html( wp_specialchars_decode( $sc_copy['films_title'] ) ); ?>
					</h2>
				</div>
				<p class="sc-films__note"><?php echo esc_html( wp_specialchars_decode( $sc_copy['films_note'] ) ); ?></p>
			</div>

			<div class="sc-films">
				<?php
				foreach ( $sc_films as $sc_film ) {
					get_template_part(
						'template-parts/film',
						null,
						array(
							'film' => $sc_film,
							'play' => $sc_copy['play_label'],
						)
					);
				}
				?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if ( $sc_quotes ) : ?>
	<section class="sc-band--sand sc-band--hairline" aria-labelledby="sc-written-title">
		<div class="sc-section">
			<?php successcircles_eyebrow( '', $sc_copy['written_eyebrow'] ); ?>
			<h2 id="sc-written-title" class="sc-display sc-display--md sc-written__title">
				<?php echo esc_html( wp_specialchars_decode( $sc_copy['written_title'] ) ); ?>
			</h2>

			<div class="sc-wall sc-wall--long">
				<?php foreach ( $sc_quotes as $sc_quote ) : ?>
					<figure class="sc-wall__item">
						<blockquote class="sc-wall__text">
							<?php echo esc_html( wp_specialchars_decode( $sc_quote['text'] ) ); ?>
						</blockquote>
						<figcaption class="sc-quote__by">
							<span class="sc-quote__rule" aria-hidden="true"></span>
							<span class="sc-quote__name"><?php echo esc_html( $sc_quote['name'] ); ?></span>
							<?php if ( $sc_quote['role'] ) : ?>
								<span class="sc-quote__role"><?php echo esc_html( wp_specialchars_decode( $sc_quote['role'] ) ); ?></span>
							<?php endif; ?>
						</figcaption>
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php

get_template_part( 'template-parts/home/cta' );

get_footer();
