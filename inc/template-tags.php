<?php
/**
 * Template helpers.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

/**
 * Allowed inline HTML for headings and copy coming from the content tree.
 *
 * @return array<string, array<string, bool>>
 */
function successcircles_inline_html() {
	return array(
		'em'     => array( 'class' => true ),
		'i'      => array(),
		'strong' => array(),
		'b'      => array(),
		'br'     => array(),
		'span'   => array( 'class' => true ),
		'a'      => array(
			'href'   => true,
			'class'  => true,
			'target' => true,
			'rel'    => true,
		),
	);
}

/**
 * Escape a content-tree string while keeping its inline markup.
 *
 * @param string $html Raw string from the content tree.
 * @return string
 */
function successcircles_inline( $html ) {
	return wp_kses( (string) $html, successcircles_inline_html() );
}

/**
 * Resolve a content-tree link.
 *
 * The design stores two kinds of internal link: on-page anchors ("#programs")
 * and root-relative paths ("/about/"). Anchors only resolve on the homepage, so
 * everywhere else they are sent back to the homepage section; relative paths are
 * expanded against home_url() so the site survives a domain or subdirectory move.
 * External URLs pass through untouched.
 *
 * @param string $url Raw URL from the content tree or Customizer.
 * @return string
 */
function successcircles_link_url( $url ) {
	$url = (string) $url;

	if ( '' === $url ) {
		return '';
	}

	if ( str_starts_with( $url, '#' ) ) {
		return is_front_page() ? $url : home_url( '/' ) . $url;
	}

	if ( str_starts_with( $url, '/' ) && ! str_starts_with( $url, '//' ) ) {
		return home_url( $url );
	}

	return $url;
}

/**
 * Resolve and escape a content-tree link for an href attribute.
 *
 * @param string $url Raw URL from the content tree.
 * @return string
 */
function successcircles_url( $url ) {
	return esc_url( successcircles_link_url( $url ) );
}

/**
 * Read a Customizer value, falling back to the content tree then a default.
 *
 * @param string $mod     Theme mod name.
 * @param string $path    Content-tree path used as the fallback.
 * @param mixed  $default Final fallback.
 * @return mixed
 */
function successcircles_option( $mod, $path = '', $default = '' ) {
	$fallback = '' !== $path ? successcircles_content( $path, $default ) : $default;
	$value    = get_theme_mod( $mod, $fallback );

	return ( '' === $value || null === $value ) ? $fallback : $value;
}

/**
 * The URL the "Take the Entrepreneur Test" buttons point at.
 *
 * @return string
 */
function successcircles_test_url() {
	return successcircles_link_url( successcircles_shared_link( successcircles_content( 'links.test' ) ) );
}

/**
 * The application URL used by the programs and closing CTA.
 *
 * @return string
 */
function successcircles_apply_url() {
	return successcircles_link_url( successcircles_shared_link( successcircles_content( 'links.apply' ) ) );
}

/**
 * The member login URL.
 *
 * @return string
 */
function successcircles_login_url() {
	return successcircles_link_url( successcircles_shared_link( successcircles_content( 'links.member_login' ) ) );
}

/**
 * Render a numbered section eyebrow.
 *
 * @param string $index   Two-digit section index, e.g. '01'. Empty for none.
 * @param string $label   Eyebrow label.
 * @param string $classes Extra classes.
 * @return void
 */
function successcircles_eyebrow( $index, $label, $classes = '' ) {
	if ( '' === $label ) {
		return;
	}

	printf( '<p class="sc-eyebrow %s">', esc_attr( $classes ) );

	if ( '' !== $index ) {
		printf(
			'<span class="sc-eyebrow__index">%s</span> &nbsp;/&nbsp; ',
			esc_html( $index )
		);
	}

	echo esc_html( $label );
	echo '</p>';
}

/**
 * Render the site logo, preferring a Customizer custom logo.
 *
 * @param string $class Wrapper class for the anchor. Sizing is handled in CSS.
 * @return void
 */
