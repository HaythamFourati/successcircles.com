<?php
/** Run with php tests/wins.php. No database or network required. */
define( 'ABSPATH', __DIR__ );
function add_action( ...$args ) {}
function apply_filters( $name, $value ) { return $value; }
function home_url() { return $GLOBALS['test_home']; }
function wp_parse_url( $url, $part ) { return parse_url( $url, $part ); }
function get_category_by_slug( $slug ) { return 'weekly-wins' === $slug ? (object) array( 'term_id' => 7 ) : false; }
function get_posts( $args ) {
	if ( -1 !== $args['posts_per_page'] || 7 !== $args['cat'] || false !== $args['has_password'] || 'publish' !== $args['post_status'] ) { throw new Exception( 'Archive query must include all public wins.' ); }
	return $GLOBALS['test_posts'];
}
function strip_shortcodes( $text ) { return $text; }
function wp_strip_all_tags( $text ) { return strip_tags( $text ); }
function get_option( $key, $default = false ) { return 'date_format' === $key ? 'Y-m-d' : $default; }
function date_i18n( $format, $stamp ) { return gmdate( $format, $stamp ); }
require __DIR__ . '/../inc/wins.php';
function verify_wins( $condition, $message ) { if ( ! $condition ) { throw new Exception( $message ); } }
$GLOBALS['test_home'] = 'https://successcircles.com';
verify_wins( successcircles_wins_is_local(), 'www and non-www must match.' );
$GLOBALS['test_home'] = 'http://successcircles.local';
verify_wins( ! successcircles_wins_is_local(), 'Development must retain remote source.' );
$GLOBALS['test_home'] = 'https://www.successcircles.com';
$GLOBALS['test_posts'] = array();
for ( $id = 1; $id <= 529; $id++ ) {
	$GLOBALS['test_posts'][] = (object) array( 'ID' => $id, 'post_title' => 'Weekly Wins of Member ' . $id, 'post_content' => '<p>Completed an important business milestone.</p>', 'post_date_gmt' => '2026-09-21 12:00:00' );
}
$wins = successcircles_wins();
verify_wins( count( $wins ) === 529, 'All 88 archive pages plus the featured win must be available without a cache or cron.' );
verify_wins( 'Member 529' === $wins[528]['name'], 'Last page must retain its member name.' );
verify_wins( 'Completed an important business milestone.' === $wins[0]['text'], 'Content must remain readable.' );
$GLOBALS['test_posts'] = array();
verify_wins( array() === successcircles_wins(), 'An empty local category must not trigger a remote call.' );
echo "Weekly Wins: production detection, complete archive, parsing and empty state passed.\n";
