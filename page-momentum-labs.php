<?php
/**
 * Momentum Labs program presentation. Content lives in labs_page.
 * @package SuccessCircles
 */
defined( 'ABSPATH' ) || exit;
$sc_labs = (array) successcircles_content( 'labs_page', array() );
$sc_problem = $sc_labs['problem'];
$sc_includes = $sc_labs['includes'];
$sc_deal = $sc_labs['deal'];
$sc_warning = $sc_labs['warning'];
$sc_closing = $sc_labs['closing'];
$sc_fig = $sc_problem['figure'];
$sc_jv = (array) successcircles_content( 'founder_page', array() );
$sc_img = SUCCESSCIRCLES_URI . '/assets/img/labs/';
$sc_cta_url = successcircles_url( $sc_labs['cta_url'] );
get_header();
?>
<article <?php post_class( 'ml-page' ); ?>>
<section class="sc-section ml-hero" aria-labelledby="ml-title">
	<p class="ml-label"><?php echo esc_html( $sc_labs['eyebrow'] ); ?> <span aria-hidden="true">/</span> <?php esc_html_e( 'The power of a shared perspective', 'successcircles' ); ?></p>
	<h1 id="ml-title" class="sc-display"><?php echo successcircles_inline( $sc_labs['title'] ); ?></h1>
	<p class="ml-lede"><?php echo esc_html( wp_specialchars_decode( $sc_labs['lede'] ) ); ?></p>
	<div class="sc-actions sc-actions--center">
		<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( $sc_cta_url ); ?>"<?php echo successcircles_link_target( $sc_labs['cta_url'] ); ?>><?php echo esc_html( $sc_labs['cta'] ); ?></a>
		<a class="sc-btn sc-btn--ghost" href="<?php echo esc_url( successcircles_page_link( 'momentum_labs_labs_membership' ) ); ?>"><?php esc_html_e( 'Explore Membership', 'successcircles' ); ?></a>
	</div>
	<p class="ml-hero__price"><strong><?php echo esc_html( successcircles_program_price( 0, $sc_labs['price'] ) ); ?></strong> <?php echo esc_html( $sc_labs['price_note'] ); ?> · <?php esc_html_e( 'Weekly group huddles', 'successcircles' ); ?></p>
	<?php if ( ! empty( $sc_labs['video']['id'] ) ) : ?>
	<div class="ml-film">
		<div class="ml-film__heading"><span><?php esc_html_e( 'Inside Momentum Labs', 'successcircles' ); ?></span><span><?php echo esc_html( $sc_labs['video']['duration'] ); ?> ↗</span></div>
		<?php get_template_part( 'template-parts/film', null, array( 'film' => $sc_labs['video'], 'dir' => 'labs', 'featured' => true ) ); ?>
		<div class="ml-film__caption">
			<?php if ( ! empty( $sc_labs['seal']['file'] ) ) : ?><img src="<?php echo esc_url( $sc_img . $sc_labs['seal']['file'] ); ?>" alt="<?php echo esc_attr( wp_specialchars_decode( $sc_labs['seal']['alt'] ) ); ?>" width="300" height="300" loading="lazy"><?php endif; ?>
			<p><?php esc_html_e( 'Bring a real challenge. Leave with a practical next step.', 'successcircles' ); ?></p>
		</div>
	</div>
	<?php endif; ?>
</section>
<nav class="ml-nav" aria-label="<?php esc_attr_e( 'Momentum Labs page sections', 'successcircles' ); ?>">
	<a href="<?php echo esc_url( successcircles_page_link( 'momentum_labs_labs_support' ) ); ?>"><?php esc_html_e( 'Your Support System', 'successcircles' ); ?></a>
	<a href="<?php echo esc_url( successcircles_page_link( 'momentum_labs_labs_founder' ) ); ?>"><?php esc_html_e( 'Meet the Founder', 'successcircles' ); ?></a>
	<a href="<?php echo esc_url( successcircles_page_link( 'momentum_labs_labs_membership' ) ); ?>"><?php esc_html_e( 'Membership', 'successcircles' ); ?></a>
</nav>
<section class="sc-section" aria-labelledby="ml-challenge-title">
	<header class="ml-heading">
		<h2 id="ml-challenge-title" class="sc-display"><?php echo successcircles_inline( $sc_problem['title'] ); ?></h2>
		<p class="ml-lede"><?php echo esc_html( $sc_problem['lede'] ); ?></p>
	</header>
	<div class="ml-challenge__body">
		<div>
			<h3 class="ml-question-title"><?php echo esc_html( $sc_problem['ask'] ); ?></h3>
			<ul class="ml-questions"><?php foreach ( $sc_problem['questions'] as $sc_question ) : ?><li><?php echo esc_html( wp_specialchars_decode( $sc_question ) ); ?></li><?php endforeach; ?></ul>
		</div>
		<aside class="ml-shift">
			<h3><?php echo esc_html( $sc_fig['caption'] ); ?></h3>
			<div class="ml-shift__before"><span><?php echo esc_html( $sc_fig['flat'] ); ?></span><p><?php echo esc_html( $sc_fig['flat_note'] ); ?></p></div>
			<span class="ml-shift__arrow" aria-hidden="true">↓</span>
			<div class="ml-shift__after"><span><?php echo esc_html( $sc_fig['curve'] ); ?></span><p><?php echo esc_html( $sc_fig['curve_note'] ); ?></p></div>
			<small><?php echo esc_html( wp_specialchars_decode( $sc_fig['note'] ) ); ?></small>
		</aside>
	</div>
	<p class="ml-takeaway"><?php echo esc_html( $sc_problem['answer'] ); ?></p>