function successcircles_logo( $class = 'sc-header__brand' ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );

	printf(
		'<a class="%1$s" href="%2$s" rel="home">',
		esc_attr( $class ),
		esc_url( successcircles_page_link( 'shared_logo' ) )
	);

	if ( $custom_logo_id ) {
		echo wp_get_attachment_image(
			$custom_logo_id,
			'full',
			false,
			array( 'alt' => esc_attr( get_bloginfo( 'name', 'display' ) ) )
		);
	} else {
		printf(
			'<img %1$s alt="%2$s" width="195" height="78" decoding="async" fetchpriority="high">',
			successcircles_responsive_source( 'successcircles-logo.png', array( 195 ), '195px' ),
			esc_attr( get_bloginfo( 'name', 'display' ) )
		);
	}

	echo '</a>';
}

/**
 * New-tab attributes for an off-site link.
 *
 * Content-tree links are stored relative (#anchor or /path/), so anything
 * absolute is external and leaves the site.
 *
 * @param string $url Link URL as stored in the content tree.
 * @return string Attribute string, empty for internal links.
 */
function successcircles_link_target( $url ) {
	return successcircles_is_outbound( successcircles_link_url( $url ) ) ? ' target="_blank" rel="noopener noreferrer"' : '';
}

/**
 * Render a navigation list, using a registered menu when one is assigned and
 * falling back to the links defined in the content tree.
 *
 * @param string                                     $location Menu location.
 * @param array<int, array<string, string>>          $fallback Fallback links.
 * @param array<string, string>                      $args     Wrapper/list classes.
 * @return void
 */
function successcircles_nav_list( $location, $fallback, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'menu_class' => '',
			'item_class' => '',
		)
	);

	if ( has_nav_menu( $location ) ) {
		wp_nav_menu(
			array(
				'theme_location' => $location,
				'container'      => false,
				'menu_class'     => $args['menu_class'],
				// Two levels, so an admin-assigned menu can carry the same
				// dropdown the designed fallback below does.
				'depth'          => 2,
				'fallback_cb'    => false,
			)
		);

		return;
	}

	if ( empty( $fallback ) ) {
		return;
	}

	printf( '<ul class="%s">', esc_attr( $args['menu_class'] ) );

	foreach ( $fallback as $link ) {
		$children = isset( $link['children'] ) ? (array) $link['children'] : array();

		printf(
			'<li class="%1$s%2$s"><a href="%3$s"%4$s>%5$s</a>',
			esc_attr( $args['item_class'] ),
			$children ? ' sc-nav__parent' : '',
			successcircles_url( $link['url'] ),
			successcircles_link_target( $link['url'] ),
			esc_html( wp_specialchars_decode( $link['label'] ) )
		);

		if ( $children ) {
			echo '<ul class="sc-subnav">';

			foreach ( $children as $child ) {
				printf(
					'<li><a href="%1$s"%2$s>%3$s</a></li>',
					successcircles_url( $child['url'] ),
					successcircles_link_target( $child['url'] ),
					esc_html( wp_specialchars_decode( $child['label'] ) )
				);
			}

			echo '</ul>';
		}

		echo '</li>';
	}

	echo '</ul>';
}

/**
 * Testimonials for the stories section.
 *
 * The homepage stories section stays on curated copy by design — the live
 * Weekly Wins feed drives the testimonials page only. Reads the
 * designed copy from the content tree.
 *
 * @param int    $limit    Maximum number of testimonials.
 * @param string $fallback Content-tree path for the fallback set.
 * @return array<int, array<string, string>>
 */
function successcircles_testimonials( $limit = 2, $fallback = 'stories.quotes' ) {
	$items = (array) successcircles_content( $fallback, array() );

	return $limit > 0 ? array_slice( $items, 0, $limit ) : $items;
}

/**
 * Latest Rules for Success posts.
 *
 * Episodes are ordinary WordPress posts — the blog is the podcast. Returns an
 * empty array when nothing is published so callers can show an empty state.
 *
 * @param int $limit Maximum number of posts.
 * @return array<int, array<string, mixed>>
 */
function successcircles_episodes( $limit = 3 ) {
	$query = new WP_Query(
		array(
			'post_type'              => 'post',
			'post_status'            => 'publish',
			'has_password'           => false,
			'posts_per_page'         => $limit,
			'no_found_rows'          => true,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => true,
		)
	);

	return array_map( 'successcircles_episode_fields', $query->posts );
}

