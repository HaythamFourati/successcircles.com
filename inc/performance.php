<?php
/** Asset delivery without changing the visitor's content or interactions. */
defined( 'ABSPATH' ) || exit;

/** Use the minified derivative only when it is as fresh as its source. */
function successcircles_asset_path( $path ) {
	$min = preg_replace( '/\.(css|js)$/', '.min.$1', $path );
	if ( '/assets/css/main.css' === $path && is_front_page() ) { $min = '/assets/css/main-home.min.css'; }
	if ( $min !== $path && is_file( SUCCESSCIRCLES_DIR . $min ) && filemtime( SUCCESSCIRCLES_DIR . $min ) >= filemtime( SUCCESSCIRCLES_DIR . $path ) ) { return $min; }
	return $path;
}

/** Responsive images retain their original dimensions, crop and alt text. */
function successcircles_responsive_source( $name, $widths, $sizes ) {
	$stem = str_replace( '/', '-', preg_replace( '/\.[^.]+$/', '', $name ) );
	$srcset = array();
	foreach ( $widths as $width ) {
		$file = '/assets/img/optimized/' . $stem . '-' . $width . '.webp';
		if ( is_file( SUCCESSCIRCLES_DIR . $file ) ) { $srcset[] = SUCCESSCIRCLES_URI . $file . ' ' . $width . 'w'; }
	}
	if ( ! $srcset ) { return 'src="' . esc_url( SUCCESSCIRCLES_URI . '/assets/img/' . $name ) . '"'; }
	$first = explode( ' ', $srcset[0] );
	return 'src="' . esc_url( $first[0] ) . '" srcset="' . esc_attr( implode( ', ', $srcset ) ) . '" sizes="' . esc_attr( $sizes ) . '"';
}

/** Inline the tiny local font declarations; preload only first-screen Latin faces. */
function successcircles_font_head() {
	$path = SUCCESSCIRCLES_DIR . '/assets/css/fonts.css';
	if ( ! is_file( $path ) ) { return; }
	$css = str_replace( '../fonts/', esc_url( SUCCESSCIRCLES_URI . '/assets/fonts/' ), file_get_contents( $path ) );
	echo '<style id="sc-local-fonts">' . $css . '</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	foreach ( array( 'public-sans-normal-latin', 'newsreader-normal-latin', 'newsreader-italic-latin' ) as $name ) {
		printf( '<link rel="preload" as="font" type="font/woff2" href="%s" crossorigin>' . "\n", esc_url( SUCCESSCIRCLES_URI . '/assets/fonts/' . $name . '.woff2' ) );
	}
}
add_action( 'wp_head', 'successcircles_font_head', 2 );

/** The homepage contains the theme quiz, but no Contact Form 7 form. */
function successcircles_home_plugin_assets() {
	if ( ! is_front_page() ) { return; }
	wp_dequeue_style( 'contact-form-7' );
	wp_dequeue_script( 'contact-form-7' );
	wp_dequeue_script( 'swv' );
}
add_action( 'wp_enqueue_scripts', 'successcircles_home_plugin_assets', 99 );
