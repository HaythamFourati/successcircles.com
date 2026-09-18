<?php
/**
 * A single blog post — a Rules for Success interview.
 *
 * These run 3,000–6,000 words with a dozen numbered sub-sections, so the page
 * is built as a document rather than a text dump:
 *
 *   masthead   asymmetric — title left, mono facts right, artwork plate under
 *   body       readable prose + podcast links sidebar
 *   more       two neighbouring interviews, using the shared episode card
 *
 * The contents rail is built by theme.js from the headings the editor actually
 * wrote, and is absent without JavaScript. Podcast links remain available
 * without scripting and stack below the article on smaller screens.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$sc_role = (string) get_post_meta( get_the_ID(), '_sc_role', true );
	$sc_blog = (int) get_option( 'page_for_posts' );
	$sc_mins = successcircles_read_time();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'sc-article rf-article' ); ?> data-sc-article>

		<header class="sc-article__masthead">

			<div class="sc-article__head">
				<div class="sc-article__headline">
					<?php if ( $sc_blog ) : ?>
						<a class="sc-link-rule sc-article__back" href="<?php echo esc_url( successcircles_page_link( 'articles_podcast', get_permalink( $sc_blog ) ) ); ?>">
							<span aria-hidden="true">← </span><?php esc_html_e( 'Rules for Success', 'successcircles' ); ?>
						</a>
					<?php endif; ?>

					<h1 id="rf-article-title" class="sc-display sc-display--xl sc-article__title"><?php the_title(); ?></h1>

					<?php if ( '' !== $sc_role ) : ?>
						<p class="sc-article__guest"><?php echo esc_html( $sc_role ); ?></p>
					<?php endif; ?>
				</div>

				<dl class="sc-article__facts">
					<div>
						<dt><?php esc_html_e( 'Published', 'successcircles' ); ?></dt>
						<dd>
							<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
								<?php echo esc_html( get_the_date() ); ?>
							</time>
						</dd>
					</div>
					<div>
						<dt><?php esc_html_e( 'Read', 'successcircles' ); ?></dt>
						<dd>
							<?php
							printf(
								/* translators: %s: number of minutes. */
								esc_html( _n( '%s minute', '%s minutes', $sc_mins, 'successcircles' ) ),
								esc_html( number_format_i18n( $sc_mins ) )
							);
							?>
						</dd>
					</div>
					<div>
						<dt><?php esc_html_e( 'Format', 'successcircles' ); ?></dt>
						<dd><?php esc_html_e( 'Interview', 'successcircles' ); ?></dd>
					</div>
				</dl>
			</div>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="sc-article__plate">
					<?php
					the_post_thumbnail(
						'full',
						array(
							'class'         => 'sc-article__art',
							'loading'       => 'eager',
							'fetchpriority' => 'high',
						)
					);
					?>
				</figure>
			<?php endif; ?>

		</header>

		<div class="sc-article__body">

			<div class="rf-article__reading">
				<details class="sc-toc" data-sc-toc hidden>
					<summary class="sc-toc__label">
						<svg class="rf-toc__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true" focusable="false"><path d="M8 6h13M8 12h13M8 18h13M3 6h1M3 12h1M3 18h1" stroke-linecap="round"/></svg>
						<span><?php esc_html_e( 'In this conversation', 'successcircles' ); ?></span>
						<svg class="rf-toc__chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true" focusable="false"><path d="m6 9 6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</summary>
					<ol class="sc-toc__list" data-sc-toc-list></ol>
				</details>

				<div class="sc-prose sc-prose--article">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<nav class="rf-post-pages" aria-label="' . esc_attr__( 'Article pages', 'successcircles' ) . '">', 'after' => '</nav>' ) ); ?>
				</div>

			</div>
			<?php get_template_part( 'template-parts/article-sidebar' ); ?>
		</div>
		<footer class="rf-article__end">
			<?php if ( $sc_blog ) : ?><a class="sc-link-rule" href="<?php echo esc_url( successcircles_page_link( 'articles_podcast', get_permalink( $sc_blog ) ) ); ?>"><?php esc_html_e( 'Explore More Conversations', 'successcircles' ); ?> <span aria-hidden="true">↗</span></a><?php endif; ?>
			<a class="sc-link-rule" href="<?php echo esc_url( successcircles_page_link( 'articles_rf_article_title' ) ); ?>"><?php esc_html_e( 'Back to Top', 'successcircles' ); ?> <span aria-hidden="true">↑</span></a>
		</footer>

	</article>

	<?php
	$sc_more = successcircles_more_reading( 2 );

	if ( ! empty( $sc_more ) ) :
		?>
		<section class="sc-band--shade sc-band--hairline rf-more" aria-labelledby="sc-more-title">
			<div class="sc-section sc-section--short">
				<div class="sc-section-head sc-podcast__head">
					<h2 id="sc-more-title" class="sc-display sc-display--sm">
						<?php esc_html_e( 'Keep listening.', 'successcircles' ); ?>
					</h2>
					<?php if ( $sc_blog ) : ?>
						<a class="sc-link-rule" href="<?php echo esc_url( successcircles_page_link( 'articles_podcast', get_permalink( $sc_blog ) ) ); ?>">
							<?php esc_html_e( 'All episodes', 'successcircles' ); ?>
						</a>
					<?php endif; ?>
				</div>

				<?php get_template_part( 'template-parts/episode-grid', null, array( 'episodes' => $sc_more ) ); ?>
			</div>
		</section>
		<?php
	endif;

endwhile;

get_template_part( 'template-parts/home/cta' );

get_footer();
