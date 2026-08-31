<?php
/**
 * Customizer settings for the small, global values that change independently
 * of the page copy: prices, CTA destinations, phone number and social links.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the SuccessCircles Customizer panel.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @return void
 */
function successcircles_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'sc_panel',
		array(
			'title'       => __( 'SuccessCircles', 'successcircles' ),
			'description' => __( 'Global values used across the homepage. Section copy lives in the theme&rsquo;s inc/content.php.', 'successcircles' ),
			'priority'    => 20,
		)
	);

	/* ---------------------------------------------------------------- Links */

	$wp_customize->add_section(
		'sc_links',
		array(
			'title' => __( 'Calls to action', 'successcircles' ),
			'panel' => 'sc_panel',
		)
	);

	$links = array(
		'sc_test_url'  => array(
			'label'   => __( 'Entrepreneur Test URL', 'successcircles' ),
			'default' => successcircles_content( 'links.test' ),
		),
		'sc_apply_url' => array(
			'label'   => __( 'Application URL', 'successcircles' ),
			'default' => successcircles_content( 'links.apply' ),
		),
		'sc_login_url' => array(
			'label'   => __( 'Member Login URL', 'successcircles' ),
			'default' => successcircles_content( 'links.member_login' ),
		),
	);

	foreach ( $links as $id => $link ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $link['default'],
				'sanitize_callback' => 'successcircles_sanitize_link',
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			$id,
			array(
				'label'       => $link['label'],
				'section'     => 'sc_links',
				'type'        => 'text',
				'description' => __( 'A full URL, or an on-page anchor such as #test.', 'successcircles' ),
			)
		);
	}

	/* -------------------------------------------------------------- Pricing */

	$wp_customize->add_section(
		'sc_pricing',
		array(
			'title' => __( 'Pricing', 'successcircles' ),
			'panel' => 'sc_panel',
		)
	);

	$prices = array(
		'sc_buddy_price' => array(
			'label'   => __( 'Momentum Braintrust Buddy', 'successcircles' ),
			'default' => successcircles_content( 'programs.cards.0.price', '$194' ),
		),
		'sc_labs_price'  => array(
			'label'   => __( 'Momentum Labs', 'successcircles' ),
			'default' => successcircles_content( 'programs.cards.1.price', '$97' ),
		),
		'sc_team_price'  => array(
			'label'   => __( 'Momentum Team', 'successcircles' ),
			'default' => successcircles_content( 'programs.cards.2.price', '$797' ),
		),
	);

	foreach ( $prices as $id => $price ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $price['default'],
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			$id,
			array(
				'label'       => $price['label'],
				'section'     => 'sc_pricing',
				'type'        => 'text',
				'description' => __( 'Shown as "/mo" in the program card.', 'successcircles' ),
			)
		);
	}

	/* -------------------------------------------------------------- Contact */

	$wp_customize->add_section(
		'sc_contact',
		array(
			'title' => __( 'Contact &amp; social', 'successcircles' ),
			'panel' => 'sc_panel',
		)
	);

	$wp_customize->add_setting(
		'sc_contact_email',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_email',
		)
	);

	$wp_customize->add_control(
		'sc_contact_email',
		array(
			'label'       => __( 'Contact form recipient', 'successcircles' ),
			'section'     => 'sc_contact',
			'type'        => 'email',
			'description' => __( 'Where the contact page form is delivered. Defaults to the site admin email.', 'successcircles' ),
		)
	);

	$wp_customize->add_setting(
		'sc_phone',
		array(
			'default'           => 'Tel +1 (747) 2CIRCLE  /  +1 (747) 224-7253',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'sc_phone',
		array(
			'label'   => __( 'Footer phone line', 'successcircles' ),
			'section' => 'sc_contact',
			'type'    => 'text',
		)
	);

	foreach ( (array) successcircles_content( 'footer.social', array() ) as $index => $social ) {
		$id = 'sc_social_' . sanitize_key( $social['label'] );

		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $social['url'],
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			$id,
			array(
				/* translators: %s: social network name. */
				'label'   => sprintf( __( '%s URL', 'successcircles' ), $social['label'] ),
				'section' => 'sc_contact',
				'type'    => 'url',
			)
		);
	}
}
add_action( 'customize_register', 'successcircles_customize_register' );

/**
 * Allow either a URL or an on-page anchor.
 *
 * @param string $value Raw value.
 * @return string
 */
function successcircles_sanitize_link( $value ) {
	$value = trim( (string) $value );

	if ( 0 === strpos( $value, '#' ) ) {
		return '#' . sanitize_title( substr( $value, 1 ) );
	}

	return esc_url_raw( $value );
}

/**
 * Resolve the URL for a social link, honouring its Customizer override.
 *
 * @param array<string, string> $social Social link from the content tree.
 * @return string
 */
function successcircles_social_url( $social ) {
	return (string) get_theme_mod( 'sc_social_' . sanitize_key( $social['label'] ), $social['url'] );
}

/**
 * Return a program card's price, honouring the Customizer overrides.
 *
 * @param int    $index   Card index.
 * @param string $default Fallback price.
 * @return string
 */
function successcircles_program_price( $index, $default = '' ) {
	$mods = array( 0 => 'sc_buddy_price', 1 => 'sc_labs_price', 2 => 'sc_team_price' );

	if ( isset( $mods[ $index ] ) ) {
		return (string) get_theme_mod( $mods[ $index ], $default );
	}

	return $default;
}
