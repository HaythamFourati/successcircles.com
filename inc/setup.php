<?php
/**
 * Theme supports, menus and other one-time setup.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme supports and navigation menus.
 *
 * @return void
 */
function successcircles_setup() {
	load_theme_textdomain( 'successcircles', SUCCESSCIRCLES_DIR . '/languages' );

	// Let WordPress emit <title>, feed links and the meta description hooks
	// that SEO plugins rely on, rather than hardcoding them in header.php.
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);

	add_theme_support(
		'custom-logo',
		array(
			'width'       => 390,
			'height'      => 156,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	register_nav_menus(
		array(
			'primary'         => __( 'Primary Navigation', 'successcircles' ),
			'footer_programs' => __( 'Footer: Programs', 'successcircles' ),
			'footer_explore'  => __( 'Footer: Explore', 'successcircles' ),
			'footer_company'  => __( 'Footer: Company', 'successcircles' ),
		)
	);

	// Episode artwork is a designed banner with the guest's name set into it, so
	// it is never hard-cropped — these are proportional resizes, and the cards
	// fit the whole image inside their frame rather than filling it.
	add_image_size( 'successcircles-episode', 760, 760, false );
	add_image_size( 'successcircles-story', 1400, 1400, false );
}
add_action( 'after_setup_theme', 'successcircles_setup' );

/**
 * Constrain the width of embedded and oEmbed content.
 *
 * @return void
 */
function successcircles_content_width() {
	$GLOBALS['content_width'] = 1280;
}
add_action( 'after_setup_theme', 'successcircles_content_width', 0 );

/**
 * Is an SEO plugin handling the document head?
 *
 * Yoast, Rank Math and SEOPress all emit their own description, canonical,
 * robots and Open Graph tags. When one is present the theme steps aside on
 * every one of them rather than emitting a competing set.
 *
 * @return bool
 */
function successcircles_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' ) || defined( 'SEOPRESS_VERSION' );
}

/**
 * The page this request is "about", for content-tree lookups.
 *
 * Covers ordinary pages and the Posts page, which is a page too but is not
 * `is_singular()` — that is why the blog index had no description.
 *
 * @return string Page slug, or an empty string.
 */
function successcircles_seo_slug() {
	if ( ! is_page() && ! is_home() ) {
		return '';
	}

	$queried = get_queried_object();

	return ( $queried instanceof WP_Post ) ? (string) $queried->post_name : '';
}

/**
 * Content-tree path to use as each page's description.
 *
 * Also drives llms.txt, so the two never disagree about what a page is about.
 *
 * @return array<string, string> Page slug => content-tree dot path.
 */
function successcircles_seo_description_paths() {
	/**
	 * Filter the content-tree path used as each page's description.
	 *
	 * @param array<string, string> $paths Page slug => content-tree dot path.
	 */
	return (array) apply_filters(
		'successcircles_seo_descriptions',
		array(
			'about'                 => 'about.lede',
			'momentum-buddy'        => 'buddy_page.lede',
			'momentum-labs'         => 'labs_page.lede',
			'momentum-team'         => 'team_page.lede',
			'about-joseph-varghese' => 'founder_page.lede',
			'testimonials'          => 'testimonials.lede',
			'weekly-wins'           => 'buzz.lede',
			'faq'                   => 'faq_page.lede',
			'contact-us'            => 'contact.lede',
			'rules-for-success'     => 'episodes.lede',
		)
	);
}

/**
 * The description for the current view.
 *
 * Most of this theme's pages carry no post content — their copy lives in
 * inc/content.php — so `get_the_excerpt()` comes back empty and they had no
 * description at all. The map below is the fallback for those.
 *
 * @return string Plain text, entities intact, not yet trimmed to length.
 */