/**
 * Map a post onto the fields the episode cards render, so the homepage section
 * and the blog listing share one shape.
 *
 * @param WP_Post $post Post.
 * @return array<string, mixed>
 */
function successcircles_episode_fields( $post ) {
	$image_id = get_post_thumbnail_id( $post->ID );

	return array(
		'id'       => $post->ID,
		'title'    => get_the_title( $post ),
		'role'     => (string) get_post_meta( $post->ID, '_sc_role', true ),
		'url'      => get_permalink( $post ),
		'image_id' => $image_id,
		'image'    => '',
		'alt'      => $image_id ? (string) get_post_meta( $image_id, '_wp_attachment_image_alt', true ) : get_the_title( $post ),
		'excerpt'  => get_the_excerpt( $post ),
		'date'     => get_the_date( '', $post ),
		'datetime' => get_the_date( DATE_W3C, $post ),
	);
}

/**
 * Estimated reading time for a post, in whole minutes.
 *
 * 220 wpm is the usual comfortable-prose figure; these interviews are long
 * enough that the number is genuinely useful rather than decorative.
 *
 * @param int|WP_Post|null $post Post to measure. Defaults to the current post.
 * @return int Minutes, never less than 1.
 */
function successcircles_read_time( $post = null ) {
	$post = get_post( $post );

	if ( ! $post ) {
		return 1;
	}

	$words = str_word_count( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ) );

	return max( 1, (int) round( $words / 220 ) );
}

/**
 * Two more posts to read after this one, newest first, excluding the current.
 *
 * Prefers the neighbouring posts so the pair reads as a sequence, and tops up
 * from the latest posts when the current post sits at either end of the archive.
 *
 * @param int $limit How many to return.
 * @return array<int, array<string, mixed>>
 */
function successcircles_more_reading( $limit = 2 ) {
	$picked = array();

	foreach ( array( get_previous_post(), get_next_post() ) as $neighbour ) {
		if ( $neighbour instanceof WP_Post ) {
			$picked[ $neighbour->ID ] = $neighbour;
		}
	}

	if ( count( $picked ) < $limit ) {
		$fill = get_posts(
			array(
				'post_type'           => 'post',
				'posts_per_page'      => $limit + 1,
				'post__not_in'        => array_merge( array( get_the_ID() ), array_keys( $picked ) ),
				'ignore_sticky_posts' => true,
			)
		);

		foreach ( $fill as $post ) {
			$picked[ $post->ID ] = $post;
		}
	}

	return array_map( 'successcircles_episode_fields', array_slice( $picked, 0, $limit ) );
}

/**
 * Print an image tag for a section, using an attachment when available and a
 * plain remote/theme URL otherwise. Always emits alt text.
 *
 * @param array<string, mixed> $args Image arguments.
 * @return void
 */
function successcircles_image( $args ) {
	$args = wp_parse_args(
		$args,
		array(
			'id'     => 0,
			'src'    => '',
			'alt'    => '',
			'size'   => 'large',
			'class'  => '',
			'width'  => 0,
			'height' => 0,
			'lazy'   => true,
		)
	);

	if ( $args['id'] ) {
		echo wp_get_attachment_image(
			(int) $args['id'],
			$args['size'],
			false,
			array(
				'class'   => $args['class'],
				'alt'     => $args['alt'],
				'loading' => $args['lazy'] ? 'lazy' : 'eager',
			)
		);

		return;
	}

	if ( '' === $args['src'] ) {
		return;
	}

	printf(
		'<img src="%1$s" alt="%2$s" class="%3$s"%4$s%5$s loading="%6$s" decoding="async">',
		esc_url( $args['src'] ),
		esc_attr( wp_specialchars_decode( $args['alt'] ) ),
		esc_attr( $args['class'] ),
		$args['width'] ? ' width="' . absint( $args['width'] ) . '"' : '',
		$args['height'] ? ' height="' . absint( $args['height'] ) . '"' : '',
		$args['lazy'] ? 'lazy' : 'eager'
	);
}

