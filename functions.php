<?php
/**
 * SuccessCircles theme bootstrap.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'SUCCESSCIRCLES_VERSION' ) ) {
	define( 'SUCCESSCIRCLES_VERSION', '1.0.0' );
}

if ( ! defined( 'SUCCESSCIRCLES_DIR' ) ) {
	define( 'SUCCESSCIRCLES_DIR', get_template_directory() );
}

if ( ! defined( 'SUCCESSCIRCLES_URI' ) ) {
	define( 'SUCCESSCIRCLES_URI', get_template_directory_uri() );
}

require_once SUCCESSCIRCLES_DIR . '/inc/setup.php';
require_once SUCCESSCIRCLES_DIR . '/inc/schema.php';
require_once SUCCESSCIRCLES_DIR . '/inc/llms.php';
require_once SUCCESSCIRCLES_DIR . '/inc/enqueue.php';
require_once SUCCESSCIRCLES_DIR . '/inc/content.php';
require_once SUCCESSCIRCLES_DIR . '/inc/template-tags.php';
require_once SUCCESSCIRCLES_DIR . '/inc/post-types.php';
require_once SUCCESSCIRCLES_DIR . '/inc/customizer.php';
require_once SUCCESSCIRCLES_DIR . '/inc/contact.php';
require_once SUCCESSCIRCLES_DIR . '/inc/cf7.php';
require_once SUCCESSCIRCLES_DIR . '/inc/quiz.php';
require_once SUCCESSCIRCLES_DIR . '/inc/wins.php';