</section>
<section class="sc-band--dark" id="labs-support" aria-labelledby="ml-support-title">
	<div class="sc-section">
		<header class="ml-heading"><p class="ml-label"><?php echo esc_html( wp_specialchars_decode( $sc_includes['eyebrow'] ) ); ?></p><h2 id="ml-support-title" class="sc-display"><?php echo esc_html( $sc_includes['title'] ); ?></h2></header>
		<ul class="ml-support"><?php foreach ( $sc_includes['items'] as $sc_item ) : ?>
			<li><h3><?php echo esc_html( wp_specialchars_decode( $sc_item['title'] ) ); ?></h3><p><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></p></li>
		<?php endforeach; ?></ul>
	</div>
</section>
<section id="labs-founder" class="sc-section ml-founder" aria-labelledby="ml-founder-title">
	<div class="ml-founder__copy">
		<p class="ml-label"><?php esc_html_e( 'Built around the people in the room', 'successcircles' ); ?></p>
		<h2 id="ml-founder-title" class="sc-display"><?php echo esc_html( wp_specialchars_decode( $sc_deal['title'] ) ); ?></h2>
		<p class="ml-lede"><?php echo esc_html( $sc_deal['text'] ); ?></p>
		<?php if ( ! empty( $sc_jv['quote'] ) ) : ?><blockquote><?php echo esc_html( wp_specialchars_decode( $sc_jv['quote'] ) ); ?></blockquote><?php endif; ?>
		<p class="ml-founder__by"><strong>Joseph Varghese</strong><span><?php echo esc_html( wp_specialchars_decode( $sc_jv['roles'][0] ?? '' ) ); ?></span></p>
		<a class="ml-text-link" href="<?php echo successcircles_url( $sc_deal['link_url'] ); ?>"><?php echo esc_html( $sc_deal['link'] ); ?> <span aria-hidden="true">↗</span></a>
	</div>
	<?php if ( ! empty( $sc_deal['image']['file'] ) ) : ?>
	<figure class="ml-founder__portrait"><img src="<?php echo esc_url( $sc_img . $sc_deal['image']['file'] ); ?>" alt="<?php echo esc_attr( wp_specialchars_decode( $sc_deal['image']['alt'] ) ); ?>" width="<?php echo esc_attr( $sc_deal['image']['width'] ); ?>" height="<?php echo esc_attr( $sc_deal['image']['height'] ); ?>" loading="lazy" decoding="async"></figure>
	<?php endif; ?>
</section>
<section id="labs-membership" class="ml-membership-band" aria-labelledby="ml-membership-title">
	<div class="sc-section">
		<header class="ml-heading"><p class="ml-label"><?php esc_html_e( 'Momentum Labs membership', 'successcircles' ); ?></p><h2 id="ml-membership-title" class="sc-display"><?php esc_html_e( 'Make progress part of your week.', 'successcircles' ); ?></h2></header>
		<div class="ml-membership">
			<div class="ml-membership__price">
				<h3>Momentum Labs</h3>
				<p class="ml-price"><strong><?php echo esc_html( successcircles_program_price( 0, $sc_labs['price'] ) ); ?></strong><span><?php echo esc_html( $sc_labs['price_note'] ); ?></span></p>
				<p><?php echo esc_html( $sc_closing['note'] ); ?></p>
				<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( $sc_cta_url ); ?>"<?php echo successcircles_link_target( $sc_labs['cta_url'] ); ?>><?php echo esc_html( $sc_labs['cta'] ); ?></a>
			</div>
			<div class="ml-membership__fit"><p class="ml-label"><?php echo esc_html( $sc_warning['label'] ); ?></p><h3><?php echo esc_html( wp_specialchars_decode( $sc_warning['title'] ) ); ?></h3><p><?php echo esc_html( $sc_warning['body'] ); ?></p><p><?php echo esc_html( $sc_warning['turn'] ); ?></p></div>
		</div>
	</div>
</section>
<section class="sc-section ml-closing" aria-labelledby="ml-closing-title">
	<h2 id="ml-closing-title" class="sc-display"><?php echo successcircles_inline( $sc_closing['title'] ); ?></h2>
	<p class="ml-lede"><?php echo esc_html( $sc_closing['text'] ); ?></p>
	<a class="sc-btn sc-btn--primary" href="<?php echo esc_url( $sc_cta_url ); ?>"<?php echo successcircles_link_target( $sc_labs['cta_url'] ); ?>><?php echo esc_html( $sc_labs['cta'] ); ?></a>
</section>
</article>
<?php get_footer(); ?>
