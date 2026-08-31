<?php
/**
 * The Momentum Braintrust Buddy program page.
 *
 * Automatically used for a page with the slug "momentum-buddy". Copy lives in
 * the `buddy_page` block of inc/content.php, transcribed from the live Kartra
 * landing page at momentumbuddy.com so the program sells on this site rather
 * than handing the visitor off to a third-party funnel.
 *
 * Composition follows the source page's argument, not its layout: the promise,
 * then the five struggles that make the case, then what a day actually looks
 * like, then proof, then what you get, then the plans. The band rhythm is the
 * theme's own — dark bands carry the emotional beats (the struggles, the
 * closing argument), sand carries the practical ones.
 *
 * Every price and plan is client copy. See the `pricing` block before editing.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_buddy     = (array) successcircles_content( 'buddy_page', array() );
$sc_problem   = (array) ( $sc_buddy['problem'] ?? array() );
$sc_huddles   = (array) ( $sc_buddy['huddles'] ?? array() );
$sc_growth    = (array) ( $sc_buddy['growth'] ?? array() );
$sc_community = (array) ( $sc_buddy['community'] ?? array() );
$sc_benefits  = (array) ( $sc_buddy['benefits'] ?? array() );
$sc_pricing   = (array) ( $sc_buddy['pricing'] ?? array() );
$sc_closing   = (array) ( $sc_buddy['closing'] ?? array() );
$sc_quotes    = (array) ( $sc_buddy['quotes'] ?? array() );
$sc_img       = SUCCESSCIRCLES_URI . '/assets/img/buddy/';

get_header();
?>

<article <?php post_class( 'sc-buddy' ); ?>>

	<section class="sc-section sc-buddy__hero" aria-labelledby="sc-buddy-title">
		<div class="sc-buddy__hero-text">
			<?php successcircles_eyebrow( '', $sc_buddy['eyebrow'] ); ?>

			<h1 id="sc-buddy-title" class="sc-display sc-display--xl">
				<?php echo successcircles_inline( $sc_buddy['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h1>

			<p class="sc-lede sc-buddy__lede">
				<?php echo esc_html( wp_specialchars_decode( $sc_buddy['lede'] ) ); ?>
			</p>

			<div class="sc-actions sc-buddy__actions">
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( successcircles_apply_url() ); ?>">
					<?php echo esc_html( wp_specialchars_decode( $sc_buddy['cta'] ) ); ?>
				</a>
				<p class="sc-buddy__cta-note"><?php echo esc_html( wp_specialchars_decode( $sc_buddy['cta_note'] ) ); ?></p>
			</div>

			<?php if ( ! empty( $sc_buddy['badge']['file'] ) ) : ?>
				<img
					class="sc-buddy__badge"
					src="<?php echo esc_url( $sc_img . $sc_buddy['badge']['file'] ); ?>"
					alt="<?php echo esc_attr( wp_specialchars_decode( $sc_buddy['badge']['alt'] ) ); ?>"
					width="<?php echo esc_attr( $sc_buddy['badge']['width'] ); ?>"
					height="<?php echo esc_attr( $sc_buddy['badge']['height'] ); ?>"
					loading="lazy"
					decoding="async"
				>
			<?php endif; ?>
		</div>

		<?php
		$sc_ring  = (array) ( $sc_buddy['ring'] ?? array() );
		$sc_faces = (array) ( $sc_ring['faces'] ?? array() );

		if ( $sc_faces ) :
			$sc_step = 360 / count( $sc_faces );
			?>
			<div class="sc-buddy__ring" role="img" aria-label="<?php esc_attr_e( 'Twelve Momentum Buddy members', 'successcircles' ); ?>">
				<span class="sc-buddy__ring-track" aria-hidden="true"></span>

				<ul class="sc-buddy__faces">
					<?php foreach ( $sc_faces as $sc_i => $sc_face ) : ?>
						<li class="sc-buddy__face" style="--sc-face-angle:<?php echo esc_attr( (string) round( $sc_i * $sc_step, 2 ) ); ?>deg">
							<img
								src="<?php echo esc_url( $sc_img . 'people/' . $sc_face ); ?>"
								alt=""
								width="300"
								height="300"
								<?php echo 0 === $sc_i ? 'fetchpriority="high"' : 'loading="lazy"'; ?>
								decoding="async"
							>
						</li>
					<?php endforeach; ?>
				</ul>

				<p class="sc-buddy__ring-centre">
					<?php echo esc_html( wp_specialchars_decode( $sc_ring['centre'] ) ); ?>
				</p>
			</div>
		<?php endif; ?>
	</section>

	<?php if ( ! empty( $sc_buddy['stats'] ) ) : ?>
		<section class="sc-band--dark" aria-label="<?php esc_attr_e( 'Program results', 'successcircles' ); ?>">
			<div class="sc-section sc-buddy__stats">
				<?php foreach ( (array) $sc_buddy['stats'] as $sc_stat ) : ?>
					<div class="sc-buddy__stat">
						<p class="sc-buddy__stat-figure"><?php echo esc_html( $sc_stat['figure'] ); ?></p>
						<p class="sc-buddy__stat-label"><?php echo esc_html( wp_specialchars_decode( $sc_stat['label'] ) ); ?></p>
					</div>
				<?php endforeach; ?>
				<p class="sc-buddy__stats-note"><?php echo esc_html( wp_specialchars_decode( $sc_buddy['stats_note'] ) ); ?></p>
			</div>
		</section>
	<?php endif; ?>

	<section class="sc-band--sand sc-band--curtain" aria-labelledby="sc-buddy-problem-title">
		<div class="sc-section">
			<div class="sc-buddy__problem-head">
				<h2 id="sc-buddy-problem-title" class="sc-display sc-display--lg">
					<?php echo successcircles_inline( $sc_problem['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</h2>
				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_problem['lede'] ) ); ?></p>
			</div>

			<ul class="sc-buddy__struggles">
				<?php foreach ( (array) $sc_problem['items'] as $sc_item ) : ?>
					<li class="sc-buddy__struggle">
						<h3 class="sc-buddy__struggle-title"><?php echo esc_html( wp_specialchars_decode( $sc_item['title'] ) ); ?></h3>
						<p class="sc-buddy__struggle-text"><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="sc-band--shade sc-band--hairline" aria-labelledby="sc-buddy-huddles-title">
		<div class="sc-section sc-split sc-split--top">
			<div>
				<?php successcircles_eyebrow( '', $sc_huddles['eyebrow'] ); ?>
				<h2 id="sc-buddy-huddles-title" class="sc-display sc-display--md">
					<?php echo esc_html( wp_specialchars_decode( $sc_huddles['title'] ) ); ?>
				</h2>
				<p class="sc-buddy__pullquote"><?php echo esc_html( wp_specialchars_decode( $sc_huddles['quote'] ) ); ?></p>
			</div>

			<div>
				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_huddles['lede'] ) ); ?></p>
				<ul class="sc-buddy__list">
					<?php foreach ( (array) $sc_huddles['items'] as $sc_item ) : ?>
						<li><?php echo esc_html( wp_specialchars_decode( $sc_item ) ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>

	<section class="sc-band--dark" aria-labelledby="sc-buddy-growth-title">
		<div class="sc-section sc-split sc-split--top">
			<div>
				<?php successcircles_eyebrow( '', $sc_growth['eyebrow'] ); ?>
				<h2 id="sc-buddy-growth-title" class="sc-display sc-display--md">
					<?php echo esc_html( wp_specialchars_decode( $sc_growth['title'] ) ); ?>
				</h2>
			</div>

			<div>
				<ul class="sc-buddy__list">
					<?php foreach ( (array) $sc_growth['items'] as $sc_item ) : ?>
						<li><?php echo esc_html( wp_specialchars_decode( $sc_item ) ); ?></li>
					<?php endforeach; ?>
				</ul>
				<p class="sc-buddy__statement"><?php echo esc_html( wp_specialchars_decode( $sc_growth['statement'] ) ); ?></p>
			</div>
		</div>
	</section>

	<?php if ( $sc_quotes ) : ?>
		<section class="sc-band--sand sc-band--curtain" aria-labelledby="sc-buddy-quotes-title">
			<div class="sc-section">
				<h2 id="sc-buddy-quotes-title" class="sc-display sc-display--md sc-buddy__quotes-title">
					<?php esc_html_e( 'What members say.', 'successcircles' ); ?>
				</h2>

				<div class="sc-buddy__quotes">
					<?php foreach ( $sc_quotes as $sc_quote ) : ?>
						<figure class="sc-buddy__quote">
							<blockquote><?php echo esc_html( wp_specialchars_decode( $sc_quote['text'] ) ); ?></blockquote>
							<figcaption class="sc-buddy__quote-by">
								<img
									class="sc-buddy__quote-avatar"
									src="<?php echo esc_url( $sc_img . 'people/' . $sc_quote['image'] ); ?>"
									alt=""
									width="<?php echo esc_attr( $sc_quote['w'] ); ?>"
									height="<?php echo esc_attr( $sc_quote['h'] ); ?>"
									loading="lazy"
									decoding="async"
								>
								<span>
									<span class="sc-buddy__quote-name"><?php echo esc_html( $sc_quote['name'] ); ?></span>
									<span class="sc-buddy__quote-role"><?php echo esc_html( wp_specialchars_decode( $sc_quote['role'] ) ); ?></span>
								</span>
							</figcaption>
						</figure>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="sc-band--shade sc-band--hairline" aria-labelledby="sc-buddy-benefits-title">
		<div class="sc-section sc-split sc-split--top">
			<div>
				<?php successcircles_eyebrow( '', $sc_benefits['eyebrow'] ); ?>
				<h2 id="sc-buddy-benefits-title" class="sc-display sc-display--md">
					<?php echo esc_html( wp_specialchars_decode( $sc_benefits['title'] ) ); ?>
				</h2>
				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_benefits['lede'] ) ); ?></p>
			</div>

			<ul class="sc-buddy__benefits">
				<?php foreach ( (array) $sc_benefits['items'] as $sc_item ) : ?>
					<li><?php echo esc_html( wp_specialchars_decode( $sc_item ) ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section id="pricing" class="sc-band--sand" aria-labelledby="sc-buddy-pricing-title">
		<div class="sc-section">
			<div class="sc-buddy__pricing-head">
				<?php successcircles_eyebrow( '', $sc_pricing['eyebrow'] ); ?>
				<h2 id="sc-buddy-pricing-title" class="sc-display sc-display--lg">
					<?php echo esc_html( wp_specialchars_decode( $sc_pricing['title'] ) ); ?>
				</h2>
				<p class="sc-buddy__pricing-note"><?php echo esc_html( wp_specialchars_decode( $sc_pricing['note'] ) ); ?></p>
			</div>

			<div class="sc-buddy__plans">
				<?php foreach ( (array) $sc_pricing['plans'] as $sc_plan ) : ?>
					<article class="sc-buddy__plan<?php echo $sc_plan['featured'] ? ' sc-buddy__plan--featured' : ''; ?>">
						<h3 class="sc-buddy__plan-name"><?php echo esc_html( wp_specialchars_decode( $sc_plan['name'] ) ); ?></h3>
						<p class="sc-buddy__plan-cycle"><?php echo esc_html( wp_specialchars_decode( $sc_plan['cycle'] ) ); ?></p>
						<p class="sc-buddy__plan-price"><?php echo esc_html( $sc_plan['price'] ); ?></p>
						<p class="sc-buddy__plan-detail"><?php echo esc_html( wp_specialchars_decode( $sc_plan['detail'] ) ); ?></p>

						<?php if ( '' !== $sc_plan['save'] ) : ?>
							<p class="sc-buddy__plan-save"><?php echo esc_html( wp_specialchars_decode( $sc_plan['save'] ) ); ?></p>
						<?php endif; ?>

						<a class="sc-btn sc-btn--sm <?php echo $sc_plan['featured'] ? 'sc-btn--primary' : 'sc-btn--ghost'; ?>" href="<?php echo esc_url( successcircles_apply_url() ); ?>">
							<?php echo esc_html( wp_specialchars_decode( $sc_buddy['cta'] ) ); ?>
						</a>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="sc-band--dark" aria-labelledby="sc-buddy-community-title">
		<div class="sc-section sc-split sc-split--top">
			<div>
				<?php successcircles_eyebrow( '', $sc_community['eyebrow'] ); ?>
				<h2 id="sc-buddy-community-title" class="sc-display sc-display--md">
					<?php echo esc_html( wp_specialchars_decode( $sc_community['title'] ) ); ?>
				</h2>
			</div>

			<div>
				<ul class="sc-buddy__list">
					<?php foreach ( (array) $sc_community['items'] as $sc_item ) : ?>
						<li><?php echo esc_html( wp_specialchars_decode( $sc_item ) ); ?></li>
					<?php endforeach; ?>
				</ul>
				<p class="sc-buddy__statement"><?php echo esc_html( wp_specialchars_decode( $sc_community['quote'] ) ); ?></p>
			</div>
		</div>
	</section>

	<section class="sc-band--sand sc-band--curtain" aria-labelledby="sc-buddy-closing-title">
		<div class="sc-section sc-buddy__closing">
			<h2 id="sc-buddy-closing-title" class="sc-display sc-display--xl">
				<?php echo esc_html( wp_specialchars_decode( $sc_closing['title'] ) ); ?>
			</h2>

			<div class="sc-buddy__closing-body">
				<?php foreach ( (array) $sc_closing['body'] as $sc_paragraph ) : ?>
					<p><?php echo esc_html( wp_specialchars_decode( $sc_paragraph ) ); ?></p>
				<?php endforeach; ?>
			</div>

			<ul class="sc-buddy__outcomes">
				<?php foreach ( (array) $sc_closing['items'] as $sc_item ) : ?>
					<li><?php echo esc_html( wp_specialchars_decode( $sc_item ) ); ?></li>
				<?php endforeach; ?>
			</ul>

			<div class="sc-buddy__closing-body">
				<?php foreach ( (array) $sc_closing['outro'] as $sc_paragraph ) : ?>
					<p><?php echo esc_html( wp_specialchars_decode( $sc_paragraph ) ); ?></p>
				<?php endforeach; ?>
			</div>

			<p class="sc-buddy__kicker"><?php echo esc_html( wp_specialchars_decode( $sc_closing['kicker'] ) ); ?></p>

			<div class="sc-actions sc-actions--center">
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( successcircles_apply_url() ); ?>">
					<?php echo esc_html( wp_specialchars_decode( $sc_buddy['cta'] ) ); ?>
				</a>
			</div>
		</div>
	</section>

</article>

<?php
get_footer();
