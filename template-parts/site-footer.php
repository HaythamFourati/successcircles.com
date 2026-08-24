<?php
/**
 * Site footer: brand blurb, three link columns and the legal bar.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_columns = (array) successcircles_content( 'footer.columns', array() );
$sc_legal   = (array) successcircles_content( 'footer.legal', array() );
$sc_social  = (array) successcircles_content( 'footer.social', array() );

?>
<footer class="sc-footer sc-band--dark" role="contentinfo">
	<div class="sc-footer__top">

		<div class="sc-footer__brand">
			<?php successcircles_logo( 'sc-footer__brand-link' ); ?>
			<p class="sc-footer__blurb">
				<?php echo esc_html( wp_specialchars_decode( successcircles_content( 'footer.blurb' ) ) ); ?>
			</p>
		</div>

		<?php foreach ( $sc_columns as $sc_column ) : ?>
			<nav aria-label="<?php echo esc_attr( $sc_column['heading'] ); ?>">
				<h2 class="sc-footer__heading"><?php echo esc_html( $sc_column['heading'] ); ?></h2>
				<?php
				successcircles_nav_list(
					$sc_column['menu'],
					$sc_column['links'],
					array( 'menu_class' => 'sc-footer__list' )
				);
				?>
			</nav>
		<?php endforeach; ?>

	</div>

	<div class="sc-footer__bottom">
		<span>
			<?php
			printf(
				/* translators: %1$s: year, %2$s: site name. */
				esc_html__( '&copy; %1$s %2$s', 'successcircles' ),
				esc_html( gmdate( 'Y' ) ),
				esc_html( get_bloginfo( 'name', 'display' ) )
			);
			?>
			<?php foreach ( $sc_legal as $sc_link ) : ?>
				&nbsp;&nbsp;/&nbsp;&nbsp;<a href="<?php echo successcircles_url( $sc_link['url'] ); ?>"><?php echo esc_html( $sc_link['label'] ); ?></a>
			<?php endforeach; ?>
		</span>

		<ul class="sc-footer__social">
			<?php foreach ( $sc_social as $sc_item ) : ?>
				<li>
					<a href="<?php echo esc_url( successcircles_social_url( $sc_item ) ); ?>" rel="noopener noreferrer" target="_blank">
						<?php echo esc_html( $sc_item['label'] ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

		<span><?php echo esc_html( wp_specialchars_decode( successcircles_option( 'sc_phone', 'footer.phone' ) ) ); ?></span>
	</div>
</footer>
