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
	$absolute = SUCCESSCIRCLES_DIR . $relative_path;

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
	// Google Fonts, preconnected in header.php. Newsreader (display),
	// Public Sans (UI), JetBrains Mono (eyebrows and metadata).
	wp_enqueue_style(
		'successcircles-fonts',
		'https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,300..600;1,6..72,300..500&family=Public+Sans:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'successcircles',
		SUCCESSCIRCLES_URI . '/assets/css/main.css',
		array( 'successcircles-fonts' ),
		successcircles_asset_version( '/assets/css/main.css' )
	);

	wp_enqueue_script(
		'successcircles',
		SUCCESSCIRCLES_URI . '/assets/js/theme.js',
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
 * Add resource hints for the font hosts.
 *
 * @param string[] $urls          URLs to hint.
 * @param string   $relation_type Relation type.
 * @return string[]
 */
function successcircles_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'successcircles_resource_hints', 10, 2 );

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
