<?php
/** Page-specific link controls and site-wide outbound link behavior. */
defined( 'ABSPATH' ) || exit;

/** Customizer sections, ordered like the site navigation. */
function successcircles_link_groups() {
	return array(
		'header' => 'Header & navigation', 'home' => 'Home page',
		'momentum_buddy' => 'Momentum Buddy', 'momentum_labs' => 'Momentum Labs',
		'momentum_team' => 'Momentum Team', 'momentum_os' => 'Momentum OS',
		'testimonials' => 'Testimonials', 'weekly_wins' => 'Weekly Wins',
		'podcast' => 'Podcast', 'articles' => 'Podcast articles',
		'about' => 'About', 'about_joseph_varghese' => 'About Joseph',
		'faq' => 'FAQ', 'contact_us' => 'Contact', 'footer' => 'Footer',
		'not_found' => '404 page',
	);
}

/** Stable location IDs also serve as theme-mod keys. */
function successcircles_link_mod( $path ) {
	return 'sc_link_' . str_replace( '.', '_', $path );
}

/** Walk only clickable content links, never image sources or player embeds. */
function successcircles_walk_links( $tree, $callback, $path = '' ) {
	foreach ( $tree as $key => $value ) {
		$location = '' === $path ? (string) $key : $path . '.' . $key;
		if ( is_array( $value ) ) {
			$tree[ $key ] = successcircles_walk_links( $value, $callback, $location );
		} elseif ( in_array( $key, array( 'url', 'cta_url', 'link_url' ), true ) && is_string( $value ) && ! str_starts_with( $location, 'footer.social.' ) ) {
			$tree[ $key ] = $callback( $value, $location, $tree );
		}
	}
	return $tree;
}

/** Shared defaults apply only when a page location has no override. */
function successcircles_shared_link( $url ) {
	foreach ( successcircles_important_links() as $mod => $link ) {
		if ( $url === $link['default'] || ( 'sc_login_url' === $mod && 'https://www.successcircles.com/member-resources/' === $url ) ) {
			$value = get_theme_mod( $mod, '' );
			return '' === $value ? $link['default'] : $value;
		}
	}
	return $url;
}

/** Apply location overrides without changing the raw defaults. */
function successcircles_customize_link_tree( $tree ) {
	return successcircles_walk_links( $tree, function ( $default, $path ) {
		$value = get_theme_mod( successcircles_link_mod( $path ), '' );
		return '' === $value ? successcircles_shared_link( $default ) : $value;
	} );
}

/** Template-only link catalog, including generated section navigation. */
function successcircles_page_links() {
	static $links = null;
	if ( null !== $links ) { return $links; }
	$links = require SUCCESSCIRCLES_DIR . '/inc/link-locations.php';
	$raw = successcircles_content_tree( false );
	foreach ( $raw['faq_page']['groups'] as $index => $group ) {
		$links[ 'faq_group_' . $index ] = array(
			'group' => 'faq', 'default' => '#sc-faq-group-' . $index,
			'label' => 'Topic navigation — ' . wp_strip_all_tags( $group['title'] ?? $group['label'] ?? (string) ( $index + 1 ) ),
		);
	}
	return $links;
}

/** Resolve a template location; local section anchors stay on their own page. */
function successcircles_page_link( $key, $fallback = null ) {
	$links = successcircles_page_links();
	$default = $fallback ?? ( $links[ $key ]['default'] ?? '' );
	$value = (string) get_theme_mod( successcircles_link_mod( $key ), '' );
	$value = '' === $value ? successcircles_shared_link( $default ) : $value;
	if ( str_starts_with( $value, '#' ) && ! in_array( $value, array( '#test', '#programs' ), true ) ) {
		return $value;
	}
	return successcircles_link_url( $value );
}

/** Register a location with its visible placement and inherited destination. */
function successcircles_add_link_control( $manager, $key, $group, $label, $default ) {
	$id = successcircles_link_mod( $key );
	$manager->add_setting( $id, array( 'default' => '', 'sanitize_callback' => 'successcircles_sanitize_link', 'transport' => 'refresh' ) );
	$manager->add_control( $id, array(
		'section' => 'sc_links_' . $group, 'type' => 'text',
		'label' => html_entity_decode( wp_strip_all_tags( $label ), ENT_QUOTES, 'UTF-8' ),
		'description' => sprintf( __( 'Leave blank to use the default (%s) or its shared override. Accepts a URL, /page/, #section, mailto: or tel: link.', 'successcircles' ), $default ),
		'input_attrs' => array( 'placeholder' => $default ),
	) );
}

