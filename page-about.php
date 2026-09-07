<?php
/**
 * The About page.
 *
 * Automatically used for a page with the slug "about" — which is where the live
 * site's Core Values live too. The nav's "Core Values" item now points at plain
 * /about/, but the values section keeps id="corevalues" on purpose: the live
 * site published /about/#corevalues, so inbound links to that anchor still land
 * in the right place. Keep the id even though the nav no longer needs it.
 *
 * The designed sections are
 * driven by the `about` block in inc/content.php — edit the copy there, not here.
 * Anything typed into the page editor renders inside the opener, so the page stays
 * useful in wp-admin without the designed sections depending on it.
 *
 * Composition: every section is shaped differently on purpose (statement + bleed,
 * dominant sentence, portrait split, stacked vows, growing arc). See the
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
?>
<div class="ab-page">
<?php

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'sc-page' ); ?>>

		<div class="sc-about__opener">
			<div class="sc-about__opener-left">
				<div class="sc-rise" style="--sc-rise-delay:0.2s">
					<?php successcircles_eyebrow( '', __( 'Our Story', 'successcircles' ), 'sc-eyebrow--accent' ); ?>
				</div>
				<h1 class="sc-display sc-display--xl sc-about__title sc-rise" style="--sc-rise-delay:0.3s">
					<?php echo successcircles_inline( $sc_about['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</h1>
			</div>

			<div class="sc-about__intro sc-rise" style="--sc-rise-delay:0.4s">
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

		<nav class="ab-nav" aria-label="<?php esc_attr_e( 'Explore our story', 'successcircles' ); ?>">
			<a href="#our-approach">Our Approach <span aria-hidden="true">↓</span></a>
			<a href="#corevalues">Our Values <span aria-hidden="true">↓</span></a>
			<a href="#our-beginnings">Our Beginnings <span aria-hidden="true">↓</span></a>
			<a href="#founder">Meet the Founder <span aria-hidden="true">↓</span></a>
		</nav>

		<?php if ( trim( get_the_content() ) ) : ?>
			<div class="sc-prose">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>

		<figure class="sc-about__bleed sc-rise" style="--sc-rise-delay:0.5s">
			<img
				src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/hero-huddle.jpg?v=' . successcircles_asset_version( '/assets/img/hero-huddle.jpg' ) ); ?>"
				alt="<?php echo esc_attr( $sc_about['bleed_alt'] ); ?>"
				width="1170"
				height="780"
				fetchpriority="high"
				decoding="async"
			>
			<figcaption class="sc-about__bleed-note">
				<?php esc_html_e( 'Owners supporting owners, since 2005', 'successcircles' ); ?>
			</figcaption>
		</figure>

	</article>
	<?php
endwhile;
?>

<section id="our-approach" class="sc-band--shade sc-band--hairline" aria-labelledby="sc-about-mission-title">
	<div class="sc-section sc-about__pull" data-sc-rhythm>
		<div class="sc-about__pull-left">
			<h2 id="sc-about-mission-title" class="sc-display sc-about__pull-title">
				<?php echo successcircles_inline( $sc_mission['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h2>
			<p class="sc-about__pull-body">
				<?php echo esc_html( wp_specialchars_decode( $sc_mission['lede'] ) ); ?>
			</p>
			<p class="sc-about__pull-body">
				<?php echo esc_html( wp_specialchars_decode( $sc_mission['body'] ) ); ?>
			</p>
		</div>

		<div class="sc-about__rhythm" role="list" aria-label="<?php esc_attr_e( 'The rhythm of progress', 'successcircles' ); ?>">
			<div class="sc-about__rhythm-track" role="listitem">
				<span class="sc-about__rhythm-node"></span>
				<span class="sc-about__rhythm-day">Choose</span>
				<span class="sc-about__rhythm-label">Priority</span>
			</div>
			<div class="sc-about__rhythm-track" role="listitem">
				<span class="sc-about__rhythm-node"></span>
				<span class="sc-about__rhythm-day">Commit</span>
				<span class="sc-about__rhythm-label">Accountability</span>
			</div>
			<div class="sc-about__rhythm-track" role="listitem">
				<span class="sc-about__rhythm-node"></span>
				<span class="sc-about__rhythm-day">Follow through</span>
				<span class="sc-about__rhythm-label">Action</span>
			</div>
			<div class="sc-about__rhythm-track" role="listitem">
				<span class="sc-about__rhythm-node sc-about__rhythm-node--end"></span>
				<span class="sc-about__rhythm-day">Build on it</span>
				<span class="sc-about__rhythm-label">Progress</span>
			</div>
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

<section id="corevalues" class="sc-band--sand" aria-labelledby="sc-about-values-title">
	<div class="sc-section sc-about__values">
		<div class="sc-about__values-intro">
			<?php if ( ! empty( $sc_values['badge']['file'] ) ) : ?>
				<?php $sc_badge = (array) $sc_values['badge']; ?>
				<img
					class="sc-about__values-badge"
					src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/about/' . $sc_badge['file'] ); ?>"
					alt="<?php echo esc_attr( wp_specialchars_decode( $sc_badge['alt'] ) ); ?>"
					width="<?php echo esc_attr( $sc_badge['width'] ); ?>"
					height="<?php echo esc_attr( $sc_badge['height'] ); ?>"
					loading="lazy"
					decoding="async"
				>
			<?php endif; ?>
			<h2 id="sc-about-values-title" class="sc-display sc-display--lg sc-about__values-title">
				<?php echo successcircles_inline( $sc_values['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h2>
			<p class="sc-about__values-lede">
				<?php echo esc_html( wp_specialchars_decode( $sc_values['lede'] ) ); ?>
			</p>
		</div>

		<div class="sc-about__vows">
			<?php foreach ( (array) $sc_values['items'] as $sc_vow_index => $sc_item ) : ?>
				<div class="sc-about__vow">
					<span class="sc-about__vow-num"><?php echo esc_html( sprintf( '%02d', $sc_vow_index + 1 ) ); ?></span>
					<h3 class="sc-about__vow-title">
						<?php echo successcircles_inline( $sc_item['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</h3>
					<p class="sc-about__vow-text">
						<?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?>
					</p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section id="our-beginnings" class="sc-band--dark" aria-labelledby="sc-about-story-title">
	<div class="sc-section">
		<div class="sc-about__story-top">
			<figure class="sc-about__story-media">
				<img
					src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/about-story.jpg' ); ?>"
					alt="<?php esc_attr_e( 'Joseph Varghese speaking with a peer in the early days of Success Circles', 'successcircles' ); ?>"
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
	</div>
</section>

<?php
get_template_part( 'template-parts/home/founder' );
?>
</div>
<?php
get_template_part( 'template-parts/home/cta' );
get_footer();
