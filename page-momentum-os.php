<?php
/** Momentum OS — the weekly rhythm behind the community. */
defined( 'ABSPATH' ) || exit;
$sc_system = (array) successcircles_content( 'system', array() );
$sc_prompts = array(
	array( 'Choose what matters', 'Separate the work that grows your business from the work that simply keeps you busy. Start with one outcome you can make meaningful progress on this week.', 'What would make this week a meaningful step forward?' ),
	array( 'Make it specific', 'Turn the priority into a clear commitment. Name what you will finish and when, so another owner can follow up on something concrete.', 'What will I complete before the next check-in?' ),
	array( 'Bring the real obstacle', 'Use your conversation to share progress, test assumptions, and work through what is getting in the way. Leave with a practical next action.', 'Where would another owner’s perspective help most?' ),
	array( 'Protect time to act', 'Put the commitment into your calendar and do the work between conversations. The point is to turn useful insight into something completed.', 'What time am I protecting for this commitment?' ),
	array( 'Learn from the result', 'Look honestly at what moved and what did not. Use the evidence to adjust your approach instead of carrying the same obstacle into another week.', 'What should I keep, change, or stop doing?' ),
	array( 'Build on what works', 'Carry the learning into your next priority. Repeated commitments, feedback, and course corrections make progress a regular practice.', 'What can I repeat to make next week stronger?' ),
);
get_header();
?>
<article class="mos-page">
	<header class="sc-section mos-hero">
		<p class="sc-eyebrow sc-eyebrow--accent">Momentum OS™</p>
		<h1 class="sc-display">Make progress a rhythm.<br><em class="sc-accent">Not a resolution.</em></h1>
		<p class="mos-lede">You already know how to work hard. Momentum OS helps you keep that work connected to your biggest goals—with clear commitments, experienced support, and a weekly rhythm you can repeat.</p>
		<div class="sc-actions sc-actions--center"><a class="sc-btn sc-btn--primary" href="#weekly-cycle">Explore the Six Steps</a><a class="sc-btn sc-btn--ghost" href="<?php echo esc_url( successcircles_url( '#programs' ) ); ?>">Check Our Programs</a></div>
		<nav class="mos-cycle" aria-label="The Momentum OS cycle">
			<?php foreach ( (array) $sc_system['steps'] as $sc_i => $sc_step ) : ?>
				<a href="#os-step-<?php echo esc_attr( $sc_i + 1 ); ?>"><span><?php echo esc_html( sprintf( '%02d', $sc_i + 1 ) ); ?></span><?php echo esc_html( $sc_step['title'] ); ?><span aria-hidden="true">→</span></a>
			<?php endforeach; ?>
		</nav>
	</header>
	<section class="sc-band--dark mos-context">
		<div class="sc-section">
			<h2 class="sc-display">A system you practice.<br>A community that <em class="sc-accent">keeps you going.</em></h2>
			<p class="mos-lede"><?php echo esc_html( wp_specialchars_decode( $sc_system['lede'] ) ); ?></p>
			<p class="mos-context-note">Momentum OS is the operating rhythm behind Success Circles—not a separate software product or another course to finish.</p>
		</div>
	</section>
	<section id="weekly-cycle" class="sc-section mos-steps" aria-labelledby="mos-steps-title">
		<header class="mos-heading"><h2 id="mos-steps-title" class="sc-display">Six steps. One repeatable week.</h2><p class="mos-lede">Start with a priority. Finish with progress and a clearer next move.</p></header>
		<ol>
		<?php foreach ( (array) $sc_system['steps'] as $sc_i => $sc_step ) : ?>
			<li id="os-step-<?php echo esc_attr( $sc_i + 1 ); ?>">
				<span class="mos-number"><?php echo esc_html( sprintf( '%02d', $sc_i + 1 ) ); ?></span>
				<div class="mos-step-copy"><h3><?php echo esc_html( $sc_step['title'] ); ?></h3><p class="mos-step-summary"><?php echo esc_html( wp_specialchars_decode( $sc_step['text'] ) ); ?></p><p><?php echo esc_html( $sc_prompts[$sc_i][1] ?? '' ); ?></p></div>
				<aside class="mos-prompt"><span><?php echo esc_html( $sc_prompts[$sc_i][0] ?? '' ); ?></span><p><?php echo esc_html( $sc_prompts[$sc_i][2] ?? '' ); ?></p></aside>
			</li>
		<?php endforeach; ?>
		</ol>
		<p class="mos-repeat">↻ Take what you learned into the next week. Repeat.</p>
	</section>
	<section class="sc-band--shade"><div class="sc-section mos-fit">
		<h2 class="sc-display">The same rhythm.<br>The support that <em class="sc-accent">fits you.</em></h2>
		<p class="mos-lede">Put Momentum OS into practice with focused one-to-one accountability, group perspective, or an intensive 90-day experience.</p>
		<div class="mos-programs">
			<a href="<?php echo esc_url( successcircles_url( '/momentum-buddy/' ) ); ?>"><span>One-to-one accountability</span><div class="mos-programs__row"><strong>Momentum Buddy™</strong><span aria-hidden="true">↗</span></div></a>
			<a href="<?php echo esc_url( successcircles_url( '/momentum-labs/' ) ); ?>"><span>Group perspective</span><div class="mos-programs__row"><strong>Momentum Labs</strong><span aria-hidden="true">↗</span></div></a>
			<a href="<?php echo esc_url( successcircles_url( '/momentum-team/' ) ); ?>"><span>90-day AI accelerator</span><div class="mos-programs__row"><strong>Momentum Team</strong><span aria-hidden="true">↗</span></div></a>
		</div>
	</div></section>
	<?php while ( have_posts() ) : the_post(); if ( trim( get_the_content() ) ) : ?><div class="sc-section sc-prose"><?php the_content(); ?></div><?php endif; endwhile; ?>
</article>
<?php get_template_part( 'template-parts/home/cta' ); get_footer(); ?>
