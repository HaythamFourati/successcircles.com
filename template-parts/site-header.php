<?php
/**
 * Sticky site header: brand, primary navigation, member login and the primary
 * call to action. Collapses to a drawer below 1024px.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_nav   = (array) successcircles_content( 'nav', array() );
$sc_login = successcircles_login_url();

?>
<header class="sc-header">
	<?php if ( is_singular( 'post' ) ) : ?>
		<div class="sc-progress" aria-hidden="true"><span class="sc-progress__bar" data-sc-progress></span></div>
	<?php endif; ?>

	<div class="sc-header__bar">

		<?php successcircles_logo( 'sc-header__brand' ); ?>

		<nav class="sc-header__nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'successcircles' ); ?>">
			<?php
			successcircles_nav_list(
				'primary',
				$sc_nav,
				array( 'menu_class' => 'sc-header__menu' )
			);
			?>
		</nav>

		<div class="sc-header__aside">
			<a class="sc-header__login" href="<?php echo esc_url( $sc_login ); ?>">
				<?php esc_html_e( 'Member Login', 'successcircles' ); ?>
			</a>
			<a class="sc-btn sc-btn--primary sc-btn--compact" <?php successcircles_test_link_attrs(); ?>>
				<?php esc_html_e( 'Take the Entrepreneur Test', 'successcircles' ); ?>
			</a>
		</div>

		<div class="sc-header__compact">
			<a class="sc-btn sc-btn--primary sc-btn--compact" <?php successcircles_test_link_attrs(); ?>>
				<?php esc_html_e( 'Take the Test', 'successcircles' ); ?>
			</a>
			<button
				class="sc-burger"
				type="button"
				data-sc-menu-toggle
				aria-expanded="false"
				aria-controls="sc-mobile-menu"
			>
				<span aria-hidden="true"></span>
				<span aria-hidden="true"></span>
				<span class="sc-screen-reader-text"><?php esc_html_e( 'Menu', 'successcircles' ); ?></span>
			</button>
		</div>
	</div>

	<nav
		class="sc-header__drawer"
		id="sc-mobile-menu"
		data-sc-menu
		aria-label="<?php esc_attr_e( 'Mobile navigation', 'successcircles' ); ?>"
	>
		<?php
		successcircles_nav_list(
			'primary',
			$sc_nav,
			array( 'menu_class' => 'sc-header__drawer-menu' )
		);
		?>
		<a class="sc-header__login" href="<?php echo esc_url( $sc_login ); ?>">
			<?php esc_html_e( 'Member Login', 'successcircles' ); ?>
		</a>
	</nav>
</header>
