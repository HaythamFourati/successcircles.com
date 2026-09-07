<?php
/**
 * The FAQ page.
 *
 * Automatically used for a page with the slug "faq". The questions are driven by
 * the `faq_page` block in inc/content.php — edit the copy there, not here.
 * Anything typed into the page editor renders inside the opener, so the page
 * stays useful in wp-admin without the designed sections depending on it.
 *
 * Composition: a stated opener, then the questions grouped into labelled
 * categories rendered as native <details> accordions (so search, keyboard, and
 * no-JS all work), with a sticky category rail on wide screens and a help card
 * closing the band. FAQPage structured data is emitted for rich results.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_faq    = (array) successcircles_content( 'faq_page', array() );
$sc_groups = (array) ( $sc_faq['groups'] ?? array() );
$sc_aside  = (array) ( $sc_faq['aside'] ?? array() );

// FAQPage structured data is emitted with the rest of the page's schema
// graph — see successcircles_faq_page_items() in inc/schema.php.

get_header();

// A single running index gives every accordion a stable id for the rail links.
$sc_index = 0;
?>

<article <?php post_class( 'sc-faqpage fq-page' ); ?>>

	<header class="sc-faqpage__opener">
		<?php successcircles_eyebrow( '', $sc_faq['eyebrow'] ); ?>

		<h1 class="sc-display sc-display--xl sc-faqpage__title">
			<?php echo successcircles_inline( $sc_faq['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</h1>

		<p class="sc-faqpage__lede">
			<?php echo esc_html( wp_specialchars_decode( $sc_faq['lede'] ) ); ?>
		</p>
	</header>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php if ( trim( get_the_content() ) ) : ?>
			<div class="sc-prose sc-faqpage__intro">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>

	<div class="sc-faqpage__body">

		<aside class="sc-faqpage__rail" aria-label="<?php esc_attr_e( 'Question categories', 'successcircles' ); ?>">
			<p class="sc-faqpage__rail-label"><?php esc_html_e( 'Find answers by topic', 'successcircles' ); ?></p>
			<nav>
				<ol class="sc-faqpage__rail-list">
					<?php foreach ( $sc_groups as $sc_g => $sc_group ) : ?>
						<li>
							<a href="#sc-faq-group-<?php echo esc_attr( (string) $sc_g ); ?>">
								<span class="sc-faqpage__rail-num"><?php echo esc_html( str_pad( (string) ( $sc_g + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
								<?php echo esc_html( wp_specialchars_decode( $sc_group['label'] ) ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ol>
			</nav>


		</aside>

		<div class="sc-faqpage__groups">
			<?php foreach ( $sc_groups as $sc_g => $sc_group ) : ?>
				<section class="sc-faqpage__group" id="sc-faq-group-<?php echo esc_attr( (string) $sc_g ); ?>" aria-labelledby="sc-faq-group-<?php echo esc_attr( (string) $sc_g ); ?>-title">
					<h2 class="sc-faqpage__group-title" id="sc-faq-group-<?php echo esc_attr( (string) $sc_g ); ?>-title">
						<span class="sc-faqpage__group-num"><?php echo esc_html( str_pad( (string) ( $sc_g + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<?php echo esc_html( wp_specialchars_decode( $sc_group['label'] ) ); ?>
					</h2>

					<div class="sc-faqpage__list">
						<?php
						foreach ( (array) ( $sc_group['items'] ?? array() ) as $sc_item ) :
							$sc_index++;
							// Open the very first question by default so the page never looks empty.
							$sc_open = 1 === $sc_index ? ' open' : '';
							?>
							<details class="sc-faqpage__item"<?php echo $sc_open; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<summary class="sc-faqpage__q">
									<span class="sc-faqpage__q-text"><?php echo esc_html( wp_specialchars_decode( $sc_item['question'] ) ); ?></span>
									<span class="sc-faqpage__q-icon" aria-hidden="true"></span>
								</summary>

								<div class="sc-faqpage__a">
									<?php foreach ( (array) $sc_item['answer'] as $sc_block ) : ?>
										<?php if ( isset( $sc_block['p'] ) ) : ?>
											<p><?php echo esc_html( wp_specialchars_decode( $sc_block['p'] ) ); ?></p>
										<?php elseif ( isset( $sc_block['list'] ) ) : ?>
											<ul class="sc-faqpage__a-list">
												<?php foreach ( (array) $sc_block['list'] as $sc_li ) : ?>
													<li><?php echo esc_html( wp_specialchars_decode( $sc_li ) ); ?></li>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</details>
						<?php endforeach; ?>
					</div>
				</section>
			<?php endforeach; ?>
		</div>

	</div>


			<?php if ( ! empty( $sc_aside ) ) : ?>
				<div class="sc-faqpage__help">
					<h2 class="sc-faqpage__help-title"><?php echo esc_html( wp_specialchars_decode( $sc_aside['title'] ) ); ?></h2>
					<p class="sc-faqpage__help-text"><?php echo esc_html( wp_specialchars_decode( $sc_aside['text'] ) ); ?></p>
					<a class="sc-btn sc-btn--primary sc-btn--compact" <?php successcircles_test_link_attrs(); ?>>
						<?php echo esc_html( wp_specialchars_decode( $sc_aside['link']['label'] ) ); ?>
					</a>
					<?php if ( ! empty( $sc_aside['secondary'] ) ) : ?>
						<a class="sc-faqpage__help-link" href="<?php echo successcircles_url( $sc_aside['secondary']['url'] ); ?>">
							<?php echo esc_html( wp_specialchars_decode( $sc_aside['secondary']['label'] ) ); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
</article>

<?php
get_template_part( 'template-parts/home/cta' );

get_footer();
