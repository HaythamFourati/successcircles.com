<?php
/** Page-level search presentation, maintained alongside the theme content. */
defined( 'ABSPATH' ) || exit;

/** Defaults are summaries of visible copy, not additional claims or keywords. */
function successcircles_seo_pages() {
	return array(
		'home' => array( 'Home', 'Entrepreneur Accountability & Peer Advisory', 'Success Circles helps established business owners turn goals into progress through peer advisory, focused accountability calls, and practical support.' ),
		'momentum-buddy' => array( 'Momentum Buddy', 'Momentum Buddy: Accountability for Business Owners', 'Stay focused with short weekday accountability calls and an experienced business owner matched to your goals. Explore Momentum Buddy membership options.' ),
		'momentum-labs' => array( 'Momentum Labs', 'Momentum Labs: Entrepreneur Peer Advisory', 'Work through business priorities with experienced entrepreneurs. Momentum Labs combines group huddles, strategic sprints, and practical peer support.' ),
		'momentum-team' => array( 'Momentum Team', 'Momentum Team: 90-Day AI Accelerator', 'Build practical systems, strengthen delegation, and complete a major business goal with Momentum Team, a 90-day AI accelerator for business owners.' ),
		'momentum-os' => array( 'Momentum OS', 'Momentum OS: A Weekly System for Business Progress', 'Explore the six-step Momentum OS rhythm: choose a priority, make a commitment, get support, take action, review results, and build on what works.' ),
		'about' => array( 'About', 'About Success Circles: Our Entrepreneur Community', 'Learn how Success Circles brings established entrepreneurs together for honest perspective, focused accountability, and consistent progress on business goals.' ),
		'about-joseph-varghese' => array( 'Founder', 'Joseph Varghese: Founder of Success Circles', 'Meet Joseph Varghese, founder of Success Circles, and learn about his approach to entrepreneur accountability, community, and consistent follow-through.' ),
		'testimonials' => array( 'Testimonials', 'Success Circles Member Testimonials', 'Read member experiences with Success Circles: accountability, peer perspective, and support for making progress on business and personal goals.' ),
		'weekly-wins' => array( 'Weekly Wins', 'Momentum Buzz: Member Wins & Progress', 'Explore wins shared by Success Circles members and see how regular commitments, peer support, and focused action translate into progress.' ),
		'faq' => array( 'FAQ', 'Success Circles FAQ: Programs & Membership', 'Find answers about Success Circles membership, accountability calls, peer matching, and programs for established entrepreneurs and business owners.' ),
		'contact-us' => array( 'Contact', 'Contact Success Circles', 'Contact Success Circles with questions about membership, entrepreneur accountability, or choosing the right program for your business goals.' ),
		'rules-for-success' => array( 'Podcast / Articles', 'Rules for Success: Entrepreneur Conversations', 'Explore Rules for Success conversations with entrepreneurs about business growth, leadership, accountability, and the habits behind consistent progress.' ),
	);
}

function successcircles_seo_key() {
	return is_front_page() ? 'home' : successcircles_seo_slug();
}

function successcircles_seo_page_value( $key, $field ) {
	$pages = successcircles_seo_pages();
	if ( ! isset( $pages[ $key ] ) ) { return ''; }
	$index = 'title' === $field ? 1 : 2;
	$value = trim( (string) get_theme_mod( 'sc_seo_' . $key . '_' . $field, '' ) );
	return '' !== $value ? $value : $pages[ $key ][ $index ];
}

function successcircles_seo_title_parts( $parts ) {
	if ( successcircles_seo_plugin_active() ) { return $parts; }
	$title = successcircles_seo_page_value( successcircles_seo_key(), 'title' );
	if ( '' !== $title ) {
		$parts['title'] = $title;
		$site_name = get_bloginfo( 'name' );
		if ( '' !== $site_name && false === stripos( $title, $site_name ) ) {
			$parts['site'] = $site_name;
		} else {
			unset( $parts['site'] );
		}
		unset( $parts['tagline'] );
	}
	return $parts;
}
add_filter( 'document_title_parts', 'successcircles_seo_title_parts' );

function successcircles_customize_seo( $manager ) {
	$manager->add_panel( 'sc_seo', array(
		'title' => __( 'Success Circles — Search & Sharing', 'successcircles' ),
		'description' => __( 'Search titles and summaries grouped by page. An active SEO plugin owns the document head; configure its metadata there. Blank fields restore the theme defaults.', 'successcircles' ),
		'priority' => 36,
	) );
	foreach ( successcircles_seo_pages() as $key => $page ) {
		$section = 'sc_seo_' . $key;
		$manager->add_section( $section, array( 'title' => $page[0], 'panel' => 'sc_seo' ) );
		foreach ( array( 'title' => 'Search title', 'description' => 'Search description' ) as $field => $label ) {
			$id = $section . '_' . $field;
			$manager->add_setting( $id, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
			$manager->add_control( $id, array(
				'label' => $label, 'section' => $section,
				'type' => 'description' === $field ? 'textarea' : 'text',
				'input_attrs' => array( 'placeholder' => $page[ 'title' === $field ? 1 : 2 ] ),
				'description' => 'title' === $field ? __( 'Use a clear page topic. The site name is appended automatically.', 'successcircles' ) : __( 'Write a concise, accurate summary. Search engines may choose a different excerpt.', 'successcircles' ),
			) );
		}
	}
}
add_action( 'customize_register', 'successcircles_customize_seo' );
