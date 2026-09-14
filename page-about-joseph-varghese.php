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
<div class="jv-page">
<section class="sc-band--dark sc-jv__open" aria-labelledby="sc-jv-title">
	<div class="sc-jv__bg" aria-hidden="true">
		<span class="sc-jv__bg-ring sc-jv__bg-ring--1"></span>
		<span class="sc-jv__bg-ring sc-jv__bg-ring--2"></span>
		<span class="sc-jv__bg-ring sc-jv__bg-ring--3"></span>
	</div>
	<div class="sc-section sc-jv__opener">

		<div class="sc-jv__rail">
			<?php successcircles_eyebrow( '', $sc_jv['eyebrow'] ); ?>

			<h1 id="sc-jv-title" class="sc-display sc-display--xl sc-jv__title">
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
			<div class="jv-actions">
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( successcircles_page_link( 'about_joseph_varghese_joseph_story' ) ); ?>"><?php esc_html_e( 'Discover His Story', 'successcircles' ); ?></a>
				<a class="jv-text-link" href="<?php echo esc_url( esc_url( successcircles_page_link( 'about_joseph_varghese_contact_us' ) ) ); ?>"><?php esc_html_e( 'Get in Touch', 'successcircles' ); ?> <span aria-hidden="true">↗</span></a>
			</div>
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

<section id="joseph-story" class="sc-band--sand" aria-label="<?php esc_attr_e( 'Joseph Varghese, in full', 'successcircles' ); ?>">
	<div class="sc-section sc-jv__body">

		<div class="sc-jv__scroll" aria-hidden="true">
			<span class="sc-jv__scroll-line"></span>
			<svg class="sc-jv__scroll-arrow" width="20" height="12" viewBox="0 0 20 12" fill="none">
				<path d="M1 1L10 10L19 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</div>

		<div class="sc-jv__intro">
			<div class="sc-jv__intro-lead">
				<p class="sc-eyebrow sc-eyebrow--accent sc-jv__intro-eyebrow"><?php esc_html_e( 'The Origin / 2001', 'successcircles' ); ?></p>
				<?php if ( ! empty( $sc_jv['intro'][0] ) ) : ?>
					<h2 class="sc-display sc-jv__intro-display"><?php echo successcircles_inline( $sc_jv['intro'][0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
				<?php endif; ?>
			</div>
			<div class="sc-jv__intro-body">
				<?php foreach ( array_slice( (array) $sc_jv['intro'], 1 ) as $sc_paragraph ) : ?>
					<p><?php echo esc_html( wp_specialchars_decode( $sc_paragraph ) ); ?></p>
				<?php endforeach; ?>
			</div>
		</div>

		<?php
		while ( have_posts() ) :
			the_post();

			if ( trim( get_the_content() ) ) :
				?>
				<div class="sc-prose sc-jv__wp-content"><?php the_content(); ?></div>
				<?php
			endif;
		endwhile;
		?>

		<?php
		$sc_chapter_images = array(
			'/assets/img/team/cohort-sketch.jpg',
			'/assets/img/team/members-live.jpg',
			'/assets/img/about/jv-mastermind.jpg',
		);
		$sc_chapter_image_alts = array(
			__( 'A cohort whiteboard sketch mapping entrepreneur accountability patterns', 'successcircles' ),
			__( 'Success Circles members together at a live cohort dinner', 'successcircles' ),
			__( 'Joseph Varghese leading a mastermind session', 'successcircles' ),
		);
		?>

		<?php foreach ( $sc_sections as $sc_index => $sc_section ) : ?>
			<section class="sc-jv__chapter sc-jv__chapter--<?php echo $sc_index % 2 === 0 ? 'left' : 'right'; ?>" aria-labelledby="sc-jv-<?php echo esc_attr( (string) $sc_index ); ?>">
				<div class="sc-jv__chapter-text">
					<span class="sc-jv__chapter-num"><?php echo esc_html( sprintf( '%02d', $sc_index + 1 ) ); ?></span>
					<h2 id="sc-jv-<?php echo esc_attr( (string) $sc_index ); ?>" class="sc-display sc-display--md sc-jv__chapter-title">
						<?php echo successcircles_inline( $sc_section['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</h2>
					<div class="sc-jv__chapter-prose">
						<?php foreach ( (array) $sc_section['body'] as $sc_paragraph ) : ?>
							<p><?php echo esc_html( wp_specialchars_decode( $sc_paragraph ) ); ?></p>
						<?php endforeach; ?>
					</div>

					<?php if ( 2 === $sc_index ) : ?>
						<p class="sc-jv__chapter-prose sc-jv__chapter-closing"><?php echo esc_html( __( 'Through Success Circles&trade;, Joseph continues to connect entrepreneurs and professionals committed to growth, accountability, and impact &mdash; building the momentum that turns ambitious goals into consistent action.', 'successcircles' ) ); ?></p>
					<?php endif; ?>

					<?php if ( 1 === $sc_index && ! empty( $sc_jv['quote'] ) ) : ?>
						<blockquote class="sc-jv__quote">
							<p><?php echo esc_html( wp_specialchars_decode( $sc_jv['quote'] ) ); ?></p>
							<cite>Joseph Varghese</cite>
						</blockquote>
					<?php endif; ?>
				</div>

				<?php if ( isset( $sc_chapter_images[ $sc_index ] ) ) : ?>
					<figure class="sc-jv__chapter-img">
						<img
							src="<?php echo esc_url( SUCCESSCIRCLES_URI . $sc_chapter_images[ $sc_index ] ); ?>"
							alt="<?php echo esc_attr( $sc_chapter_image_alts[ $sc_index ] ); ?>"
							loading="lazy"
							decoding="async"
						>
					</figure>
				<?php endif; ?>
			</section>
		<?php endforeach; ?>

	</div>
</section>

<?php

?>
</div>
<?php
get_template_part( 'template-parts/home/cta' );
get_footer();
