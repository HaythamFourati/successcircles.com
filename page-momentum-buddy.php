<?php
/**
 * The Momentum Buddy program page.
 *
 * Automatically used for a page with the slug "momentum-buddy". Copy lives in
 * the `buddy_page` block of inc/content.php, transcribed from the live Kartra
 * landing page at momentumbuddy.com so the program sells on this site rather
 * than handing the visitor off to a third-party funnel.
 *
 * Member portraits introduce the program. Expandable challenges, a daily-call
 * agenda, member stories and membership options carry the page's argument.
 * Page-specific presentation lives in assets/css/buddy.css.
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

<article <?php post_class( 'sc-buddy sc-buddy--renewed' ); ?>>

	<?php /* HERO — promise + the peers as the image */ ?>
	<section class="sc-section sc-buddy__hero" aria-labelledby="sc-buddy-title">
		<div class="sc-buddy__hero-text">
			<?php if ( ! empty( $sc_buddy['notice'] ) ) : ?>
				<p class="sc-buddy__notice">
					<span class="sc-buddy__notice-dot" aria-hidden="true"></span>
					<?php echo esc_html( wp_specialchars_decode( $sc_buddy['notice'] ) ); ?>
				</p>
			<?php endif; ?>

			<?php successcircles_eyebrow( '', $sc_buddy['eyebrow'] ); ?>

			<h1 id="sc-buddy-title" class="sc-display sc-display--xl">
				<?php echo successcircles_inline( $sc_buddy['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h1>

			<p class="sc-lede sc-buddy__lede">
				<?php echo esc_html( wp_specialchars_decode( $sc_buddy['lede'] ) ); ?>
			</p>

			<div class="sc-actions sc-buddy__actions">
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( successcircles_page_link( 'momentum_buddy_application' ) ); ?>">
					<?php echo esc_html( wp_specialchars_decode( $sc_buddy['cta'] ) ); ?>
				</a>
				<a class="sc-btn sc-btn--ghost" href="<?php echo esc_url( successcircles_page_link( 'momentum_buddy_pricing' ) ); ?>"><?php esc_html_e( 'View Membership Options', 'successcircles' ); ?></a>
				<?php if ( ! empty( $sc_buddy['cta_note'] ) ) : ?>
					<p class="sc-buddy__cta-note"><?php echo esc_html( wp_specialchars_decode( $sc_buddy['cta_note'] ) ); ?></p>
				<?php endif; ?>
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
		$sc_hero_people = (array) ( $sc_ring['hero_faces'] ?? array() );

		if ( $sc_hero_people ) :
			?>
			<aside class="mb-people" aria-label="<?php esc_attr_e( 'Meet the community', 'successcircles' ); ?>">
				<div class="mb-people__heading"><span><?php esc_html_e( 'Independent owners. Shared ambition.', 'successcircles' ); ?></span><span aria-hidden="true">↗</span></div>
				<div class="mb-people__portraits">
					<?php foreach ( $sc_hero_people as $sc_person ) : ?>
						<figure>
							<img src="<?php echo esc_url( $sc_img . 'people/' . $sc_person['image'] ); ?>" alt="<?php echo esc_attr( $sc_person['name'] ); ?>" width="<?php echo esc_attr( $sc_person['w'] ); ?>" height="<?php echo esc_attr( $sc_person['h'] ); ?>" decoding="async">
							<figcaption><?php echo esc_html( $sc_person['name'] ); ?></figcaption>
						</figure>
					<?php endforeach; ?>
				</div>
				<div class="mb-people__caption"><span aria-hidden="true">↔</span><p><?php echo esc_html( wp_specialchars_decode( $sc_ring['centre'] ) ); ?><small><?php esc_html_e( 'Carefully matched. Consistently supported.', 'successcircles' ); ?></small></p></div>
			</aside>
		<?php endif; ?>
	</section>
	<nav class="mb-navigation" aria-label="<?php esc_attr_e( 'Momentum Buddy page sections', 'successcircles' ); ?>">
		<a href="<?php echo esc_url( successcircles_page_link( 'momentum_buddy_buddy_how_it_works' ) ); ?>"><?php esc_html_e( 'How It Works', 'successcircles' ); ?></a>
		<a href="<?php echo esc_url( successcircles_page_link( 'momentum_buddy_buddy_members' ) ); ?>"><?php esc_html_e( 'Member Stories', 'successcircles' ); ?></a>
		<a href="<?php echo esc_url( successcircles_page_link( 'momentum_buddy_buddy_included' ) ); ?>"><?php esc_html_e( 'What’s Included', 'successcircles' ); ?></a>
		<a href="<?php echo esc_url( successcircles_page_link( 'momentum_buddy_pricing' ) ); ?>"><?php esc_html_e( 'Membership Options', 'successcircles' ); ?></a>
	</nav>

	<?php /* STATS — tracked results */ ?>
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

	<?php /* THE CASE — five struggles as a numbered index */ ?>
	<section class="sc-band--sand sc-band--curtain" aria-labelledby="sc-buddy-problem-title">
		<div class="sc-section">
			<div class="sc-buddy__problem-head">
				<h2 id="sc-buddy-problem-title" class="sc-display sc-display--lg">
					<?php echo successcircles_inline( $sc_problem['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</h2>
				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_problem['lede'] ) ); ?></p>
			</div>

			<ol class="sc-buddy__struggles">
				<?php foreach ( (array) $sc_problem['items'] as $sc_i => $sc_item ) : ?>
					<li class="sc-buddy__struggle">
						<span class="sc-buddy__struggle-num" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $sc_i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<details class="sc-buddy__struggle-body" <?php echo 0 === $sc_i ? 'open' : ''; ?>>
							<summary class="sc-buddy__struggle-title"><?php echo esc_html( wp_specialchars_decode( $sc_item['title'] ) ); ?><span aria-hidden="true">+</span></summary>
							<p class="sc-buddy__struggle-text"><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></p>
						</details>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<?php /* HOW A CALL WORKS — the daily huddle as a four-step process */ ?>
	<section id="buddy-how-it-works" class="mb-huddles sc-band--dark" aria-labelledby="sc-buddy-huddles-title">
		<div class="sc-section">
			<div class="sc-buddy__section-head">
				<?php successcircles_eyebrow( '', $sc_huddles['eyebrow'] ); ?>
				<h2 id="sc-buddy-huddles-title" class="sc-display sc-display--md">
					<?php echo esc_html( wp_specialchars_decode( $sc_huddles['title'] ) ); ?>
				</h2>
				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_huddles['lede'] ) ); ?></p>
			</div>

			<div class="mb-agenda">
			<div class="mb-agenda__intro"><span class="mb-agenda__duration">30<span><?php esc_html_e( 'minutes', 'successcircles' ); ?></span></span><p><?php esc_html_e( 'One conversation. A clearer day ahead.', 'successcircles' ); ?></p></div>
			<ol class="sc-buddy__steps">
				<?php foreach ( (array) $sc_huddles['items'] as $sc_i => $sc_item ) : ?>
					<li class="sc-buddy__step">
						<span class="sc-buddy__step-num" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $sc_i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<p class="sc-buddy__step-text"><?php echo esc_html( wp_specialchars_decode( $sc_item ) ); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>
			</div>

			<p class="sc-buddy__pullquote"><?php echo esc_html( wp_specialchars_decode( $sc_huddles['quote'] ) ); ?></p>
		</div>
	</section>

	<?php /* WHAT MEMBERSHIP DOES — growth as a feature grid */ ?>
	<section class="sc-band--sand" aria-labelledby="sc-buddy-growth-title">
		<div class="sc-section">
			<div class="sc-buddy__section-head">
				<?php successcircles_eyebrow( '', $sc_growth['eyebrow'] ); ?>
				<h2 id="sc-buddy-growth-title" class="sc-display sc-display--md">
					<?php echo esc_html( wp_specialchars_decode( $sc_growth['title'] ) ); ?>
				</h2>
			</div>

			<ul class="sc-buddy__features">
				<?php foreach ( (array) $sc_growth['items'] as $sc_i => $sc_item ) : ?>
					<li class="sc-buddy__feature">
						<span class="sc-buddy__feature-num" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $sc_i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<p class="sc-buddy__feature-text"><?php echo esc_html( wp_specialchars_decode( $sc_item ) ); ?></p>
					</li>
				<?php endforeach; ?>
			</ul>

			<p class="sc-buddy__statement"><?php echo esc_html( wp_specialchars_decode( $sc_growth['statement'] ) ); ?></p>
		</div>
	</section>

	<?php /* PROOF — twelve member testimonials */ ?>
	<?php if ( $sc_quotes ) : ?>
		<section id="buddy-members" class="mb-stories sc-band--shade" aria-labelledby="sc-buddy-quotes-title">
			<div class="sc-section">
				<h2 id="sc-buddy-quotes-title" class="sc-display sc-display--md sc-buddy__quotes-title">
					<?php esc_html_e( 'What members say.', 'successcircles' ); ?>
				</h2>

				<div class="sc-buddy__quotes">
					<?php foreach ( $sc_quotes as $sc_quote_index => $sc_quote ) : ?>
						<?php if ( 3 === $sc_quote_index ) : ?>
							</div><details class="mb-more-stories"><summary><?php esc_html_e( 'Read More Member Stories', 'successcircles' ); ?><span aria-hidden="true">+</span></summary><div class="sc-buddy__quotes">
						<?php endif; ?>
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
				<?php if ( count( $sc_quotes ) > 3 ) : ?></details><?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php /* WHAT'S INCLUDED — a two-column checklist */ ?>
	<section id="buddy-included" class="mb-included sc-band--sand" aria-labelledby="sc-buddy-benefits-title">
		<div class="sc-section">
			<div class="sc-buddy__section-head">
				<?php successcircles_eyebrow( '', $sc_benefits['eyebrow'] ); ?>
				<h2 id="sc-buddy-benefits-title" class="sc-display sc-display--md">
					<?php echo esc_html( wp_specialchars_decode( $sc_benefits['title'] ) ); ?>
				</h2>
				<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_benefits['lede'] ) ); ?></p>
			</div>

			<ul class="sc-buddy__includes">
				<?php foreach ( (array) $sc_benefits['items'] as $sc_item ) : ?>
					<li class="sc-buddy__include"><?php echo esc_html( wp_specialchars_decode( $sc_item ) ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<?php /* COMMUNITY — a quieter aside on peers */ ?>
	<section class="sc-band--shade sc-band--hairline" aria-labelledby="sc-buddy-community-title">
		<div class="sc-section sc-buddy__community">
			<?php successcircles_eyebrow( '', $sc_community['eyebrow'] ); ?>
			<h2 id="sc-buddy-community-title" class="sc-display sc-display--md">
				<?php echo esc_html( wp_specialchars_decode( $sc_community['title'] ) ); ?>
			</h2>
			<div class="mb-community-faces" aria-hidden="true">
				<?php foreach ( $sc_faces as $sc_face ) : ?>
					<img src="<?php echo esc_url( $sc_img . 'people/' . $sc_face ); ?>" alt="" width="100" height="100" loading="lazy" decoding="async">
				<?php endforeach; ?>
			</div>

			<ul class="sc-buddy__features sc-buddy__features--three">
				<?php foreach ( (array) $sc_community['items'] as $sc_i => $sc_item ) : ?>
					<li class="sc-buddy__feature">
						<span class="sc-buddy__feature-num" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $sc_i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<p class="sc-buddy__feature-text"><?php echo esc_html( wp_specialchars_decode( $sc_item ) ); ?></p>
					</li>
				<?php endforeach; ?>
			</ul>

			<p class="sc-buddy__statement"><?php echo esc_html( wp_specialchars_decode( $sc_community['quote'] ) ); ?></p>
		</div>
	</section>

	<?php /* PRICING */ ?>
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
						<?php if ( $sc_plan['featured'] ) : ?>
							<span class="sc-buddy__plan-flag"><?php esc_html_e( 'Most popular', 'successcircles' ); ?></span>
						<?php endif; ?>

						<h3 class="sc-buddy__plan-name"><?php echo esc_html( wp_specialchars_decode( $sc_plan['name'] ) ); ?></h3>
						<p class="sc-buddy__plan-cycle"><?php echo esc_html( wp_specialchars_decode( $sc_plan['cycle'] ) ); ?></p>

						<p class="sc-buddy__plan-price">
							<?php echo esc_html( $sc_plan['price'] ); ?>
							<?php if ( '' !== $sc_plan['save'] ) : ?>
								<span class="sc-buddy__plan-save"><?php echo esc_html( wp_specialchars_decode( $sc_plan['save'] ) ); ?></span>
							<?php endif; ?>
						</p>
						<p class="sc-buddy__plan-detail"><?php echo esc_html( wp_specialchars_decode( $sc_plan['detail'] ) ); ?></p>

						<a class="sc-btn sc-btn--sm <?php echo $sc_plan['featured'] ? 'sc-btn--primary' : 'sc-btn--ghost'; ?>" href="<?php echo esc_url( successcircles_page_link( 'momentum_buddy_application' ) ); ?>">
							<?php echo esc_html( wp_specialchars_decode( $sc_buddy['cta'] ) ); ?>
						</a>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php /* CLOSING — the argument, then the ask */ ?>
	<section class="sc-band--dark" aria-labelledby="sc-buddy-closing-title">
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
					<li class="sc-buddy__outcome"><?php echo esc_html( wp_specialchars_decode( $sc_item ) ); ?></li>
				<?php endforeach; ?>
			</ul>

			<div class="sc-buddy__closing-body">
				<?php foreach ( (array) $sc_closing['outro'] as $sc_paragraph ) : ?>
					<p><?php echo esc_html( wp_specialchars_decode( $sc_paragraph ) ); ?></p>
				<?php endforeach; ?>
			</div>

			<p class="sc-buddy__kicker"><?php echo esc_html( wp_specialchars_decode( $sc_closing['kicker'] ) ); ?></p>

			<div class="sc-actions sc-actions--center">
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( successcircles_page_link( 'momentum_buddy_application' ) ); ?>">
					<?php echo esc_html( wp_specialchars_decode( $sc_buddy['cta'] ) ); ?>
				</a>
			</div>
		</div>
	</section>

</article>

<?php
get_footer();
