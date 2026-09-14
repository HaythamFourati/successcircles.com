<?php
/**
 * Asset registration.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return a filemtime-based version string for a theme-relative asset.
 *
 * @param string $relative_path Path relative to the theme root, with leading slash.
 * @return string
 */
function successcircles_asset_version( $relative_path ) {
	$absolute = SUCCESSCIRCLES_DIR . successcircles_asset_path( $relative_path );

	if ( file_exists( $absolute ) ) {
		return (string) filemtime( $absolute );
	}

	return SUCCESSCIRCLES_VERSION;
}

/**
 * Enqueue front-end styles and scripts.
 *
 * @return void
 */
function successcircles_enqueue_assets() {

	wp_enqueue_style(
		'successcircles',
		SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/main.css' ),
		array(),
		successcircles_asset_version( '/assets/css/main.css' )
	);

	if ( is_page( 'momentum-buddy' ) || is_page_template( 'page-momentum-buddy.php' ) ) {
		wp_enqueue_style( 'successcircles-buddy', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/buddy.css' ), array( 'successcircles' ), successcircles_asset_version( '/assets/css/buddy.css' ) );
	}

	if ( is_page( 'momentum-labs' ) || is_page_template( 'page-momentum-labs.php' ) ) {
		wp_enqueue_style( 'successcircles-labs', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/labs.css' ), array( 'successcircles' ), successcircles_asset_version( '/assets/css/labs.css' ) );
	}

	if ( is_page( 'momentum-team' ) || is_page_template( 'page-momentum-team.php' ) ) {
		wp_enqueue_style( 'successcircles-team', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/team.css' ), array( 'successcircles' ), successcircles_asset_version( '/assets/css/team.css' ) );
	}

	if ( is_page( 'weekly-wins' ) || is_page_template( 'page-weekly-wins.php' ) ) {
		wp_enqueue_style( 'successcircles-wins', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/wins.css' ), array( 'successcircles' ), successcircles_asset_version( '/assets/css/wins.css' ) );
	}

	if ( is_page( 'testimonials' ) || is_page_template( 'page-testimonials.php' ) ) {
		wp_enqueue_style( 'successcircles-testimonials', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/testimonials.css' ), array( 'successcircles' ), successcircles_asset_version( '/assets/css/testimonials.css' ) );
	}

	if ( is_home() ) {
		wp_enqueue_style( 'successcircles-journal', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/journal.css' ), array( 'successcircles' ), successcircles_asset_version( '/assets/css/journal.css' ) );
	}

	if ( is_singular( 'post' ) ) {
		wp_enqueue_style( 'successcircles-article', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/article.css' ), array( 'successcircles' ), successcircles_asset_version( '/assets/css/article.css' ) );
	}

	if ( is_page( 'faq' ) || is_page_template( 'page-faq.php' ) ) {
		wp_enqueue_style( 'successcircles-faq', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/faq.css' ), array( 'successcircles' ), successcircles_asset_version( '/assets/css/faq.css' ) );
	}

	if ( is_page( 'contact-us' ) || is_page_template( 'page-contact-us.php' ) ) {
		wp_enqueue_style( 'successcircles-contact', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/contact.css' ), array( 'successcircles' ), successcircles_asset_version( '/assets/css/contact.css' ) );
	}

	if ( is_page( 'about' ) || is_page_template( 'page-about.php' ) ) {
		wp_enqueue_style( 'successcircles-about', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/about.css' ), array( 'successcircles' ), successcircles_asset_version( '/assets/css/about.css' ) );
	}

	if ( is_page( 'about-joseph-varghese' ) || is_page_template( 'page-about-joseph-varghese.php' ) ) {
		wp_enqueue_style( 'successcircles-joseph', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/joseph.css' ), array( 'successcircles' ), successcircles_asset_version( '/assets/css/joseph.css' ) );
	}

	if ( is_front_page() ) {
		wp_enqueue_style( 'successcircles-home', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/home.css' ), array( 'successcircles' ), successcircles_asset_version( '/assets/css/home.css' ) );
		wp_enqueue_script( 'successcircles-huddle-orbit', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/js/huddle-orbit.js' ), array(), successcircles_asset_version( '/assets/js/huddle-orbit.js' ), true );
		wp_enqueue_script( 'successcircles-hero-video', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/js/hero-video.js' ), array(), successcircles_asset_version( '/assets/js/hero-video.js' ), true );
	}

	if ( is_page( 'momentum-os' ) || is_page_template( 'page-momentum-os.php' ) ) {
		wp_enqueue_style( 'successcircles-os', SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/css/momentum-os.css' ), array( 'successcircles' ), successcircles_asset_version( '/assets/css/momentum-os.css' ) );
	}

	wp_enqueue_script(
		'successcircles',
		SUCCESSCIRCLES_URI . successcircles_asset_path( '/assets/js/theme.js' ),
		array(),
		successcircles_asset_version( '/assets/js/theme.js' ),
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'successcircles_enqueue_assets' );

/**
 * Defer the theme script so it never blocks first paint.
 *
 * @param string $tag    Script tag.
 * @param string $handle Script handle.
 * @return string
 */
function successcircles_defer_script( $tag, $handle ) {
	if ( 'successcircles' === $handle && false === strpos( $tag, 'defer' ) ) {
		$tag = str_replace( ' src=', ' defer src=', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'successcircles_defer_script', 10, 2 );