function successcircles_seo_description() {
	$paths       = successcircles_seo_description_paths();
	$description = '';

	if ( is_front_page() ) {
		$description = get_bloginfo( 'description', 'display' );

		if ( '' === $description ) {
			$description = successcircles_content( 'hero.lede' );
		}
	} elseif ( is_search() ) {
		/* translators: %s: search query. */
		$description = sprintf( __( 'Search results for &ldquo;%s&rdquo; on SuccessCircles.', 'successcircles' ), get_search_query() );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$description = term_description();
	} else {
		if ( is_singular() ) {
			$description = get_the_excerpt();
		}

		$slug = successcircles_seo_slug();

		if ( '' === trim( (string) $description ) && isset( $paths[ $slug ] ) ) {
			$description = successcircles_content( $paths[ $slug ] );
		}
	}

	return trim( wp_strip_all_tags( (string) $description, true ) );
}

/**
 * Output a fallback meta description when no SEO plugin is handling it.
 *
 * @return void
 */
function successcircles_meta_description() {
	if ( successcircles_seo_plugin_active() ) {
		return;
	}

	$description = successcircles_seo_description();

	if ( '' === $description ) {
		return;
	}

	printf(
		'<meta name="description" content="%s">' . "\n",
		esc_attr( wp_html_excerpt( $description, 160, '…' ) )
	);
}
add_action( 'wp_head', 'successcircles_meta_description', 1 );

/**
 * The canonical URL for the current view.
 *
 * Core's rel_canonical() only fires on singular views, which left the Posts
 * page and the archives without one. This covers every view, and keeps the
 * `wins` pagination arg while dropping tracking and form-status args.
 *
 * @return string
 */
function successcircles_canonical_url() {
	if ( is_front_page() ) {
		$url = home_url( '/' );
	} elseif ( is_singular() ) {
		$url = (string) get_permalink();
	} elseif ( is_home() ) {
		$url = (string) get_permalink( (int) get_option( 'page_for_posts' ) );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$url = (string) get_term_link( get_queried_object() );
	} elseif ( is_search() ) {
		$url = add_query_arg( 's', get_search_query(), home_url( '/' ) );
	} elseif ( is_post_type_archive() ) {
		$url = (string) get_post_type_archive_link( (string) get_query_var( 'post_type' ) );
	} else {
		return '';
	}

	if ( is_wp_error( $url ) || '' === $url ) {
		return '';
	}

	// Momentum Buzz paginates on ?wins=N, so that arg is part of the identity
	// of the page — see page-weekly-wins.php. Nothing else is.
	$wins = isset( $_GET['wins'] ) ? absint( wp_unslash( $_GET['wins'] ) ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( $wins > 1 ) {
		$url = add_query_arg( 'wins', $wins, $url );
	}

	$paged = (int) get_query_var( 'paged' );

	if ( $paged > 1 && ! is_singular() ) {
		$url = trailingslashit( $url ) . 'page/' . $paged . '/';
	}

	return $url;
}

/**
 * Emit the canonical link, replacing core's singular-only version.
 *
 * @return void
 */
function successcircles_canonical() {
	if ( successcircles_seo_plugin_active() ) {
		return;
	}

	$url = successcircles_canonical_url();

	if ( '' === $url ) {
		return;
	}

	printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $url ) );
}
add_action( 'wp_head', 'successcircles_canonical', 1 );

/**
 * Take canonical duty off core once ours is in place.
 *
 * @return void
 */
function successcircles_replace_core_canonical() {
	if ( ! successcircles_seo_plugin_active() ) {
		remove_action( 'wp_head', 'rel_canonical' );
	}
}
add_action( 'wp', 'successcircles_replace_core_canonical' );

/**
 * Robots directives.
 *
 * Keeps thin and duplicate views out of the index, and lets search engines and
 * AI summarisers quote as much of a page as they like — the whole point of the
 * llms.txt work is to be quotable.
 *
 * @param array<string, bool|int|string> $robots Robots directives.
 * @return array<string, bool|int|string>
 */