function successcircles_customize_page_links( $manager ) {
	$manager->add_panel( 'sc_links_panel', array(
		'title' => __( 'Success Circles — Links', 'successcircles' ), 'priority' => 21,
		'description' => __( 'Choose the page where a link appears. Blank fields inherit shared defaults. Header and footer navigation fields apply to the theme menus; assigned WordPress menus are editable in the Customizer’s Menus panel. Links inside post/page content are edited with that content. External websites open in a new tab.', 'successcircles' ),
	) );
	foreach ( successcircles_link_groups() as $group => $label ) {
		$manager->add_section( 'sc_links_' . $group, array(
			'title' => $label, 'panel' => 'sc_links_panel',
			'description' => 'Edit links shown in ' . $label . '. Repeated buttons with the same setting update together. Shared calls to action can be changed in Shared defaults.',
		) );
	}
	foreach ( successcircles_page_links() as $key => $link ) {
		successcircles_add_link_control( $manager, $key, $link['group'], $link['label'], $link['default'] );
	}
	$groups = array( 'nav' => 'header', 'footer' => 'footer', 'faq_page' => 'faq', 'contact' => 'contact_us', 'buzz' => 'weekly_wins', 'testimonials' => 'testimonials', 'founder_page' => 'about_joseph_varghese', 'buddy_page' => 'momentum_buddy', 'labs_page' => 'momentum_labs', 'team_page' => 'momentum_team', 'about' => 'about', 'episodes' => 'podcast', 'article_links' => 'articles' );
	successcircles_walk_links( successcircles_content_tree( false ), function ( $default, $path, $node ) use ( $manager, $groups ) {
		$parts = explode( '.', $path );
		if ( 'faq_page.aside.link.url' === $path ) { return $default; }
		$group = $groups[ $parts[0] ] ?? 'home';
		$places = array( 'nav' => 'Navigation', 'footer' => 'Footer', 'programs' => 'Program cards', 'stories' => 'Success stories', 'founder' => 'Founder', 'podcast' => 'Podcast', 'faq' => 'FAQ', 'community' => 'Community', 'contact' => 'Contact channels', 'faq_page' => 'Help sidebar', 'buzz' => 'Closing link', 'testimonials' => 'Closing link', 'labs_page' => 'Signup / founder links', 'team_page' => 'Signup — hero, pricing and closing' );
		$place = $places[ $parts[0] ] ?? ucwords( str_replace( '_', ' ', $parts[0] ) );
		if ( 'footer' === $parts[0] && 'columns' === ( $parts[1] ?? '' ) ) {
			$place = successcircles_content_tree( false )['footer']['columns'][ $parts[2] ]['heading'];
		} elseif ( 'nav' === $parts[0] && in_array( 'children', $parts, true ) ) {
			$place .= ' — ' . successcircles_content_tree( false )['nav'][ $parts[1] ]['label'] . ' submenu';
		}
		$label = $node['label'] ?? $node['name'] ?? $node['title'] ?? $node['cta'] ?? $node['link'] ?? 'Destination';
		if ( ! is_string( $label ) ) { $label = 'Destination'; }
		successcircles_add_link_control( $manager, $path, $group, $place . ' — ' . $label, $default );
		return $default;
	} );
	// Social destinations are shared by the footer and Contact page.
	foreach ( successcircles_content( 'footer.social', array() ) as $social ) {
		$id = 'sc_social_' . sanitize_key( $social['label'] );
		foreach ( array( 'footer', 'contact_us' ) as $group ) {
			$manager->add_control( $id . '_' . $group, array( 'settings' => $id, 'section' => 'sc_links_' . $group, 'type' => 'url', 'label' => $social['label'] . ' — shared social profile', 'description' => 'Updates both the footer and Contact page.' ) );
		}
	}
}
add_action( 'customize_register', 'successcircles_customize_page_links', 20 );

/** External means an HTTP(S) destination on another host, not mail or telephone. */
function successcircles_is_outbound( $url ) {
	$host = wp_parse_url( $url, PHP_URL_HOST );
	$scheme = wp_parse_url( $url, PHP_URL_SCHEME );
	return $host && ( null === $scheme || in_array( strtolower( $scheme ), array( 'http', 'https' ), true ) ) && strtolower( $host ) !== strtolower( (string) wp_parse_url( home_url( '/' ), PHP_URL_HOST ) );
}

/** Use WordPress's HTML parser so all rendered anchors, including post content, agree. */
function successcircles_outbound_links( $html ) {
	$processor = new WP_HTML_Tag_Processor( $html );
	while ( $processor->next_tag( 'A' ) ) {
		if ( ! successcircles_is_outbound( (string) $processor->get_attribute( 'href' ) ) ) { continue; }
		$processor->set_attribute( 'target', '_blank' );
		$rel = preg_split( '/\s+/', trim( (string) $processor->get_attribute( 'rel' ) ), -1, PREG_SPLIT_NO_EMPTY );
		$processor->set_attribute( 'rel', implode( ' ', array_unique( array_merge( $rel, array( 'noopener', 'noreferrer' ) ) ) ) );
	}
	return $processor->get_updated_html();
}

/** Buffer only HTML theme requests; feeds, API responses, and admin stay untouched. */
function successcircles_start_link_buffer() {
	if ( ! is_admin() && ! is_feed() && ! is_robots() && ! is_trackback() && ! wp_doing_ajax() ) {
		ob_start( 'successcircles_outbound_links' );
	}
}
add_action( 'template_redirect', 'successcircles_start_link_buffer', 20 );