/**
 * Render the concentric dot-ring brand mark used by the loader.
 *
 * Mirrors the prototype's generated SVG-less mark: five counter-rotating rings
 * of pulsing dots around a breathing core.
 *
 * @return void
 */
function successcircles_brand_mark() {
	$rings = array(
		array(
			'count'    => 8,
			'radius'   => 26,
			'diameter' => 7.5,
			'alpha'    => 1.0,
			'duration' => 11,
			'reverse'  => false,
		),
		array(
			'count'    => 12,
			'radius'   => 45,
			'diameter' => 7.0,
			'alpha'    => 0.82,
			'duration' => 15,
			'reverse'  => true,
		),
		array(
			'count'    => 16,
			'radius'   => 64,
			'diameter' => 6.5,
			'alpha'    => 0.62,
			'duration' => 19,
			'reverse'  => false,
		),
		array(
			'count'    => 22,
			'radius'   => 83,
			'diameter' => 6.0,
			'alpha'    => 0.44,
			'duration' => 25,
			'reverse'  => true,
		),
		array(
			'count'    => 28,
			'radius'   => 102,
			'diameter' => 5.5,
			'alpha'    => 0.28,
			'duration' => 31,
			'reverse'  => false,
		),
	);

	$box = 112;

	echo '<span class="sc-mark">';

	foreach ( $rings as $k => $ring ) {
		printf(
			'<span class="sc-mark__ring%1$s" style="--sc-ring-dur:%2$ss">',
			$ring['reverse'] ? ' sc-mark__ring--rev' : '',
			esc_attr( (string) $ring['duration'] )
		);

		$inset = number_format( 100 * ( $box - $ring['radius'] ) / ( 2 * $box ), 3, '.', '' );

		for ( $i = 0; $i < $ring['count']; $i++ ) {
			$angle = number_format( ( $i / $ring['count'] ) * 360, 3, '.', '' );
			$delay = number_format( ( $i / $ring['count'] ) * 2.1 + $k * 0.14, 3, '.', '' );

			printf(
				'<span class="sc-mark__spoke" style="--sc-spoke-inset:%1$s%%;--sc-spoke-angle:%2$sdeg"><span class="sc-mark__dot" style="--sc-dot-size:%3$spx;--sc-dot-alpha:%4$s;--sc-dot-delay:%5$ss"></span></span>',
				esc_attr( $inset ),
				esc_attr( $angle ),
				esc_attr( (string) $ring['diameter'] ),
				esc_attr( (string) $ring['alpha'] ),
				esc_attr( $delay )
			);
		}

		echo '</span>';
	}

	echo '<span class="sc-mark__core"></span>';
	echo '<span class="sc-mark__halo"></span>';
	echo '</span>';
}

/**
 * Render pagination for archive templates.
 *
 * @return void
 */
function successcircles_pagination( $args = array() ) {
	$links = paginate_links(
		array_merge(
			array(
				'type'      => 'plain',
				'mid_size'  => 1,
				'prev_text' => __( 'Previous', 'successcircles' ),
				'next_text' => __( 'Next', 'successcircles' ),
			),
			$args
		)
	);

	if ( ! $links ) {
		return;
	}

	printf(
		'<nav class="sc-pagination" aria-label="%1$s">%2$s</nav>',
		esc_attr__( 'Posts navigation', 'successcircles' ),
		wp_kses_post( $links )
	);
}

/**
 * Inline SVG glyph for a social network, keyed by its content-tree label.
 *
 * ponytail: one map shared by the footer and the contact page; an unknown
 * label simply yields no glyph and the text label carries the link.
 *
 * @param string $label Social link label.
 * @param int    $size  Square pixel size.
 * @return string SVG markup, or an empty string.
 */