function successcircles_robots( $robots ) {
	if ( successcircles_seo_plugin_active() ) {
		return $robots;
	}

	$wins      = isset( $_GET['wins'] ) ? absint( wp_unslash( $_GET['wins'] ) ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$is_status = isset( $_GET['sc-contact'] ) || isset( $_GET['sc-token'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	// Search results, form-status round trips and Buzz pages 2+ are all either
	// thin or a re-cut of content that is indexed elsewhere.
	if ( is_search() || is_404() || $is_status || $wins > 1 ) {
		$robots['noindex'] = true;
		$robots['follow']  = true;

		unset( $robots['index'], $robots['nofollow'] );

		return $robots;
	}

	// Strings, not integers: core's wp_robots() only renders "key:value" for
	// string values and prints a bare "max-snippet" for anything else.
	$robots['max-snippet']       = '-1';
	$robots['max-image-preview'] = 'large';
	$robots['max-video-preview'] = '-1';

	return $robots;
}
add_filter( 'wp_robots', 'successcircles_robots' );

/**
 * Open Graph and Twitter card tags so shared links render correctly.
 *
 * @return void
 */
function successcircles_open_graph() {
	if ( successcircles_seo_plugin_active() ) {
		return;
	}

	$is_post      = is_singular() && ! is_front_page();
	$title        = is_front_page() ? get_bloginfo( 'name', 'display' ) : wp_get_document_title();
	$description  = successcircles_seo_description();
	$url          = successcircles_canonical_url();
	$has_thumb    = is_singular() && has_post_thumbnail();
	$image        = $has_thumb ? get_the_post_thumbnail_url( null, 'full' ) : SUCCESSCIRCLES_URI . '/assets/img/hero-huddle.jpg';
	$image_alt    = $has_thumb ? (string) get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) : successcircles_content( 'hero.image_alt' );
	$dimensions   = $has_thumb ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ) : array( '', 1267, 713 );

	printf( '<meta property="og:type" content="%s">' . "\n", $is_post ? 'article' : 'website' );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name', 'display' ) ) );
	printf( '<meta property="og:locale" content="%s">' . "\n", esc_attr( str_replace( '-', '_', get_bloginfo( 'language' ) ) ) );
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );

	if ( '' !== $description ) {
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( wp_html_excerpt( $description, 200, '…' ) ) );
	}

	if ( '' !== $url ) {
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
	}

	printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );

	if ( ! empty( $dimensions[1] ) && ! empty( $dimensions[2] ) ) {
		printf( '<meta property="og:image:width" content="%d">' . "\n", (int) $dimensions[1] );
		printf( '<meta property="og:image:height" content="%d">' . "\n", (int) $dimensions[2] );
	}

	if ( '' !== (string) $image_alt ) {
		printf( '<meta property="og:image:alt" content="%s">' . "\n", esc_attr( $image_alt ) );
	}

	if ( $is_post && is_singular( 'post' ) ) {
		printf( '<meta property="article:published_time" content="%s">' . "\n", esc_attr( (string) get_the_date( DATE_W3C ) ) );
		printf( '<meta property="article:modified_time" content="%s">' . "\n", esc_attr( (string) get_the_modified_date( DATE_W3C ) ) );
		printf( '<meta property="article:author" content="%s">' . "\n", esc_attr( (string) get_the_author() ) );
	}

	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );

	if ( '' !== $description ) {
		printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( wp_html_excerpt( $description, 200, '…' ) ) );
	}

	printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $image ) );
}
add_action( 'wp_head', 'successcircles_open_graph', 2 );

/**
 * Add a body class identifying the homepage layout.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function successcircles_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'sc-home';
	}

	if ( is_page() && 'page-about.php' === basename( (string) get_page_template() ) ) {
		$classes[] = 'sc-page-about';
	}

	if ( is_page() && 'page-faq.php' === basename( (string) get_page_template() ) ) {
		$classes[] = 'sc-page-faq';
	}

	return $classes;
}
add_filter( 'body_class', 'successcircles_body_classes' );
