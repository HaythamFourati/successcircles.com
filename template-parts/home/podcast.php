<?php
/**
 * 08 / Rules for Success.
 *
 * The three latest blog posts. The blog is the podcast — see inc/post-types.php.
 * The whole section is skipped when nothing is published, rather than rendering
 * placeholder cards that point off-site.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_podcast  = (array) successcircles_content( 'podcast', array() );
$sc_link     = (array) $sc_podcast['link'];
$sc_episodes = successcircles_episodes( 3 );

if ( empty( $sc_episodes ) ) {
	return;
}

?>
<section id="podcast" class="sc-band--shade sc-band--hairline" aria-labelledby="sc-podcast-title">
	<div class="sc-section sc-section--short">

		<div class="sc-section-head sc-podcast__head">
			<div>
				<?php successcircles_eyebrow( $sc_podcast['index'], $sc_podcast['eyebrow'] ); ?>
				<h2 id="sc-podcast-title" class="sc-display sc-display--sm">
					<?php echo esc_html( $sc_podcast['title'] ); ?>
				</h2>
			</div>
			<a class="sc-link-rule" href="<?php echo successcircles_url( $sc_link['url'] ); ?>">
				<?php echo esc_html( $sc_link['label'] ); ?>
			</a>
		</div>

		<?php get_template_part( 'template-parts/episode-grid', null, array( 'episodes' => $sc_episodes ) ); ?>

	</div>
</section>