function successcircles_social_icon( $label, $size = 20 ) {
	$paths = array(
		'linkedin'  => 'M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.45-2.13 2.94v5.67H9.35V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.45v6.29zM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12zM7.12 20.45H3.55V9h3.57v11.45zM22.22 0H1.77C.79 0 0 .77 0 1.73v20.54C0 23.23.79 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.73V1.73C24 .77 23.2 0 22.22 0z',
		'youtube'   => 'M23.5 6.2a3.02 3.02 0 0 0-2.12-2.14C19.5 3.55 12 3.55 12 3.55s-7.5 0-9.38.51A3.02 3.02 0 0 0 .5 6.2C0 8.08 0 12 0 12s0 3.92.5 5.8a3.02 3.02 0 0 0 2.12 2.14c1.88.51 9.38.51 9.38.51s7.5 0 9.38-.51a3.02 3.02 0 0 0 2.12-2.14C24 15.92 24 12 24 12s0-3.92-.5-5.8zM9.55 15.57V8.43L15.82 12l-6.27 3.57z',
		'facebook'  => 'M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.02 1.79-4.69 4.53-4.69 1.31 0 2.69.24 2.69.24v2.97h-1.52c-1.49 0-1.96.93-1.96 1.89v2.25h3.33l-.53 3.49h-2.8V24C19.61 23.1 24 18.1 24 12.07z',
		'x'         => 'M18.9 1.15h3.68l-8.04 9.19L24 22.85h-7.41l-5.8-7.58-6.63 7.58H.48l8.6-9.83L0 1.15h7.6l5.24 6.93 6.06-6.93zm-1.29 19.5h2.04L6.49 3.24H4.3L17.61 20.65z',
		'instagram' => 'M12 2.16c3.2 0 3.58.01 4.85.07 1.17.05 1.8.25 2.23.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.06.41 2.23.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.25 1.8-.41 2.23-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.06.36-2.23.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.25-2.23-.41-.56-.22-.96-.48-1.38-.9-.42-.42-.68-.82-.9-1.38-.16-.42-.36-1.06-.41-2.23-.06-1.27-.07-1.65-.07-4.85s.01-3.58.07-4.85c.05-1.17.25-1.8.41-2.23.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.06-.36 2.23-.41 1.27-.06 1.65-.07 4.85-.07M12 0C8.74 0 8.33.01 7.05.07 5.78.13 4.9.33 4.14.63c-.79.3-1.46.71-2.13 1.38C1.34 2.68.93 3.35.63 4.14.33 4.9.13 5.78.07 7.05.01 8.33 0 8.74 0 12s.01 3.67.07 4.95c.06 1.27.26 2.15.56 2.91.3.79.71 1.46 1.38 2.13.67.67 1.34 1.08 2.13 1.38.76.3 1.64.5 2.91.56C8.33 23.99 8.74 24 12 24s3.67-.01 4.95-.07c1.27-.06 2.15-.26 2.91-.56.79-.3 1.46-.71 2.13-1.38.67-.67 1.08-1.34 1.38-2.13.3-.76.5-1.64.56-2.91.06-1.28.07-1.69.07-4.95s-.01-3.67-.07-4.95c-.06-1.27-.26-2.15-.56-2.91-.3-.79-.71-1.46-1.38-2.13C21.32 1.34 20.65.93 19.86.63c-.76-.3-1.64-.5-2.91-.56C15.67.01 15.26 0 12 0zm0 5.84a6.16 6.16 0 1 0 0 12.32 6.16 6.16 0 0 0 0-12.32zm0 10.16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm7.85-10.4a1.44 1.44 0 1 1-2.88 0 1.44 1.44 0 0 1 2.88 0z',
		'tiktok'    => 'M16.6 5.82A4.28 4.28 0 0 1 15.54 3h-3.09v12.4a2.59 2.59 0 0 1-2.59 2.5 2.59 2.59 0 1 1 .77-5.06v-3.2a5.72 5.72 0 0 0-.77-.05A5.72 5.72 0 1 0 15.54 15V8.9a7.34 7.34 0 0 0 4.3 1.38V7.2a4.3 4.3 0 0 1-3.24-1.38z',
	);

	$key = sanitize_key( $label );

	if ( empty( $paths[ $key ] ) ) {
		return '';
	}

	return sprintf(
		'<svg class="sc-social-icon" width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="%2$s"/></svg>',
		(int) $size,
		esc_attr( $paths[ $key ] )
	);
}
