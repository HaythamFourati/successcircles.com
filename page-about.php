<?php
/**
 * The About page.
 *
 * Automatically used for a page with the slug "about" — which is where the live
 * site's Core Values live too, at /about/#corevalues. The nav's "Core Values"
 * item points at that anchor, so the values section must keep id="corevalues".
 *
 * The designed sections are
 * driven by the `about` block in inc/content.php — edit the copy there, not here.
 * Anything typed into the page editor renders inside the opener, so the page stays
 * useful in wp-admin without the designed sections depending on it.
 *
 * Composition: every section is shaped differently on purpose (statement + bleed,
 * dominant sentence, portrait split, alternating rows, growing arc). See the
 * "About page" block in main.css for why, and read that before flattening any of
 * it back into a uniform two-column rhythm.
 *
 * Band rhythm: sand → shade → dark → sand/curtain → dark, then the shared founder
 * section. Both `values` and `founder` carry .sc-band--curtain, which is designed
 * to lift over a DARK band — so the sections above them must stay dark.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_about   = (array) successcircles_content( 'about', array() );
$sc_mission = (array) successcircles_content( 'about.mission', array() );
$sc_vision  = (array) successcircles_content( 'about.vision', array() );
$sc_values  = (array) successcircles_content( 'about.values', array() );
$sc_story   = (array) successcircles_content( 'about.story', array() );

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'sc-page' ); ?>>

		<div class="sc-about__opener">
			<h1 class="sc-display sc-display--xl sc-about__title sc-rise" style="--sc-rise-delay:1s">
				<?php echo successcircles_inline( $sc_about['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h1>

			<div class="sc-about__intro sc-rise" style="--sc-rise-delay:1.1s">
				<p class="sc-about__statement">
					<?php echo esc_html( wp_specialchars_decode( $sc_about['lede'] ) ); ?>
				</p>

				<ul class="sc-about__facts">
					<?php foreach ( (array) $sc_about['meta'] as $sc_fact ) : ?>
						<li><?php echo esc_html( $sc_fact ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<?php if ( trim( get_the_content() ) ) : ?>
			<div class="sc-prose">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>

		<figure class="sc-about__bleed sc-rise" style="--sc-rise-delay:1.2s">
			<img
				src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/hero-huddle.jpg' ); ?>"
				alt="<?php echo esc_attr( $sc_about['bleed_alt'] ); ?>"
				width="1267"
				height="713"
				fetchpriority="high"
				decoding="async"
			>
			<figcaption class="sc-about__bleed-note">
				<?php esc_html_e( 'Peer to peer, since 2005', 'successcircles' ); ?>
			</figcaption>
		</figure>

	</article>
	<?php
endwhile;
?>

<section class="sc-band--shade sc-band--hairline" aria-labelledby="sc-about-mission-title">
	<div class="sc-section sc-about__pull">
		<h2 id="sc-about-mission-title" class="sc-display sc-about__pull-title">
			<?php echo successcircles_inline( $sc_mission['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</h2>

		<div>
			<p class="sc-about__pull-body">
				<?php echo esc_html( wp_specialchars_decode( $sc_mission['lede'] ) ); ?>
			</p>
			<p class="sc-about__pull-body" style="margin-top:20px">
				<?php echo esc_html( wp_specialchars_decode( $sc_mission['body'] ) ); ?>
			</p>
		</div>
	</div>
</section>

<section class="sc-band--dark" aria-labelledby="sc-about-vision-title">
	<div class="sc-section sc-about__vision">
		<figure class="sc-about__vision-media">
			<img
				src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/problem-lonely.jpg' ); ?>"
				alt="<?php echo esc_attr( $sc_vision['image_alt'] ); ?>"
				width="1074"
				height="805"
				loading="lazy"
				decoding="async"
			>
			<span class="sc-about__vision-ring" aria-hidden="true"></span>
		</figure>

		<div>
			<h2 id="sc-about-vision-title" class="sc-display sc-display--lg">
				<?php echo successcircles_inline( $sc_vision['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h2>

			<div class="sc-prose" style="margin-top:28px">
				<?php foreach ( (array) $sc_vision['body'] as $sc_paragraph ) : ?>
					<p><?php echo esc_html( wp_specialchars_decode( $sc_paragraph ) ); ?></p>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<section id="corevalues" class="sc-band--sand sc-band--curtain" aria-labelledby="sc-about-values-title">
	<div class="sc-section">
		<h2 id="sc-about-values-title" class="sc-display sc-display--lg" style="max-width:18ch">
			<?php echo successcircles_inline( $sc_values['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</h2>

		<p class="sc-lede" style="margin-top:24px">
			<?php echo esc_html( wp_specialchars_decode( $sc_values['lede'] ) ); ?>
		</p>

		<div class="sc-about__vows">
			<?php foreach ( (array) $sc_values['items'] as $sc_item ) : ?>
				<div class="sc-about__vow">
					<h3 class="sc-about__vow-title">
						<?php echo esc_html( wp_specialchars_decode( $sc_item['title'] ) ); ?>
					</h3>
					<p class="sc-about__vow-text">
						<?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?>
					</p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="sc-band--dark" aria-labelledby="sc-about-story-title">
	<div class="sc-section">
		<div class="sc-about__story-top">
			<figure class="sc-about__story-media">
				<img
					src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/about-story.jpg' ); ?>"
					alt="<?php esc_attr_e( 'Joseph Varghese speaking with a peer in the early days of SuccessCircles', 'successcircles' ); ?>"
					width="687"
					height="1031"
					loading="lazy"
					decoding="async"
				>
			</figure>

			<div class="sc-about__story-text">
				<h2 id="sc-about-story-title" class="sc-display sc-display--lg sc-about__story-title">
					<?php echo successcircles_inline( $sc_story['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</h2>

				<div class="sc-prose sc-about__story-body">
					<?php foreach ( (array) $sc_story['body'] as $sc_paragraph ) : ?>
						<p><?php echo esc_html( wp_specialchars_decode( $sc_paragraph ) ); ?></p>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<div class="sc-about__arc">
			<?php foreach ( (array) $sc_story['arc'] as $sc_point ) : ?>
				<div class="sc-about__arc-item">
					<span class="sc-about__arc-ring" style="--sc-arc-scale:<?php echo esc_attr( $sc_point['scale'] ); ?>" aria-hidden="true"></span>
					<p class="sc-about__arc-figure"><?php echo esc_html( $sc_point['figure'] ); ?></p>
					<p class="sc-about__arc-label"><?php echo esc_html( wp_specialchars_decode( $sc_point['label'] ) ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/home/founder' );
get_template_part( 'template-parts/home/cta' );

get_footer();
