<?php
/**
 * The blog — "Rules for Success". Assigned as the Posts page in
 * Settings → Reading, so this is the podcast/blog listing.
 *
 * Deliberately NOT the homepage's three-up card grid: the newest post is a
 * full-width feature, everything after it is a dated index row. Read the
 * "Journal" block in main.css before flattening it back into cards.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_copy     = (array) successcircles_content( 'episodes', array() );
$sc_page_id  = (int) get_option( 'page_for_posts' );
$sc_intro    = $sc_page_id ? get_post( $sc_page_id ) : null;
$sc_has_lead = have_posts() && ! is_paged();

get_header();

?>
<section class="sc-section sc-journal rf-journal" aria-labelledby="sc-journal-title">

	<header class="sc-journal__head">
		<?php successcircles_eyebrow( '', $sc_copy['eyebrow'] ); ?>
		<h1 id="sc-journal-title" class="sc-display sc-display--xl">
			<?php echo successcircles_inline( $sc_copy['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</h1>
		<p class="sc-journal__lede">
			<?php echo esc_html( wp_specialchars_decode( $sc_copy['lede'] ) ); ?>
		</p>
		<?php if ( have_posts() ) : ?><a class="rf-browse" href="#conversations"><?php esc_html_e( 'Explore the Conversations', 'successcircles' ); ?> <span aria-hidden="true">↓</span></a><?php endif; ?>
		<?php if ( $sc_intro && '' !== trim( $sc_intro->post_content ) ) : ?>
			<div class="sc-prose sc-journal__intro">
				<?php echo wp_kses_post( apply_filters( 'the_content', $sc_intro->post_content ) ); ?>
			</div>
		<?php endif; ?>
	</header>

	<?php if ( ! have_posts() ) : ?>

		<p class="sc-lede"><?php echo esc_html( $sc_copy['empty'] ); ?></p>

	<?php else : ?>

		<ol id="conversations" class="sc-journal__list">
			<?php
			$sc_i = 0;

			while ( have_posts() ) :
				the_post();

				$sc_role  = (string) get_post_meta( get_the_ID(), '_sc_role', true );
				$sc_lead  = $sc_has_lead && 0 === $sc_i;
				$sc_class = $sc_lead ? 'sc-entry sc-entry--lead' : 'sc-entry';
				if ( ! has_post_thumbnail() ) {
					$sc_class .= ' rf-entry--text';
				}
				++$sc_i;
				?>
				<li <?php post_class( $sc_class ); ?>>

					<?php if ( has_post_thumbnail() ) : ?>
						<a class="sc-entry__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
							<?php
							the_post_thumbnail(
								$sc_lead ? 'successcircles-story' : 'successcircles-episode',
								array( 'loading' => $sc_lead ? 'eager' : 'lazy' )
							);
							?>
						</a>
					<?php endif; ?>

					<div class="rf-entry__content">
					<?php if ( $sc_lead ) : ?><p class="rf-feature-label"><?php esc_html_e( 'Latest conversation', 'successcircles' ); ?></p><?php endif; ?>
					<p class="sc-entry__meta">
						<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
							<?php echo esc_html( get_the_date( 'M j, Y' ) ); ?>
						</time>
						<?php if ( '' !== $sc_role ) : ?>
							<span class="sc-entry__role"><?php echo esc_html( $sc_role ); ?></span>
						<?php endif; ?>
					</p>

					<div class="sc-entry__body">
						<h2 class="sc-entry__title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>

						<p class="sc-entry__excerpt">
							<?php echo esc_html( wp_trim_words( get_the_excerpt(), $sc_lead ? 40 : 22 ) ); ?>
						</p>

							<a class="sc-link-rule" href="<?php the_permalink(); ?>">
								<?php esc_html_e( 'Read the conversation', 'successcircles' ); ?>
								<span aria-hidden="true"> ↗</span>
							</a>
					</div>
					</div>

				</li>
				<?php
			endwhile;
			?>
		</ol>

		<?php successcircles_pagination(); ?>

	<?php endif; ?>

</section>
<?php

get_template_part( 'template-parts/home/cta' );

get_footer();
