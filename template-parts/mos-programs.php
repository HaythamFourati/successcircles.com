<?php
/**
 * "The same rhythm. The support that fits you." — the three programs that put
 * MomentumOS into practice. Shared by /momentum-os/ and its organizations page,
 * which passes `paths` to open with the two ways to experience the framework.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_paths = (array) ( $args['paths'] ?? array() );
?>
<section class="sc-band--shade"><div class="sc-section mos-fit">
	<?php if ( $sc_paths ) : ?>
		<ul class="org-paths">
			<?php foreach ( $sc_paths as $sc_path ) : ?>
				<li><h3><?php echo esc_html( wp_specialchars_decode( $sc_path['title'] ) ); ?></h3><p><?php echo esc_html( wp_specialchars_decode( $sc_path['text'] ) ); ?></p></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<h2 class="sc-display">The same rhythm.<br>The support that <em class="sc-accent">fits you.</em></h2>
	<p class="mos-lede">Put MomentumOS into practice with focused one-to-one accountability, group perspective, or an intensive 90-day experience.</p>
	<div class="mos-programs">
		<a href="<?php echo esc_url( successcircles_page_link( 'momentum_os_momentum_buddy' ) ); ?>"><span>One-to-one accountability</span><div class="mos-programs__row"><strong>Momentum Buddy™</strong><span aria-hidden="true">↗</span></div></a>
		<a href="<?php echo esc_url( successcircles_page_link( 'momentum_os_momentum_labs' ) ); ?>"><span>Group perspective</span><div class="mos-programs__row"><strong>Momentum Labs</strong><span aria-hidden="true">↗</span></div></a>
		<a href="<?php echo esc_url( successcircles_page_link( 'momentum_os_momentum_team' ) ); ?>"><span>90-day AI accelerator</span><div class="mos-programs__row"><strong>Momentum Team</strong><span aria-hidden="true">↗</span></div></a>
	</div>
</div></section>
