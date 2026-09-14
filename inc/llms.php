<?php
/**
 * llms.txt, llms-full.txt and robots.txt.
 *
 * /llms.txt is an index of the site written for language models: what this
 * business is, the programs and their prices, every page worth reading and
 * every published episode, as Markdown links with one line of context each.
 * /llms-full.txt contains curated public copy and up to 50 recent articles.
 * The linked HTML pages remain the authoritative, complete sources.
 *
 * Both are generated from inc/content.php and the published posts, so a new
 * episode appears in them the moment it is published — there is no file to
 * remember to update.
 *
 * Routing matches the request path rather than registering a rewrite rule: the
 * theme's only flush_rewrite_rules() runs on after_switch_theme
 * (inc/post-types.php), so a rewrite added here would silently 404 on an
 * already-active theme until someone re-saved the permalink settings. Matching
 * the path needs no flush and no activation step.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

/**
 * Plain text from a content-tree string.
 *
 * @param string $text Raw content-tree string.
 * @return string
 */
function successcircles_llms_text( $text ) {
	return successcircles_schema_text( $text );
}

/** Public pages only: publication does not remove password protection. */
function successcircles_llms_public_page( $slug ) {
	$page = get_page_by_path( $slug );
	return $page instanceof WP_Post && 'publish' === $page->post_status && '' === $page->post_password;
}

/**
 * The pages worth pointing a model at, in reading order.
 *
 * Reuses the description map that drives the meta descriptions, so a page's
 * one-line summary is the same in both places.
 *
 * @return array<int, array{title: string, url: string, description: string}>
 */
function successcircles_llms_pages() {
	$order = array(
		'momentum-buddy'        => __( 'Momentum Braintrust Buddy (program)', 'successcircles' ),
		'momentum-labs'         => __( 'Momentum Labs (program)', 'successcircles' ),
		'momentum-team'         => __( 'Momentum Team 90-day AI accelerator (program)', 'successcircles' ),
		'momentum-os'           => __( 'Momentum OS: the six-step weekly execution system', 'successcircles' ),
		'about'                 => __( 'About Success Circles', 'successcircles' ),
		'about-joseph-varghese' => __( 'Joseph Varghese, founder', 'successcircles' ),
		'testimonials'          => __( 'Testimonials', 'successcircles' ),
		'weekly-wins'           => __( 'Momentum Buzz (member wins)', 'successcircles' ),
		'faq'                   => __( 'Frequently asked questions', 'successcircles' ),
		'contact-us'            => __( 'Contact', 'successcircles' ),
	);

	$pages = array();

	foreach ( $order as $slug => $title ) {
		$page = get_page_by_path( $slug );

		if ( ! successcircles_llms_public_page( $slug ) ) {
			continue;
		}

		$pages[] = array(
			'title'       => $title,
			'url'         => (string) get_permalink( $page ),
			'description' => successcircles_llms_text( successcircles_seo_page_value( $slug, 'description' ) ),
		);
	}

	return $pages;
}

/**
 * One Markdown list entry.
 *
 * @param string $title       Link text.
 * @param string $url         Link target.
 * @param string $description Trailing context, optional.
 * @return string
 */
function successcircles_llms_line( $title, $url, $description = '' ) {
	$line = sprintf( '- [%s](%s)', $title, $url );

	return '' !== $description ? $line . ': ' . $description : $line;
}

/**
 * The shared header both files open with.
 *
 * @return array<int, string>
 */
function successcircles_llms_header() {
	return array(
		'# ' . successcircles_llms_text( successcircles_content( 'org.name', get_bloginfo( 'name' ) ) ),
		'',
		'> ' . successcircles_llms_text( successcircles_content( 'footer.blurb' ) ),
		'',
	);
}

/**
 * The programs, with their prices.
 *
 * @return array<int, string>
 */
function successcircles_llms_programs() {
	$lines = array( '## ' . __( 'Programs', 'successcircles' ), '' );

	foreach ( (array) successcircles_content( 'programs.cards', array() ) as $index => $card ) {
		$price = successcircles_program_price( $index, (string) ( $card['price'] ?? '' ) );

		$lines[] = successcircles_llms_line(
			successcircles_llms_text( $card['title'] ?? '' ),
			successcircles_link_url( (string) ( $card['cta_url'] ?? '' ) ),
			sprintf(
				/* translators: 1: program kind, 2: monthly price, 3: description. */
				__( '%1$s, %2$s/mo. %3$s', 'successcircles' ),
				successcircles_llms_text( $card['kind'] ?? '' ),
				$price,
				successcircles_llms_text( $card['text'] ?? '' )
			)
		);
	}

	return array_merge( $lines, array( '' ) );
}

