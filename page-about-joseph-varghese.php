<?php
/**
 * The Joseph Varghese page.
 *
 * Automatically used for a page with the slug "about-joseph-varghese" — the
 * same slug the live site uses, so the nav keeps working after migration. Copy
 * is the `founder_page` block in inc/content.php, transcribed verbatim from
 * successcircles.com/about-joseph-varghese/.
 *
 * Composition: the opener splits a mono fact rail against the cut-out portrait
 * on a dark band, so the transparent PNG reads as a figure rather than a photo
 * in a box. The three narrative sections then run as a single measured column
 * with a display-face pull-quote breaking the second one, and the mastermind
 * plate closes before the CTA.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_jv       = (array) successcircles_content( 'founder_page', array() );
$sc_portrait = (array) $sc_jv['portrait'];
$sc_plate    = (array) $sc_jv['plate'];
$sc_sections = (array) $sc_jv['sections'];

get_header();

?>
<section class="sc-band--dark sc-jv__open" aria-labelledby="sc-jv-title">
	<div class="sc-section sc-jv__opener">

		<div class="sc-jv__rail">
			<?php successcircles_eyebrow( '', $sc_jv['eyebrow'] ); ?>

			<h1 id="sc-jv-title" class="sc-display sc-display--xl">
				<?php echo successcircles_inline( $sc_jv['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h1>

			<ul class="sc-jv__roles">
				<?php foreach ( (array) $sc_jv['roles'] as $sc_role ) : ?>
					<li><?php echo esc_html( wp_specialchars_decode( $sc_role ) ); ?></li>
				<?php endforeach; ?>
			</ul>

			<p class="sc-lede sc-jv__lede">
				<?php echo esc_html( wp_specialchars_decode( $sc_jv['lede'] ) ); ?>
			</p>
		</div>

		<figure class="sc-jv__portrait">
			<span class="sc-jv__portrait-ring" aria-hidden="true"></span>
			<img
				src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/about/' . $sc_portrait['file'] ); ?>"
				alt="<?php echo esc_attr( $sc_portrait['alt'] ); ?>"
				width="<?php echo esc_attr( (string) $sc_portrait['width'] ); ?>"
				height="<?php echo esc_attr( (string) $sc_portrait['height'] ); ?>"
				fetchpriority="high"
				decoding="async"
			>
		</figure>

	</div>
</section>

<section class="sc-band--sand sc-band--curtain" aria-label="<?php esc_attr_e( 'Joseph Varghese, in full', 'successcircles' ); ?>">
	<div class="sc-section sc-jv__body">

		<div class="sc-prose sc-jv__intro">
			<?php foreach ( (array) $sc_jv['intro'] as $sc_paragraph ) : ?>
				<p><?php echo esc_html( wp_specialchars_decode( $sc_paragraph ) ); ?></p>
			<?php endforeach; ?>
		</div>

		<?php
		while ( have_posts() ) :
			the_post();

			if ( trim( get_the_content() ) ) :
				?>
				<div class="sc-prose sc-jv__intro"><?php the_content(); ?></div>
				<?php
			endif;
		endwhile;
		?>

		<?php foreach ( $sc_sections as $sc_index => $sc_section ) : ?>
			<section class="sc-jv__chapter" aria-labelledby="sc-jv-<?php echo esc_attr( (string) $sc_index ); ?>">
				<h2 id="sc-jv-<?php echo esc_attr( (string) $sc_index ); ?>" class="sc-display sc-display--md sc-jv__chapter-title">
					<?php echo successcircles_inline( $sc_section['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</h2>

				<div class="sc-prose">
					<?php foreach ( (array) $sc_section['body'] as $sc_paragraph ) : ?>
						<p><?php echo esc_html( wp_specialchars_decode( $sc_paragraph ) ); ?></p>
					<?php endforeach; ?>
				</div>

				<?php if ( 1 === $sc_index && ! empty( $sc_jv['quote'] ) ) : ?>
					<blockquote class="sc-jv__quote">
						<?php echo esc_html( wp_specialchars_decode( $sc_jv['quote'] ) ); ?>
					</blockquote>
				<?php endif; ?>
			</section>
		<?php endforeach; ?>

	</div>

	<figure class="sc-jv__plate">
		<img
			src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/about/' . $sc_plate['file'] ); ?>"
			alt="<?php echo esc_attr( $sc_plate['alt'] ); ?>"
			width="<?php echo esc_attr( (string) $sc_plate['width'] ); ?>"
			height="<?php echo esc_attr( (string) $sc_plate['height'] ); ?>"
			loading="lazy"
			decoding="async"
		>
	</figure>
</section>

<?php

get_template_part( 'template-parts/home/cta' );

get_footer();
