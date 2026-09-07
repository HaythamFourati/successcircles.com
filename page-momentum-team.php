<?php
/**
 * The Momentum Team page — the 90-day AI accelerator.
 *
 * Automatically used for a page with the slug "momentum-team". Copy lives in
 * the `team_page` block of inc/content.php, transcribed from momentum.team.
 *
 * Design notes, because this page deliberately breaks two of the theme's own
 * habits:
 *
 * 1. NO section eyebrows. The homepage earns them as a numbered sequence; a
 *    kicker above all nine sections here would be scaffolding, not voice. The
 *    one kicker sits in the hero, where it names the product.
 * 2. Numbers appear ONCE, on the method. Days 1-30 / 31-60 / 61-90 is a real
 *    ordered sequence, so the figures carry information. Nothing else on the
 *    page is numbered.
 *
 * The arsenal is the other deliberate choice: ~20 inclusions across 6 groups
 * would be 20 identical cards in the obvious layout. It is instead a set of
 * ruled definition rows under a sticky group name, so the eye reads groups
 * first and items second.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_team    = (array) successcircles_content( 'team_page', array() );
$sc_prison  = (array) ( $sc_team['prison'] ?? array() );
$sc_scene   = (array) ( $sc_team['scene'] ?? array() );
$sc_stat    = (array) ( $sc_team['stat'] ?? array() );
$sc_method  = (array) ( $sc_team['method'] ?? array() );
$sc_arsenal = (array) ( $sc_team['arsenal'] ?? array() );
$sc_results = (array) ( $sc_team['results'] ?? array() );
$sc_quotes  = (array) ( $sc_team['quotes'] ?? array() );
$sc_pricing = (array) ( $sc_team['pricing'] ?? array() );
$sc_paths   = (array) ( $sc_team['paths'] ?? array() );
$sc_fit     = (array) ( $sc_team['fit'] ?? array() );
$sc_img     = SUCCESSCIRCLES_URI . '/assets/img/team/';
$sc_apply   = successcircles_url( $sc_team['cta_url'] );
$sc_target  = successcircles_link_target( $sc_team['cta_url'] );

get_header();
?>

<article <?php post_class( 'sc-team mt-page' ); ?>>

	<section class="sc-section sc-team__hero" aria-labelledby="sc-team-title">
		<div class="sc-team__hero-text">
			<p class="sc-team__kicker">Momentum Team <span aria-hidden="true">/</span> <?php echo esc_html( wp_specialchars_decode( $sc_team['kicker'] ) ); ?></p>

			<h1 id="sc-team-title" class="sc-display sc-display--hero sc-team__title">
				<?php echo successcircles_inline( $sc_team['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h1>

			<p class="sc-lede sc-team__lede"><?php echo esc_html( wp_specialchars_decode( $sc_team['lede'] ) ); ?></p>

			<div class="sc-actions sc-team__actions">
				<a class="sc-btn sc-btn--primary" href="<?php echo $sc_apply; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"<?php echo $sc_target; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php echo esc_html( $sc_team['cta'] ); ?>
				</a>
				<a class="sc-btn sc-btn--ghost" href="#team-roadmap"><?php esc_html_e( 'Explore the 90 Days', 'successcircles' ); ?></a>
				<?php if ( ! empty( $sc_team['cta_note'] ) ) : ?>
					<p class="sc-team__cta-note"><?php echo esc_html( wp_specialchars_decode( $sc_team['cta_note'] ) ); ?></p>
				<?php endif; ?>
			</div>

			<dl class="sc-team__facts">
				<?php foreach ( (array) $sc_team['facts'] as $sc_fact ) : ?>
					<div>
						<dt><?php echo esc_html( wp_specialchars_decode( $sc_fact['term'] ) ); ?></dt>
						<dd><?php echo esc_html( wp_specialchars_decode( $sc_fact['value'] ) ); ?></dd>
					</div>
				<?php endforeach; ?>
			</dl>
		</div>

		<?php if ( ! empty( $sc_team['hero']['file'] ) ) : ?>
			<figure class="sc-team__hero-media">
				<img
					src="<?php echo esc_url( $sc_img . $sc_team['hero']['file'] ); ?>"
					alt="<?php echo esc_attr( wp_specialchars_decode( $sc_team['hero']['alt'] ) ); ?>"
					width="<?php echo esc_attr( $sc_team['hero']['width'] ); ?>"
					height="<?php echo esc_attr( $sc_team['hero']['height'] ); ?>"
					fetchpriority="high"
					decoding="async"
				>
				<figcaption class="mt-photo-caption"><?php esc_html_e( 'Real owners. Shared ambition. A stronger next chapter.', 'successcircles' ); ?></figcaption>
			</figure>
		<?php endif; ?>
	</section>
	<nav class="mt-nav" aria-label="<?php esc_attr_e( 'Momentum Team page sections', 'successcircles' ); ?>">
		<a href="#team-roadmap"><?php esc_html_e( 'The 90-Day Roadmap', 'successcircles' ); ?></a>
		<a href="#team-support"><?php esc_html_e( 'What’s Included', 'successcircles' ); ?></a>
		<a href="#team-stories"><?php esc_html_e( 'Member Stories', 'successcircles' ); ?></a>
		<a href="#pricing"><?php esc_html_e( 'Program Investment', 'successcircles' ); ?></a>
		<a href="#team-apply"><?php esc_html_e( 'How to Apply', 'successcircles' ); ?></a>
	</nav>

	<section class="sc-band--dark" aria-labelledby="sc-team-prison-title">
		<div class="sc-section">
			<div class="sc-team__prison-head">
				<h2 id="sc-team-prison-title" class="sc-display sc-display--lg">
					<?php echo esc_html( wp_specialchars_decode( $sc_prison['title'] ) ); ?>
				</h2>
				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_prison['lede'] ) ); ?></p>
			</div>

			<div class="sc-team__prison">
				<?php foreach ( (array) $sc_prison['items'] as $sc_item ) : ?>
					<div class="sc-team__bar">
						<h3 class="sc-team__bar-title"><?php echo esc_html( wp_specialchars_decode( $sc_item['title'] ) ); ?></h3>
						<p class="sc-team__bar-text"><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="sc-band--sand sc-band--curtain" aria-labelledby="sc-team-scene-title">
		<div class="sc-section">
			<div class="sc-team__scene-top">
				<div class="sc-team__scene-head">
					<h2 id="sc-team-scene-title" class="sc-display sc-display--xl"><?php echo esc_html( wp_specialchars_decode( $sc_scene['title'] ) ); ?></h2>
					<p class="sc-team__scene-lede"><?php echo esc_html( wp_specialchars_decode( $sc_scene['lede'] ) ); ?></p>
					<p class="sc-team__turn"><?php echo esc_html( wp_specialchars_decode( $sc_scene['turn'] ) ); ?></p>
				</div>

				<?php if ( ! empty( $sc_scene['image']['file'] ) ) : ?>
					<figure class="sc-team__scene-media">
						<img
							src="<?php echo esc_url( $sc_img . $sc_scene['image']['file'] ); ?>"
							alt="<?php echo esc_attr( wp_specialchars_decode( $sc_scene['image']['alt'] ) ); ?>"
							width="<?php echo esc_attr( $sc_scene['image']['width'] ); ?>"
							height="<?php echo esc_attr( $sc_scene['image']['height'] ); ?>"
							loading="lazy"
							decoding="async"
						>
					</figure>
				<?php endif; ?>
			</div>

			<div class="sc-team__shifts">
				<?php foreach ( (array) $sc_scene['shifts'] as $sc_shift ) : ?>
					<div class="sc-team__shift">
						<h3 class="sc-team__shift-title"><?php echo esc_html( wp_specialchars_decode( $sc_shift['title'] ) ); ?></h3>
						<p><?php echo esc_html( wp_specialchars_decode( $sc_shift['text'] ) ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>

			<blockquote class="sc-team__quote-big">
				<p><?php echo esc_html( wp_specialchars_decode( $sc_scene['quote'] ) ); ?></p>
			</blockquote>

			<ul class="sc-team__proof">
				<?php foreach ( (array) $sc_scene['proof'] as $sc_line ) : ?>
					<li><?php echo esc_html( wp_specialchars_decode( $sc_line ) ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section id="team-roadmap" class="sc-band--sand" aria-labelledby="sc-team-method-title">
		<div class="sc-section">
			<div class="sc-team__method-top">
				<div class="sc-team__method-head">
					<h2 id="sc-team-method-title" class="sc-display sc-display--xl"><?php echo esc_html( wp_specialchars_decode( $sc_method['title'] ) ); ?></h2>
					<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_method['lede'] ) ); ?></p>
				</div>

				<?php if ( ! empty( $sc_method['image']['file'] ) ) : ?>
					<figure class="sc-team__method-media">
						<img
							src="<?php echo esc_url( $sc_img . $sc_method['image']['file'] ); ?>"
							alt="<?php echo esc_attr( wp_specialchars_decode( $sc_method['image']['alt'] ) ); ?>"
							width="<?php echo esc_attr( $sc_method['image']['width'] ); ?>"
							height="<?php echo esc_attr( $sc_method['image']['height'] ); ?>"
							loading="lazy"
							decoding="async"
						>
					</figure>
				<?php endif; ?>
			</div>

			<ol class="sc-team__phases">
				<?php foreach ( (array) $sc_method['phases'] as $sc_phase ) : ?>
					<li class="sc-team__phase">
						<div class="sc-team__phase-head">
							<p class="sc-team__phase-label">
								<span class="sc-team__phase-name"><?php echo esc_html( wp_specialchars_decode( $sc_phase['phase'] ) ); ?></span>
								<span class="sc-team__phase-days"><?php echo esc_html( wp_specialchars_decode( $sc_phase['days'] ) ); ?></span>
							</p>
							<h3 class="sc-team__phase-title"><?php echo esc_html( wp_specialchars_decode( $sc_phase['title'] ) ); ?></h3>
							<p class="sc-team__phase-intent"><?php echo esc_html( wp_specialchars_decode( $sc_phase['intent'] ) ); ?></p>
						</div>

						<details class="mt-phase-details">
							<summary><?php esc_html_e( 'Explore This Phase', 'successcircles' ); ?><span aria-hidden="true">+</span></summary>
						<div class="sc-team__phase-body">
							<dl class="sc-team__focus">
								<?php foreach ( (array) $sc_phase['items'] as $sc_item ) : ?>
									<div>
										<dt><?php echo esc_html( wp_specialchars_decode( $sc_item['title'] ) ); ?></dt>
										<dd><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></dd>
									</div>
								<?php endforeach; ?>
							</dl>

							<div class="sc-team__key">
								<p class="sc-team__key-label"><?php esc_html_e( 'Key activities', 'successcircles' ); ?></p>
								<ul>
									<?php foreach ( (array) $sc_phase['key'] as $sc_key ) : ?>
										<li><?php echo esc_html( wp_specialchars_decode( $sc_key ) ); ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
						</details>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<section id="team-support" class="sc-band--dark" aria-labelledby="sc-team-arsenal-title">
		<div class="sc-section">
			<div class="sc-team__arsenal-head">
				<h2 id="sc-team-arsenal-title" class="sc-display sc-display--lg"><?php echo esc_html( wp_specialchars_decode( $sc_arsenal['title'] ) ); ?></h2>
				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_arsenal['lede'] ) ); ?></p>
			</div>

			<div class="sc-team__arsenal">
				<?php foreach ( (array) $sc_arsenal['groups'] as $sc_group ) : ?>
					<details class="sc-team__group">
						<summary class="sc-team__group-name"><?php echo esc_html( wp_specialchars_decode( $sc_group['name'] ) ); ?><span aria-hidden="true">+</span></summary>
						<dl class="sc-team__group-items">
							<?php foreach ( (array) $sc_group['items'] as $sc_item ) : ?>
								<div>
									<dt><?php echo esc_html( wp_specialchars_decode( $sc_item['title'] ) ); ?></dt>
									<dd><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></dd>
								</div>
							<?php endforeach; ?>
						</dl>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php if ( $sc_quotes ) : ?>
		<section id="team-stories" class="sc-band--sand sc-band--curtain" aria-labelledby="sc-team-quotes-title">
			<div class="sc-section">
				<h2 id="sc-team-quotes-title" class="sc-display sc-display--md sc-team__quotes-title">
					<?php esc_html_e( 'What members say.', 'successcircles' ); ?>
				</h2>

				<?php
				// The homepage's film, reused. Click-to-play facade, so nothing
				// is requested from Vimeo until the visitor presses play.
				if ( ! empty( $sc_team['video']['id'] ) ) :
					?>
					<div class="sc-team__film">
						<?php
						get_template_part(
							'template-parts/film',
							null,
							array(
								'film'     => $sc_team['video'],
								'dir'      => 'team',
								'featured' => true,
							)
						);
						?>
					</div>
				<?php endif; ?>

				<div class="sc-team__quotes">
					<?php foreach ( $sc_quotes as $sc_quote ) : ?>
						<figure class="sc-team__quote">
							<blockquote><?php echo esc_html( wp_specialchars_decode( $sc_quote['text'] ) ); ?></blockquote>
							<figcaption>
								<img
									src="<?php echo esc_url( $sc_img . 'people/' . $sc_quote['image'] ); ?>"
									alt=""
									width="300"
									height="300"
									loading="lazy"
									decoding="async"
								>
								<span>
									<span class="sc-team__quote-name"><?php echo esc_html( $sc_quote['name'] ); ?></span>
									<span class="sc-team__quote-role"><?php echo esc_html( wp_specialchars_decode( $sc_quote['role'] ) ); ?></span>
								</span>
							</figcaption>
						</figure>
					<?php endforeach; ?>
				</div>

				<ul class="sc-team__results">
					<?php foreach ( (array) $sc_results['items'] as $sc_item ) : ?>
						<li>
							<strong><?php echo esc_html( wp_specialchars_decode( $sc_item['title'] ) ); ?></strong>
							<?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>
	<?php endif; ?>

	<section id="pricing" class="sc-band--shade sc-band--hairline" aria-labelledby="sc-team-pricing-title">
		<div class="sc-section">
			<h2 id="sc-team-pricing-title" class="sc-display sc-display--lg sc-team__pricing-title">
				<?php echo esc_html( wp_specialchars_decode( $sc_pricing['title'] ) ); ?>
			</h2>

			<div class="sc-team__plans">
				<?php foreach ( (array) $sc_pricing['plans'] as $sc_plan ) : ?>
					<article class="sc-team__plan<?php echo $sc_plan['featured'] ? ' sc-team__plan--featured' : ''; ?>">
						<h3 class="sc-team__plan-name"><?php echo esc_html( wp_specialchars_decode( $sc_plan['name'] ) ); ?></h3>
						<p class="sc-team__plan-price"><?php echo esc_html( $sc_plan['price'] ); ?></p>
						<p class="sc-team__plan-save"><?php echo esc_html( wp_specialchars_decode( $sc_plan['save'] ) ); ?></p>
						<p class="sc-team__plan-text"><?php echo esc_html( wp_specialchars_decode( $sc_plan['text'] ) ); ?></p>
						<a class="sc-btn sc-btn--sm <?php echo $sc_plan['featured'] ? 'sc-btn--primary' : 'sc-btn--ghost'; ?>" href="<?php echo $sc_apply; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"<?php echo $sc_target; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<?php echo esc_html( $sc_team['cta'] ); ?>
						</a>
					</article>
				<?php endforeach; ?>
			</div>

			<p class="sc-team__plans-note"><?php echo esc_html( wp_specialchars_decode( $sc_pricing['note'] ) ); ?></p>

			<dl class="sc-team__compare">
				<?php foreach ( (array) $sc_pricing['compare'] as $sc_row ) : ?>
					<div>
						<dt><?php echo esc_html( wp_specialchars_decode( $sc_row['term'] ) ); ?></dt>
						<dd><?php echo esc_html( wp_specialchars_decode( $sc_row['text'] ) ); ?></dd>
					</div>
				<?php endforeach; ?>
			</dl>

			<div class="sc-team__objection">
				<h3><?php echo esc_html( wp_specialchars_decode( $sc_pricing['objection']['title'] ) ); ?></h3>
				<p><?php echo esc_html( wp_specialchars_decode( $sc_pricing['objection']['text'] ) ); ?></p>
			</div>
		</div>
	</section>

	<section class="sc-band--dark" aria-labelledby="sc-team-paths-title">
		<div class="sc-section">
			<h2 id="sc-team-paths-title" class="sc-display sc-display--xl sc-team__paths-title">
				<?php echo esc_html( wp_specialchars_decode( $sc_paths['title'] ) ); ?>
			</h2>

			<div class="sc-team__paths">
				<?php foreach ( (array) $sc_paths['items'] as $sc_i => $sc_path ) : ?>
					<div class="sc-team__path<?php echo 0 === $sc_i ? ' sc-team__path--dim' : ' sc-team__path--lit'; ?>">
						<p class="sc-team__path-label"><?php echo esc_html( wp_specialchars_decode( $sc_path['label'] ) ); ?></p>
						<h3 class="sc-team__path-name"><?php echo esc_html( wp_specialchars_decode( $sc_path['name'] ) ); ?></h3>
						<p class="sc-team__path-text"><?php echo esc_html( wp_specialchars_decode( $sc_path['text'] ) ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>

			<p class="sc-team__paths-close"><?php echo esc_html( wp_specialchars_decode( $sc_paths['close'] ) ); ?></p>
		</div>
	</section>

	<section id="team-apply" class="sc-band--sand sc-band--curtain" aria-labelledby="sc-team-fit-title">
		<div class="sc-section sc-team__fit">
			<div>
				<h2 id="sc-team-fit-title" class="sc-display sc-display--lg"><?php echo esc_html( wp_specialchars_decode( $sc_fit['title'] ) ); ?></h2>
				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_fit['lede'] ) ); ?></p>

				<ul class="sc-team__fit-list">
					<?php foreach ( (array) $sc_fit['items'] as $sc_item ) : ?>
						<li><?php echo esc_html( wp_specialchars_decode( $sc_item ) ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="sc-team__apply">
				<h3 class="mt-apply-title"><?php esc_html_e( 'Your next chapter starts here.', 'successcircles' ); ?></h3>
				<ol class="sc-team__steps">
					<?php foreach ( (array) $sc_fit['steps'] as $sc_step ) : ?>
						<li><?php echo esc_html( wp_specialchars_decode( $sc_step ) ); ?></li>
					<?php endforeach; ?>
				</ol>

				<a class="sc-btn sc-btn--primary" href="<?php echo $sc_apply; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"<?php echo $sc_target; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php echo esc_html( $sc_team['cta'] ); ?>
				</a>
			</div>
		</div>
	</section>

</article>

<?php
get_footer();