/**
 * Published episodes, newest first.
 *
 * @param int $limit Maximum episodes.
 * @return array<int, string>
 */
function successcircles_llms_episodes( $limit = 50 ) {
	$posts = successcircles_episodes( $limit );

	if ( ! $posts ) {
		return array();
	}

	$blog  = (int) get_option( 'page_for_posts' );
	$title = $blog ? get_the_title( $blog ) : __( 'Rules for Success', 'successcircles' );
	$lines = array( '## ' . successcircles_llms_text( $title ), '' );

	if ( $blog ) {
		$lines[] = successcircles_llms_line(
			__( 'All episodes', 'successcircles' ),
			(string) get_permalink( $blog ),
			successcircles_llms_text( successcircles_content( 'episodes.lede' ) )
		);
	}

	// successcircles_episodes() hands back the card field arrays, not WP_Post.
	foreach ( $posts as $episode ) {
		$role    = successcircles_llms_text( $episode['role'] );
		$excerpt = successcircles_llms_text( $episode['excerpt'] );

		$lines[] = successcircles_llms_line(
			successcircles_llms_text( $episode['title'] ),
			(string) $episode['url'],
			trim( ( '' !== $role ? $role . '. ' : '' ) . $excerpt )
		);
	}

	return array_merge( $lines, array( '' ) );
}

/**
 * The llms.txt index.
 *
 * @return string
 */
function successcircles_llms_index() {
	$lines = successcircles_llms_header();

	$lines[] = successcircles_llms_text( successcircles_content( 'hero.lede' ) );
	$lines[] = '';

	$lines = array_merge( $lines, successcircles_llms_programs() );

	$lines[] = '## ' . __( 'Pages', 'successcircles' );
	$lines[] = '';
	$lines[] = successcircles_llms_line( __( 'Home', 'successcircles' ), home_url( '/' ), successcircles_llms_text( successcircles_content( 'hero.lede' ) ) );

	foreach ( successcircles_llms_pages() as $page ) {
		$lines[] = successcircles_llms_line( $page['title'], $page['url'], $page['description'] );
	}

	$lines[] = '';
	$lines   = array_merge( $lines, successcircles_llms_episodes() );

	$faq = successcircles_llms_public_page( 'faq' ) ? successcircles_faq_page_items() : array();

	if ( $faq ) {
		$lines[] = '## ' . __( 'Frequently asked questions', 'successcircles' );
		$lines[] = '';

		foreach ( $faq as $item ) {
			$answer = successcircles_schema_answer_text( $item['answer'] ?? '' );
			$answer = trim( (string) strtok( $answer, "\n" ) );

			$lines[] = sprintf( '- **%s** %s', successcircles_llms_text( $item['question'] ?? '' ), $answer );
		}

		$lines[] = '';
	}

	$lines[] = '## ' . __( 'Contact', 'successcircles' );
	$lines[] = '';

	foreach ( (array) successcircles_content( 'contact.channels', array() ) as $channel ) {
		$value  = successcircles_llms_text( $channel['value'] ?? '' );
		$detail = successcircles_llms_text( $channel['detail'] ?? '' );

		$lines[] = sprintf(
			'- %s: %s',
			successcircles_llms_text( $channel['label'] ?? '' ),
			trim( $value . ( '' !== $detail ? ', ' . $detail : '' ) )
		);
	}

	$lines[] = '';
	$lines[] = '## ' . __( 'Optional', 'successcircles' );
	$lines[] = '';
	$lines[] = successcircles_llms_line( __( 'Full site text', 'successcircles' ), home_url( '/llms-full.txt' ), __( 'curated site copy, program summaries, FAQs, and up to 50 recent published articles', 'successcircles' ) );
	$sitemap = function_exists( 'get_sitemap_url' ) ? get_sitemap_url( 'index' ) : home_url( '/wp-sitemap.xml' );
	if ( $sitemap ) {
		$lines[] = successcircles_llms_line( __( 'Sitemap', 'successcircles' ), $sitemap, __( 'machine-readable index of public URLs', 'successcircles' ) );
	}

	return implode( "\n", $lines ) . "\n";
}

/**
 * A titled block of paragraphs.
 *
 * @param string                $heading Section heading.
 * @param array<int, string>    $body    Paragraphs.
 * @return array<int, string>
 */
function successcircles_llms_block( $heading, $body ) {
	$lines = array();

	if ( '' !== $heading ) {
		$lines[] = '### ' . successcircles_llms_text( $heading );
		$lines[] = '';
	}

	foreach ( (array) $body as $paragraph ) {
		$text = successcircles_llms_text( $paragraph );

		if ( '' !== $text ) {
			$lines[] = $text;
			$lines[] = '';
		}
	}

	return $lines;
}

