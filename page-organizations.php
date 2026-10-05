<?php
/**
 * MomentumOS for Organizations & Communities — /momentum-os/organizations/.
 *
 * The B2B/B2Community offering. Copy is the `orgs_page` block of
 * inc/content.php; layout reuses the MomentumOS page's `mos-` styles. Both
 * assessment buttons share one destination (orgs_page.assessment.url,
 * editable under Customizer → Success Circles — Links → MomentumOS).
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_orgs = (array) successcircles_content( 'orgs_page', array() );
$sc_test = successcircles_url( $sc_orgs['assessment']['url'] );

/** Plain text from the content tree, entities intact. */
$sc_text = static function ( $value ) {
	return esc_html( wp_specialchars_decode( (string) $value ) );
};

get_header();
?>
<article class="mos-page org-page">
	<header class="sc-section mos-hero">
		<p class="sc-eyebrow sc-eyebrow--accent"><?php echo $sc_text( $sc_orgs['hero']['eyebrow'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		<h1 class="sc-display"><?php echo successcircles_inline( $sc_orgs['hero']['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h1>
		<p class="mos-lede org-lede"><?php echo $sc_text( $sc_orgs['hero']['lede'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		<p class="mos-lede"><?php echo $sc_text( $sc_orgs['hero']['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		<p class="org-anchor"><?php echo $sc_text( $sc_orgs['anchor'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		<div class="sc-actions sc-actions--center">
			<a class="sc-btn sc-btn--primary" href="<?php echo $sc_test; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"><?php echo $sc_text( $sc_orgs['hero']['cta'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <span aria-hidden="true">→</span></a>
			<a class="sc-btn sc-btn--ghost" href="#partnership"><?php esc_html_e( 'How a Partnership Works', 'successcircles' ); ?></a>
		</div>
	</header>

	<section class="sc-band--dark mos-context" aria-labelledby="org-opportunity-title">
		<div class="sc-section">
			<p class="sc-eyebrow sc-eyebrow--accent"><?php echo $sc_text( $sc_orgs['opportunity']['eyebrow'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<h2 id="org-opportunity-title" class="sc-display"><?php echo successcircles_inline( $sc_orgs['opportunity']['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
			<?php foreach ( (array) $sc_orgs['opportunity']['paras'] as $sc_para ) : ?>
				<p class="mos-lede"><?php echo $sc_text( $sc_para ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endforeach; ?>
			<ol class="org-flow" aria-label="<?php esc_attr_e( 'From connection to progress', 'successcircles' ); ?>">
				<?php foreach ( (array) $sc_orgs['opportunity']['flow'] as $sc_term ) : ?>
					<li><?php echo $sc_text( $sc_term ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></li>
				<?php endforeach; ?>
			</ol>
			<ul class="org-cards">
				<?php foreach ( (array) $sc_orgs['opportunity']['cards'] as $sc_i => $sc_card ) : ?>
					<li>
						<span class="org-index" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $sc_i + 1 ) ); ?></span>
						<h3><?php echo $sc_text( $sc_card['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>
						<p><?php echo $sc_text( $sc_card['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="sc-section org-yours" aria-labelledby="org-yours-title">
		<header class="mos-heading">
			<p class="sc-eyebrow sc-eyebrow--accent"><?php echo $sc_text( $sc_orgs['yours']['eyebrow'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<h2 id="org-yours-title" class="sc-display"><?php echo successcircles_inline( $sc_orgs['yours']['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
			<?php foreach ( (array) $sc_orgs['yours']['paras'] as $sc_para ) : ?>
				<p class="mos-lede"><?php echo $sc_text( $sc_para ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endforeach; ?>
		</header>
		<ol class="org-equation">
			<?php foreach ( (array) $sc_orgs['yours']['equation'] as $sc_i => $sc_term ) : ?>
				<?php if ( $sc_i ) : ?><li class="org-equation__op" aria-hidden="true"><?php echo 1 === $sc_i ? '+' : '='; ?></li><?php endif; ?>
				<li class="org-equation__term<?php echo 2 === $sc_i ? ' is-result' : ''; ?>">
					<h3><?php echo $sc_text( $sc_term['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>
					<p><?php echo $sc_text( $sc_term['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
		<p class="org-motto"><?php echo $sc_text( $sc_orgs['yours']['motto'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
	</section>

	<section class="sc-band--shade" aria-labelledby="org-who-title">
		<div class="sc-section">
			<header class="mos-heading">
				<p class="sc-eyebrow sc-eyebrow--accent"><?php echo $sc_text( $sc_orgs['who']['eyebrow'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<h2 id="org-who-title" class="sc-display"><?php echo successcircles_inline( $sc_orgs['who']['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
				<p class="mos-lede"><?php echo $sc_text( $sc_orgs['who']['lede'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			</header>
			<ul class="org-who">
				<?php foreach ( (array) $sc_orgs['who']['items'] as $sc_item ) : ?>
					<li>
						<h3><?php echo $sc_text( $sc_item['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>
						<p><?php echo $sc_text( $sc_item['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section id="partnership" class="sc-section mos-steps org-process" aria-labelledby="org-process-title">
		<header class="mos-heading">
			<p class="sc-eyebrow sc-eyebrow--accent"><?php echo $sc_text( $sc_orgs['process']['eyebrow'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<h2 id="org-process-title" class="sc-display"><?php echo successcircles_inline( $sc_orgs['process']['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
			<?php foreach ( (array) $sc_orgs['process']['paras'] as $sc_para ) : ?>
				<p class="mos-lede"><?php echo $sc_text( $sc_para ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endforeach; ?>
		</header>
		<ol>
			<?php foreach ( (array) $sc_orgs['process']['steps'] as $sc_i => $sc_step ) : ?>
				<li>
					<span class="mos-number" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $sc_i + 1 ) ); ?></span>
					<div class="mos-step-copy"><h3><?php echo $sc_text( $sc_step['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3><p><?php echo $sc_text( $sc_step['text'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p></div>
				</li>
			<?php endforeach; ?>
		</ol>
	</section>

	<section class="sc-band--dark mos-context org-cta" aria-labelledby="org-cta-title">
		<div class="sc-section">
			<p class="sc-eyebrow sc-eyebrow--accent"><?php echo $sc_text( $sc_orgs['cta']['eyebrow'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<h2 id="org-cta-title" class="sc-display"><?php echo successcircles_inline( $sc_orgs['cta']['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
			<?php foreach ( (array) $sc_orgs['cta']['paras'] as $sc_para ) : ?>
				<p class="mos-lede"><?php echo $sc_text( $sc_para ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endforeach; ?>
			<div class="sc-actions sc-actions--center">
				<a class="sc-btn sc-btn--primary" href="<?php echo $sc_test; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"><?php echo $sc_text( $sc_orgs['assessment']['label'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <span aria-hidden="true">→</span></a>
			</div>
			<p class="mos-context-note"><?php echo $sc_text( $sc_orgs['cta']['note'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		</div>
	</section>

	<?php get_template_part( 'template-parts/mos-programs', null, array( 'paths' => $sc_orgs['paths'] ) ); ?>
	<?php while ( have_posts() ) : the_post(); if ( trim( get_the_content() ) ) : ?><div class="sc-section sc-prose"><?php the_content(); ?></div><?php endif; endwhile; ?>
</article>
<?php get_footer(); ?>
