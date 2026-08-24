<?php
/**
 * The Momentum Buzz page — member wins.
 *
 * Automatically used for a page with the slug "weekly-wins". Every quote comes
 * from the live successcircles.com Weekly Wins feed via the cache in
 * inc/wins.php — there is no testimonials post type and nothing to curate in
 * the admin. The page never fetches; it only reads what cron has already stored.
 *
 * Composition — deliberately NOT the testimonials page or the homepage's
 * stories section. The page opens
 * on a split: the heading holds the left rail while the newest win speaks at
 * display size on the right, then the wins fall into a multi-column wall so the
 * page reads as many voices at once rather than a tidy grid. Read the
 * "Testimonials page" block in main.css before changing any of it.
 *
 * The wall carries `--hairline`, not `--curtain`: the curtain radius and its
 * negative pull only make sense lifting a light band over a dark one, and the
 * dark roll-call band that used to sit above it is gone.
 *
 * Page one carries the full composition; later pages are wall only, so the
 * opener is not repeated fifteen times.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_copy = (array) successcircles_content( 'buzz', array() );
$sc_link = (array) $sc_copy['link'];
$sc_wins = successcircles_wins();

$sc_per   = 36;
$sc_pages = (int) ceil( count( $sc_wins ) / $sc_per );

// A query arg rather than /page/2/: this is a static page, so the pretty
// pagination rewrite belongs to the posts page and would 404 here.
$sc_page = isset( $_GET['wins'] ) ? absint( wp_unslash( $_GET['wins'] ) ) : 1; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
$sc_page = max( 1, min( $sc_page, max( 1, $sc_pages ) ) );

$sc_first = ( 1 === $sc_page );
$sc_slice = array_slice( $sc_wins, ( $sc_page - 1 ) * $sc_per, $sc_per );

// The newest win leads the page at display size, so it is not repeated below.
$sc_lead   = $sc_first ? array_shift( $sc_slice ) : null;
$sc_synced = successcircles_wins_synced();

get_header();

?>
<section class="sc-section sc-voices" aria-labelledby="sc-buzz-title">

	<div class="sc-voices__open">

		<div class="sc-voices__rail">
			<?php successcircles_eyebrow( '', $sc_copy['eyebrow'] ); ?>
			<h1 id="sc-buzz-title" class="sc-display sc-display--lg">
				<?php echo successcircles_inline( $sc_copy['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</h1>
			<p class="sc-voices__lede">
				<?php echo esc_html( wp_specialchars_decode( $sc_copy['lede'] ) ); ?>
			</p>
			<a class="sc-link-rule" href="<?php echo successcircles_url( $sc_link['url'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
				<?php echo esc_html( wp_specialchars_decode( $sc_link['label'] ) ); ?>
			</a>

			<?php if ( $sc_synced ) : ?>
				<p class="sc-voices__source">
					<?php
					printf(
						/* translators: 1: source site name, 2: human-readable time difference, e.g. "3 hours". */
						esc_html__( '%1$s &middot; updated %2$s ago', 'successcircles' ),
						esc_html( wp_specialchars_decode( $sc_copy['source'] ) ),
						esc_html( human_time_diff( $sc_synced ) )
					);
					?>
				</p>
			<?php endif; ?>
		</div>

		<?php if ( $sc_lead ) : ?>
			<figure class="sc-voices__lead">
				<span class="sc-voices__marks" aria-hidden="true">&ldquo;</span>
				<blockquote class="sc-voices__lead-text">
					<?php echo esc_html( $sc_lead['text'] ); ?>
				</blockquote>
				<figcaption class="sc-quote__by">
					<span class="sc-quote__rule" aria-hidden="true"></span>
					<span class="sc-quote__name"><?php echo esc_html( $sc_lead['name'] ); ?></span>
					<span class="sc-quote__role"><?php echo esc_html( $sc_lead['date'] ); ?></span>
				</figcaption>
			</figure>
		<?php endif; ?>

	</div>

	<?php
	while ( have_posts() ) :
		the_post();

		if ( trim( get_the_content() ) ) :
			?>
			<div class="sc-prose sc-voices__intro"><?php the_content(); ?></div>
			<?php
		endif;
	endwhile;
	?>

</section>

<section id="wins" class="sc-band--sand sc-band--hairline" aria-label="<?php echo esc_attr( $sc_copy['wall_label'] ); ?>">
	<div class="sc-section">
		<?php if ( ! $sc_wins ) : ?>
			<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_copy['empty'] ) ); ?></p>
		<?php else : ?>
			<div class="sc-wall">
				<?php foreach ( $sc_slice as $sc_win ) : ?>
					<figure class="sc-wall__item">
						<blockquote class="sc-wall__text">
							<?php echo esc_html( $sc_win['text'] ); ?>
						</blockquote>
						<figcaption class="sc-quote__by">
							<span class="sc-quote__rule" aria-hidden="true"></span>
							<span class="sc-quote__name"><?php echo esc_html( $sc_win['name'] ); ?></span>
							<span class="sc-quote__role"><?php echo esc_html( $sc_win['date'] ); ?></span>
						</figcaption>
					</figure>
				<?php endforeach; ?>
			</div>

			<?php
			successcircles_pagination(
				array(
					'base'         => add_query_arg( 'wins', '%#%', get_permalink() ),
					'format'       => '',
					'current'      => $sc_page,
					'total'        => $sc_pages,
					'add_fragment' => '#wins',
				)
			);
			?>
		<?php endif; ?>
	</div>
</section>
<?php

get_template_part( 'template-parts/home/cta' );

get_footer();
