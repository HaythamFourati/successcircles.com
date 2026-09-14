<?php
/** Run with: php tests/link-settings.php (inside an installed WordPress theme). */
if ( 'cli' !== PHP_SAPI ) { exit; }
define( 'ABSPATH', dirname( __DIR__, 4 ) . '/' );
define( 'SUCCESSCIRCLES_DIR', dirname( __DIR__ ) );
define( 'SUCCESSCIRCLES_URI', 'https://local.test/theme' );
function __( $s, $domain = '' ) { return $s; }
function add_action( ...$args ) {}
function apply_filters( $tag, $value ) { return $value; }
function get_theme_mod( $key, $fallback = '' ) { return $GLOBALS['mods'][ $key ] ?? $fallback; }
function is_front_page() { return false; }
function home_url( $path ) { return 'https://local.test' . $path; }
function wp_strip_all_tags( $value ) { return strip_tags( $value ); }
function sanitize_key( $value ) { return strtolower( preg_replace( '/[^a-zA-Z0-9_\-]/', '', $value ) ); }
function wp_parse_url( $url, $component = -1 ) { return parse_url( $url, $component ); }
function wp_kses_uri_attributes() { return array( 'href', 'src' ); }
function esc_attr( $value ) { return htmlspecialchars( $value, ENT_QUOTES, 'UTF-8' ); }
function _doing_it_wrong( ...$args ) { throw new RuntimeException( implode( ' ', $args ) ); }
foreach ( array( 'content', 'template-tags', 'customizer', 'links' ) as $file ) { require SUCCESSCIRCLES_DIR . '/inc/' . $file . '.php'; }
function check( $actual, $expected, $message ) {
	if ( $actual !== $expected ) { throw new RuntimeException( $message . ': ' . var_export( $actual, true ) ); }
}
check( successcircles_login_url(), 'https://www.momentum.network/', 'Login default' );
$GLOBALS['mods'] = array( 'sc_login_url' => 'https://members.example.com/' );
check( successcircles_page_link( 'header_login' ), 'https://members.example.com/', 'Header inherits shared login' );
check( successcircles_content( 'footer.columns.2.links.3.url' ), 'https://members.example.com/', 'Footer inherits shared login' );
$GLOBALS['mods']['sc_link_header_login'] = 'https://www.momentum.network/';
check( successcircles_page_link( 'header_login' ), 'https://www.momentum.network/', 'Explicit page value wins over shared even when equal to old default' );
$GLOBALS['mods']['sc_link_footer_columns_2_links_3_url'] = '/members/';
check( successcircles_link_url( successcircles_content( 'footer.columns.2.links.3.url' ) ), 'https://local.test/members/', 'Footer override' );
check( successcircles_content_tree( false )['footer']['columns'][2]['links'][3]['url'], 'https://www.momentum.network/', 'Raw defaults never mutate' );
$GLOBALS['mods'] = array();
check( successcircles_page_link( 'momentum_buddy_pricing' ), '#pricing', 'Page section stays local' );
check( successcircles_page_link( 'home_hero_programs' ), 'https://local.test/#programs', 'Home anchor resolves from other pages' );
foreach ( successcircles_page_links() as $key => $link ) {
	$GLOBALS['mods'] = array( successcircles_link_mod( $key ) => 'https://override.test/' );
	check( successcircles_page_link( $key ), 'https://override.test/', 'Override ' . $key );
}
$GLOBALS['mods'] = array();
foreach ( array( 'https://outside.test/' => true, '//outside.test/' => true, 'https://LOCAL.test/about/' => false, '/about/' => false, '#pricing' => false, 'mailto:hello@outside.test' => false, 'tel:+123' => false ) as $url => $expected ) {
	check( (bool) successcircles_is_outbound( $url ), $expected, 'Outbound classification ' . $url );
}
class LinkTestCustomizer {
	public $settings = array(); public $controls = array(); public $sections = array();
	function add_panel( $id, $args ) {}
	function add_section( $id, $args ) { $this->sections[$id] = $args; }
	function add_setting( $id, $args ) { $this->settings[$id] = $args; }
	function add_control( $id, $args ) { $this->controls[$id] = $args; }
}
$manager = new LinkTestCustomizer();
successcircles_customize_register( $manager );
successcircles_customize_page_links( $manager );
foreach ( $manager->controls as $id => $control ) {
	check( isset( $manager->settings[ $control['settings'] ?? $id ] ), true, 'Control has registered setting ' . $id );
	check( isset( $manager->sections[ $control['section'] ] ), true, 'Control has section ' . $id );
}
// Exercise the installed WordPress HTML parser, including rel preservation and scripts.
spl_autoload_register( function ( $class ) {
	if ( str_starts_with( $class, 'WP_HTML_' ) ) {
		$file = ABSPATH . 'wp-includes/html-api/class-' . strtolower( str_replace( '_', '-', $class ) ) . '.php';
		if ( file_exists( $file ) ) { require_once $file; }
	}
} );
require_once ABSPATH . 'wp-includes/utf8.php';
require_once ABSPATH . 'wp-includes/class-wp-token-map.php';
require_once ABSPATH . 'wp-includes/html-api/html5-named-character-references.php';
$html = '<a href="https://outside.test/?x=1&amp;y=2" rel="nofollow">External</a><a href="/about/">Internal</a><a href="tel:+123">Call</a><script>const example = \'<a href="https://outside.test">\';</script>';
$output = successcircles_outbound_links( $html );
check( substr_count( $output, 'target="_blank"' ), 1, 'Only external anchor receives new-tab target' );
check( str_contains( $output, 'nofollow noopener noreferrer' ), true, 'Existing rel preserved' );
check( successcircles_outbound_links( $output ), $output, 'Outbound processing is idempotent' );
echo count( $manager->controls ) . " controls registered; page/shared overrides, anchors, outbound classification and HTML parsing passed.\n";