/**
 * The llms-full.txt body — the site's prose, in reading order.
 *
 * @return string
 */
function successcircles_llms_full() {
	$lines = successcircles_llms_header();

	$lines[] = 'Source: ' . home_url( '/' );
	$lines[] = '';
	$lines = array_merge( $lines, successcircles_llms_block( 'What is a huddle?', array( successcircles_content( 'huddle.lede' ) ) ) );
	foreach ( (array) successcircles_content( 'huddle.items', array() ) as $step ) {
		$lines = array_merge( $lines, successcircles_llms_block( $step['title'], array( $step['text'] ) ) );
	}
	$lines[] = '## Page summaries and sources';
	$lines[] = '';
	foreach ( successcircles_llms_pages() as $page ) {
		$lines[] = successcircles_llms_line( $page['title'], $page['url'], $page['description'] );
	}
	$lines[] = '';
	if ( successcircles_llms_public_page( 'momentum-os' ) ) {
		$lines = array_merge( $lines, successcircles_llms_block( 'Momentum OS', array( successcircles_content( 'system.lede' ) ) ) );
		$lines[] = 'Source: ' . home_url( '/momentum-os/' );
		$lines[] = '';
		foreach ( (array) successcircles_content( 'system.steps', array() ) as $step ) {
			$lines = array_merge( $lines, successcircles_llms_block( $step['title'], array( $step['text'] ) ) );
		}
	}

	$about = (array) successcircles_content( 'about', array() );

	if ( successcircles_llms_public_page( 'about' ) ) {
		$lines[] = '## ' . __( 'About', 'successcircles' );
		$lines[] = '';
		$lines   = array_merge( $lines, successcircles_llms_block( '', array( $about['lede'] ?? '' ) ) );
		$lines   = array_merge( $lines, successcircles_llms_block( __( 'Mission', 'successcircles' ), array( $about['mission']['lede'] ?? '', $about['mission']['body'] ?? '' ) ) );
		$lines   = array_merge( $lines, successcircles_llms_block( __( 'Vision', 'successcircles' ), (array) ( $about['vision']['body'] ?? array() ) ) );

		$values = (array) ( $about['values']['items'] ?? array() );

		if ( $values ) {
			$lines[] = '### ' . __( 'Core values', 'successcircles' );
			$lines[] = '';

			foreach ( $values as $value ) {
				$lines[] = sprintf( '- **%s** %s', successcircles_llms_text( $value['title'] ?? '' ), successcircles_llms_text( $value['text'] ?? '' ) );
			}

			$lines[] = '';
		}

	}
	$lines[] = '## ' . __( 'Programs', 'successcircles' );
	$lines[] = '';

	foreach ( (array) successcircles_content( 'programs.cards', array() ) as $index => $card ) {
		$lines[] = '### ' . successcircles_llms_text( $card['title'] ?? '' );
		$lines[] = '';
		$lines[] = sprintf(
			/* translators: 1: program kind, 2: monthly price. */
			__( '%1$s. %2$s per month.', 'successcircles' ),
			successcircles_llms_text( $card['kind'] ?? '' ),
			successcircles_program_price( $index, (string) ( $card['price'] ?? '' ) )
		);
		$lines[] = '';
		$lines[] = successcircles_llms_text( $card['text'] ?? '' );
		$lines[] = '';

		foreach ( (array) ( $card['features'] ?? array() ) as $feature ) {
			$lines[] = '- ' . successcircles_llms_text( $feature );
		}

		$lines[] = '';
		$lines[] = sprintf( __( 'Program details: %s', 'successcircles' ), successcircles_link_url( (string) ( $card['cta_url'] ?? '' ) ) );
		$lines[] = '';
	}

	$founder = (array) successcircles_content( 'founder_page', array() );

	if ( successcircles_llms_public_page( 'about-joseph-varghese' ) ) {
		$lines[] = '## ' . __( 'Joseph Varghese, founder', 'successcircles' );
		$lines[] = '';
		$lines   = array_merge( $lines, successcircles_llms_block( '', array_merge( array( $founder['lede'] ?? '' ), (array) ( $founder['intro'] ?? array() ) ) ) );

		foreach ( (array) ( $founder['sections'] ?? array() ) as $section ) {
			$lines = array_merge( $lines, successcircles_llms_block( $section['title'] ?? '', (array) ( $section['body'] ?? array() ) ) );
		}

	}

	$faq = successcircles_llms_public_page( 'faq' ) ? successcircles_faq_page_items() : array();

	if ( $faq ) {
		$lines[] = '## ' . __( 'Frequently asked questions', 'successcircles' );
		$lines[] = '';

		foreach ( $faq as $item ) {
			$lines[] = '### ' . successcircles_llms_text( $item['question'] ?? '' );
			$lines[] = '';
			$lines[] = successcircles_schema_answer_text( $item['answer'] ?? '' );
			$lines[] = '';
		}
	}

	$quotes = (array) successcircles_content( 'testimonials.quotes', array() );

	if ( $quotes && successcircles_llms_public_page( 'testimonials' ) ) {
		$lines[] = '## ' . __( 'What members say', 'successcircles' );
		$lines[] = '';

		foreach ( $quotes as $quote ) {
			$lines[] = sprintf(
				'- "%s" — %s, %s',
				successcircles_llms_text( $quote['text'] ?? '' ),
				successcircles_llms_text( $quote['name'] ?? '' ),
				successcircles_llms_text( $quote['role'] ?? '' )
			);
		}

		$lines[] = '';
	}

	// The card-field arrays carry no body text, so the transcripts are queried
	// straight from the posts.
	$posts = get_posts(
		array(
			'post_type'              => 'post',
			'post_status'            => 'publish',
			'has_password'           => false,
			'posts_per_page'         => 50,
			'no_found_rows'          => true,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => true,
		)
	);

	if ( $posts ) {
		$lines[] = '## ' . __( 'Rules for Success — published article text', 'successcircles' );
		$lines[] = '';

		foreach ( $posts as $post ) {
			$role = (string) get_post_meta( $post->ID, '_sc_role', true );

			$lines[] = '### ' . successcircles_llms_text( get_the_title( $post ) );
			$lines[] = '';
			$lines[] = sprintf(
				'%s | %s',
				'' !== $role ? successcircles_llms_text( $role ) : __( 'Episode', 'successcircles' ),
				(string) get_permalink( $post )
			);
			$lines[] = '';
			$lines[] = successcircles_llms_text( wpautop( strip_shortcodes( (string) $post->post_content ) ) );
			$lines[] = '';
		}
	}

	return implode( "\n", $lines ) . "\n";
}

