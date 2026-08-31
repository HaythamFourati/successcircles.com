<?php
/**
 * The Momentum Labs program page.
 *
 * Automatically used for a page with the slug "momentum-labs". Copy lives in
 * the `labs_page` block of inc/content.php, transcribed from the live
 * GroovePages landing page at momentumhuddle.com.
 *
 * On the source page's images: everything was downloaded to assets/img/labs/,
 * but two are deliberately not placed. `hero.png` is a marketing banner with
 * the heading, a second logo and social handles baked into the pixels — it
 * would duplicate the h1 and put competing branding on the page. `logo.png` is
 * the SuccessCircles mark the header already renders as real markup, and
 * `crowdsourcing.jpg` is a stock photo with its own title burned in. The three
 * that carry meaning are used: the Community & Huddles seal, the "stuck"
 * illustration next to the problem it illustrates, and Joseph's cut-out.
 *
 * The cut-out is transparent, so like the founder page it sits on a dark band
 * with a glow behind it — drop it onto a light band and it stops working.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_labs     = (array) successcircles_content( 'labs_page', array() );
$sc_problem  = (array) ( $sc_labs['problem'] ?? array() );
$sc_includes = (array) ( $sc_labs['includes'] ?? array() );
$sc_deal     = (array) ( $sc_labs['deal'] ?? array() );
$sc_warning  = (array) ( $sc_labs['warning'] ?? array() );
$sc_closing  = (array) ( $sc_labs['closing'] ?? array() );
$sc_img      = SUCCESSCIRCLES_URI . '/assets/img/labs/';
$sc_cta_url  = successcircles_url( $sc_labs['cta_url'] );

get_header();
?>

<article <?php post_class( 'sc-labs' ); ?>>

	<section class="sc-section sc-labs__hero" aria-labelledby="sc-labs-title">
		<div class="sc-labs__hero-text">
			<?php successcircles_eyebrow( '', $sc_labs['eyebrow'] ); ?>

			<h1 id="sc-labs-title" class="sc-display sc-display--xl">
				<?php echo successcircles_inline( $sc_labs['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h1>

			<p class="sc-lede sc-labs__lede">
				<?php echo esc_html( wp_specialchars_decode( $sc_labs['lede'] ) ); ?>
			</p>

			<p class="sc-labs__price">
				<span class="sc-labs__price-figure"><?php echo esc_html( successcircles_program_price( 1, $sc_labs['price'] ) ); ?></span>
				<span class="sc-labs__price-note"><?php echo esc_html( wp_specialchars_decode( $sc_labs['price_note'] ) ); ?></span>
			</p>

			<div class="sc-actions">
				<a class="sc-btn sc-btn--primary" href="<?php echo $sc_cta_url; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"<?php echo successcircles_link_target( $sc_labs['cta_url'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php echo esc_html( wp_specialchars_decode( $sc_labs['cta'] ) ); ?>
				</a>
			</div>
		</div>

		<?php if ( ! empty( $sc_labs['seal']['file'] ) ) : ?>
			<div class="sc-labs__seal-wrap">
				<?php
				// Decoration built from the theme's own orbit vocabulary — the
				// same ring / spoke / dot construction as the loader brand mark,
				// so the seal sits inside the design language rather than beside
				// it. All of it is decorative and hidden from assistive tech.
				?>
				<span class="sc-labs__glow-core" aria-hidden="true"></span>
				<span class="sc-labs__seal-ring sc-labs__seal-ring--outer" aria-hidden="true"></span>
				<span class="sc-labs__seal-ring" aria-hidden="true"></span>

				<span class="sc-labs__orbit" aria-hidden="true">
					<?php for ( $sc_d = 0; $sc_d < 6; $sc_d++ ) : ?>
						<span class="sc-labs__spoke" style="--sc-spoke-angle:<?php echo esc_attr( (string) ( $sc_d * 60 ) ); ?>deg">
							<span class="sc-labs__dot" style="--sc-dot-delay:<?php echo esc_attr( (string) ( $sc_d * 0.28 ) ); ?>s"></span>
						</span>
					<?php endfor; ?>
				</span>

				<span class="sc-labs__orbit sc-labs__orbit--rev" aria-hidden="true">
					<?php for ( $sc_d = 0; $sc_d < 4; $sc_d++ ) : ?>
						<span class="sc-labs__spoke" style="--sc-spoke-angle:<?php echo esc_attr( (string) ( 45 + $sc_d * 90 ) ); ?>deg">
							<span class="sc-labs__dot sc-labs__dot--sm" style="--sc-dot-delay:<?php echo esc_attr( (string) ( 0.4 + $sc_d * 0.3 ) ); ?>s"></span>
						</span>
					<?php endfor; ?>
				</span>

				<img
					class="sc-labs__seal"
					src="<?php echo esc_url( $sc_img . $sc_labs['seal']['file'] ); ?>"
					alt="<?php echo esc_attr( wp_specialchars_decode( $sc_labs['seal']['alt'] ) ); ?>"
					width="<?php echo esc_attr( $sc_labs['seal']['width'] ); ?>"
					height="<?php echo esc_attr( $sc_labs['seal']['height'] ); ?>"
					fetchpriority="high"
					decoding="async"
				>
			</div>
		<?php endif; ?>
	</section>

	<?php if ( ! empty( $sc_labs['video']['id'] ) ) : ?>
		<section class="sc-band--dark" aria-label="<?php esc_attr_e( 'Inside Momentum Labs', 'successcircles' ); ?>">
			<div class="sc-section sc-labs__film">
				<?php
				get_template_part(
					'template-parts/film',
					null,
					array(
						'film'     => $sc_labs['video'],
						'dir'      => 'labs',
						'featured' => true,
					)
				);
				?>
			</div>
		</section>
	<?php endif; ?>

	<section class="sc-band--sand sc-band--curtain" aria-labelledby="sc-labs-problem-title">
		<div class="sc-section sc-labs__problem">
			<div class="sc-labs__problem-text">
				<h2 id="sc-labs-problem-title" class="sc-display sc-display--lg">
					<?php echo successcircles_inline( $sc_problem['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</h2>

				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_problem['lede'] ) ); ?></p>
			</div>

			<?php
			$sc_fig = (array) ( $sc_problem['figure'] ?? array() );

			if ( $sc_fig ) :
				/*
				 * Drawn rather than photographed. "Stuck in neutral" is a shape,
				 * not a scene: a line that stays flat against one that compounds.
				 * Inline SVG so it stays crisp at any size, carries no extra
				 * request, and takes its colour from the theme's own tokens.
				 * Deliberately unnumbered — it is an argument, not a dataset,
				 * and the caption says so.
				 */
				?>
				<figure class="sc-labs__figure">
					<svg class="sc-labs__chart" viewBox="0 0 480 300" role="img"
						aria-label="<?php echo esc_attr( wp_specialchars_decode( $sc_fig['alt'] ) ); ?>">

						<defs>
							<linearGradient id="sc-labs-grad" x1="0" y1="0" x2="0" y2="1">
								<stop offset="0%" stop-color="var(--sc-rust)" />
								<stop offset="100%" stop-color="var(--sc-rust)" stop-opacity="0" />
							</linearGradient>
						</defs>

						<g class="sc-labs__chart-grid" aria-hidden="true">
							<line x1="40" y1="60" x2="452" y2="60" />
							<line x1="40" y1="122" x2="452" y2="122" />
							<line x1="40" y1="184" x2="452" y2="184" />
							<line x1="40" y1="246" x2="452" y2="246" />
							<line x1="40" y1="292" x2="452" y2="292" />
						</g>

						<line class="sc-labs__chart-axis" x1="40" y1="30" x2="40" y2="292" aria-hidden="true" />

						<?php // The flat read: effort that never compounds. ?>
						<path class="sc-labs__chart-flat" d="M40 250 C 140 248, 260 255, 452 259" aria-hidden="true" />

						<?php // The compounding read: slow, then steep. ?>
						<path class="sc-labs__chart-fill" d="M40 250 C 190 244, 320 196, 452 58 L452 292 L40 292 Z" aria-hidden="true" />
						<path class="sc-labs__chart-curve" d="M40 250 C 190 244, 320 196, 452 58" aria-hidden="true" />

						<circle class="sc-labs__chart-origin" cx="40" cy="250" r="4.5" aria-hidden="true" />
						<circle class="sc-labs__chart-end sc-labs__chart-end--flat" cx="452" cy="259" r="4.5" aria-hidden="true" />
						<circle class="sc-labs__chart-end" cx="452" cy="58" r="5.5" aria-hidden="true" />
					</svg>

					<figcaption class="sc-labs__figure-caption">
						<p class="sc-labs__figure-title"><?php echo esc_html( wp_specialchars_decode( $sc_fig['caption'] ) ); ?></p>

						<ul class="sc-labs__legend">
							<li class="sc-labs__legend-item sc-labs__legend-item--curve">
								<span class="sc-labs__legend-name"><?php echo esc_html( wp_specialchars_decode( $sc_fig['curve'] ) ); ?></span>
								<span class="sc-labs__legend-note"><?php echo esc_html( wp_specialchars_decode( $sc_fig['curve_note'] ) ); ?></span>
							</li>
							<li class="sc-labs__legend-item sc-labs__legend-item--flat">
								<span class="sc-labs__legend-name"><?php echo esc_html( wp_specialchars_decode( $sc_fig['flat'] ) ); ?></span>
								<span class="sc-labs__legend-note"><?php echo esc_html( wp_specialchars_decode( $sc_fig['flat_note'] ) ); ?></span>
							</li>
						</ul>

						<p class="sc-labs__figure-note"><?php echo esc_html( wp_specialchars_decode( $sc_fig['note'] ) ); ?></p>
					</figcaption>
				</figure>
			<?php endif; ?>
		</div>

		<?php // The four questions get the full measure — they are the turn of the section, not a footnote to it. ?>
		<div class="sc-section sc-labs__ask-block">
			<p class="sc-labs__ask"><?php echo esc_html( wp_specialchars_decode( $sc_problem['ask'] ) ); ?></p>

			<ul class="sc-labs__questions">
				<?php foreach ( (array) $sc_problem['questions'] as $sc_question ) : ?>
					<li><?php echo esc_html( wp_specialchars_decode( $sc_question ) ); ?></li>
				<?php endforeach; ?>
			</ul>

			<p class="sc-labs__answer"><?php echo esc_html( wp_specialchars_decode( $sc_problem['answer'] ) ); ?></p>
		</div>
	</section>

	<section class="sc-band--shade sc-band--hairline" aria-labelledby="sc-labs-includes-title">
		<div class="sc-section">
			<div class="sc-labs__includes-head">
				<?php successcircles_eyebrow( '', $sc_includes['eyebrow'] ); ?>
				<h2 id="sc-labs-includes-title" class="sc-display sc-display--lg">
					<?php echo esc_html( wp_specialchars_decode( $sc_includes['title'] ) ); ?>
				</h2>
			</div>

			<ul class="sc-labs__grid">
				<?php foreach ( (array) $sc_includes['items'] as $sc_item ) : ?>
					<li class="sc-labs__cell">
						<h3 class="sc-labs__cell-title"><?php echo esc_html( wp_specialchars_decode( $sc_item['title'] ) ); ?></h3>
						<p class="sc-labs__cell-text"><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<?php
	// Portrait first, text second — the previous two sections both lead with
	// text on the left, and flipping here keeps the page from settling into one
	// rhythm. The quote and role come from `founder_page` so this section can
	// never claim words Joseph did not actually say elsewhere on the site.
	$sc_jv       = (array) successcircles_content( 'founder_page', array() );
	$sc_jv_roles = (array) ( $sc_jv['roles'] ?? array() );
	?>
	<section class="sc-band--dark" aria-labelledby="sc-labs-deal-title">
		<div class="sc-section sc-labs__deal">

			<?php if ( ! empty( $sc_deal['image']['file'] ) ) : ?>
				<figure class="sc-labs__deal-media">
					<span class="sc-labs__glow" aria-hidden="true"></span>
					<img
						src="<?php echo esc_url( $sc_img . $sc_deal['image']['file'] ); ?>"
						alt="<?php echo esc_attr( wp_specialchars_decode( $sc_deal['image']['alt'] ) ); ?>"
						width="<?php echo esc_attr( $sc_deal['image']['width'] ); ?>"
						height="<?php echo esc_attr( $sc_deal['image']['height'] ); ?>"
						loading="lazy"
						decoding="async"
					>
				</figure>
			<?php endif; ?>

			<div class="sc-labs__deal-text">
				<h2 id="sc-labs-deal-title" class="sc-display sc-display--xl">
					<?php echo esc_html( wp_specialchars_decode( $sc_deal['title'] ) ); ?>
				</h2>

				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_deal['text'] ) ); ?></p>

				<?php if ( ! empty( $sc_jv['quote'] ) ) : ?>
					<figure class="sc-labs__jv">
						<blockquote class="sc-labs__jv-quote">
							<?php echo esc_html( wp_specialchars_decode( $sc_jv['quote'] ) ); ?>
						</blockquote>

						<figcaption class="sc-labs__jv-by">
							<span class="sc-labs__jv-name">Joseph Varghese</span>
							<span class="sc-labs__jv-role"><?php echo esc_html( wp_specialchars_decode( $sc_jv_roles[0] ?? '' ) ); ?></span>
							<a class="sc-labs__jv-link" href="<?php echo successcircles_url( $sc_deal['link_url'] ); ?>">
								<?php echo esc_html( wp_specialchars_decode( $sc_deal['link'] ) ); ?>
							</a>
						</figcaption>
					</figure>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php
	/*
	 * A dark plate inset on the sand, not a band of its own. Two reasons: the
	 * band above is already dark so a third dark band would flatten the
	 * rhythm, and the CTA below is sand — without an object here the two sand
	 * bands ran together and this section read as an orphan. Contained, it
	 * becomes a gate the reader passes through on the way to the CTA.
	 */
	?>
	<section class="sc-band--sand sc-band--curtain" aria-labelledby="sc-labs-warning-title">
		<div class="sc-section sc-labs__gate-wrap">
			<div class="sc-labs__gate">
				<span class="sc-labs__gate-ring" aria-hidden="true"></span>

				<p class="sc-labs__gate-label"><?php echo esc_html( wp_specialchars_decode( $sc_warning['label'] ) ); ?></p>

				<h2 id="sc-labs-warning-title" class="sc-labs__gate-title">
					<?php echo esc_html( wp_specialchars_decode( $sc_warning['title'] ) ); ?>
				</h2>

				<p class="sc-labs__gate-body"><?php echo esc_html( wp_specialchars_decode( $sc_warning['body'] ) ); ?></p>

				<p class="sc-labs__gate-turn">
					<span class="sc-labs__gate-turn-mark" aria-hidden="true"></span>
					<?php echo esc_html( wp_specialchars_decode( $sc_warning['turn'] ) ); ?>
				</p>
			</div>
		</div>
	</section>

	<section class="sc-cta sc-band--hairline" aria-labelledby="sc-labs-closing-title">
		<div class="sc-cta__inner">
			<span class="sc-cta__ring" aria-hidden="true"></span>
			<span class="sc-cta__ring-dashed" aria-hidden="true"></span>

			<h2 id="sc-labs-closing-title" class="sc-display sc-cta__title">
				<?php echo successcircles_inline( $sc_closing['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h2>

			<p class="sc-lede sc-cta__lede"><?php echo esc_html( wp_specialchars_decode( $sc_closing['text'] ) ); ?></p>

			<div class="sc-actions sc-actions--center sc-cta__actions">
				<a class="sc-btn sc-btn--primary" href="<?php echo $sc_cta_url; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"<?php echo successcircles_link_target( $sc_labs['cta_url'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php echo esc_html( wp_specialchars_decode( $sc_labs['cta'] ) ); ?>
				</a>
			</div>

			<p class="sc-labs__closing-note"><?php echo esc_html( wp_specialchars_decode( $sc_closing['note'] ) ); ?></p>
		</div>
	</section>

</article>

<?php
get_footer();