/**
 * Serve /llms.txt and /llms-full.txt.
 *
 * ponytail: generated per request — two queries against a handful of posts.
 * If the episode archive ever grows past a few hundred, cache the string in a
 * transient busted on save_post.
 *
 * @return void
 */
function successcircles_llms_route() {
	$path = (string) wp_parse_url( (string) wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ), PHP_URL_PATH );
	$base = (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH );

	if ( '' !== $base && '/' !== $base && 0 === strpos( $path, $base ) ) {
		$path = substr( $path, strlen( $base ) - 1 );
	}

	$path = trim( $path, '/' );

	if ( 'llms.txt' === $path ) {
		$body = successcircles_llms_index();
	} elseif ( 'llms-full.txt' === $path ) {
		$body = successcircles_llms_full();
	} else {
		return;
	}

	status_header( 200 );
	header( 'Content-Type: text/plain; charset=utf-8' );
	// These are discovery aids; index the original HTML pages instead.
	header( 'X-Robots-Tag: noindex, follow' );

	echo $body; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	exit;
}
add_action( 'template_redirect', 'successcircles_llms_route', 0 );

/**
 * Advertise llms.txt in the document head.
 *
 * @return void
 */
function successcircles_llms_link() {
	printf( '<link rel="alternate" type="text/plain" href="%s" title="llms.txt">' . "\n", esc_url( home_url( '/llms.txt' ) ) );
}
add_action( 'wp_head', 'successcircles_llms_link', 3 );

/**
 * Extend robots.txt.
 *
 * Discovery pointers only. AI crawlers inherit the site's existing policy.
 * No special Allow group should bypass WordPress or a plugin's restrictions.
 *
 * @param string $output Robots.txt body.
 * @param string $public Whether the site is set to be indexed.
 * @return string
 */
function successcircles_robots_txt( $output, $public ) {
	// A site set to discourage search engines stays discouraged.
	if ( '1' !== (string) $public ) {
		return $output;
	}

	// Keep existing wildcard and bot-specific policy intact. Named Allow: /
	// groups would override the wildcard's admin and other restrictions.
	// Status-query pages remain crawlable so their noindex can be read.
	$lines = array( '' );
	$lines[] = '# Site summary written for language models:';
	$lines[] = '# ' . home_url( '/llms.txt' );
	$lines[] = '# ' . home_url( '/llms-full.txt' );

	return $output . implode( "\n", $lines ) . "\n";
}
add_filter( 'robots_txt', 'successcircles_robots_txt', 10, 2 );
