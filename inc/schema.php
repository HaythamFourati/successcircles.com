<?php
/**
 * Structured data — one connected schema.org @graph per page.
 *
 * Every page emits a single JSON-LD block in the head. Nodes carry stable
 * `@id`s and reference each other, so the Organization is described once and
 * pointed at from everywhere else rather than repeated — which is what both
 * Google and LLM crawlers read best, and what keeps a hand-typed address from
 * drifting out of sync with the rest of the site.
 *
 * Everything is read through the existing helpers (successcircles_content(),
 * successcircles_option(), successcircles_program_price(),
 * successcircles_social_url()) so a Customizer override is reflected in the
 * markup as well as on screen.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

/**
 * A stable node id.
 *
 * @param string $fragment Fragment, without the hash.
 * @param string $url      Base URL. Defaults to the site root.
 * @return string
 */
function successcircles_schema_id( $fragment, $url = '' ) {
	return ( '' !== $url ? $url : home_url( '/' ) ) . '#' . $fragment;
}

/**
 * Plain text from a content-tree string.
 *
 * The tree stores display copy — inline markup and HTML entities. Schema wants
 * neither.
 *
 * @param string $text Raw content-tree string.
 * @return string
 */
function successcircles_schema_text( $text ) {
	// html_entity_decode, not wp_specialchars_decode: the content tree is full
	// of &mdash; and &rsquo;, which the latter leaves untouched.
	$text = preg_replace( '/<(?:br\s*\/?|\/(?:p|div|li|h[1-6]))>/i', ' ', (string) $text );
	return trim( wp_strip_all_tags( html_entity_decode( $text, ENT_QUOTES, 'UTF-8' ) ) );
}

/**
 * The Organization node.
 *
 * @return array<string, mixed>
 */
function successcircles_schema_organization() {
	$org     = (array) successcircles_content( 'org', array() );
	$address = (array) ( $org['address'] ?? array() );
	$socials = (array) successcircles_content( 'footer.social', array() );

	$same_as = array();

	foreach ( $socials as $social ) {
		$url = successcircles_social_url( $social );

		if ( '' !== $url ) {
			$same_as[] = $url;
		}
	}

	$node = array(
		'@type'       => 'Organization',
		'@id'         => successcircles_schema_id( 'organization' ),
		'name'        => successcircles_schema_text( $org['name'] ?? get_bloginfo( 'name' ) ),
		'url'         => home_url( '/' ),
		'description' => successcircles_schema_text( successcircles_content( 'about.lede' ) ),
		'slogan'      => successcircles_schema_text( successcircles_content( 'footer.blurb' ) ),
		'logo'        => array(
			'@type'  => 'ImageObject',
			'@id'    => successcircles_schema_id( 'logo' ),
			'url'    => SUCCESSCIRCLES_URI . '/assets/img/successcircles-logo.png',
			'width'  => 195,
			'height' => 78,
		),
		'image'       => array( '@id' => successcircles_schema_id( 'logo' ) ),
		'founder'     => array( '@id' => successcircles_schema_person_id() ),
	);

	$logo = wp_get_attachment_image_src( (int) get_theme_mod( 'custom_logo' ), 'full' );
	if ( $logo ) {
		$node['logo']['url'] = $logo[0];
		$node['logo']['width'] = (int) $logo[1];
		$node['logo']['height'] = (int) $logo[2];
	}

	if ( ! empty( $org['founding_date'] ) ) {
		$node['foundingDate'] = (string) $org['founding_date'];
	}

	$phone = successcircles_option( 'sc_phone', '', (string) ( $org['phone'] ?? '' ) );
	// A display line may include a vanity number and a second numeric number.
	// Select one complete number instead of concatenating unrelated digits.
	preg_match_all( '/\+?[0-9][0-9() .-]{8,}[0-9]/', wp_strip_all_tags( $phone ), $numbers );
	$phone = '';
	foreach ( $numbers[0] as $number ) {
		$digits = preg_replace( '/[^0-9]/', '', $number );
		if ( strlen( $digits ) >= 10 && strlen( $digits ) <= 15 ) {
			$phone = ( str_starts_with( trim( $number ), '+' ) ? '+' : '' ) . $digits;
		}
	}

	if ( $phone ) {
		$node['telephone'] = $phone;
	}

	if ( $address ) {
		$node['address'] = array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => successcircles_schema_text( $address['street'] ?? '' ),
			'addressLocality' => successcircles_schema_text( $address['locality'] ?? '' ),
			'addressRegion'   => (string) ( $address['region'] ?? '' ),
			'postalCode'      => (string) ( $address['postal'] ?? '' ),
			'addressCountry'  => (string) ( $address['country'] ?? '' ),
		);
	}

	if ( ! empty( $org['map'] ) ) {
		$same_as[] = (string) $org['map'];
	}

	if ( $same_as ) {
		$node['sameAs'] = array_values( array_unique( $same_as ) );
	}

	return $node;
}

/**
 * The founder's node id — referenced from the Organization on every page.
 *
 * @return string
 */
function successcircles_schema_person_id() {
	return successcircles_schema_id( 'person', home_url( '/about-joseph-varghese/' ) );
}

/**
 * The Person node for the founder.
 *
 * @return array<string, mixed>
 */
function successcircles_schema_person() {
	$page  = (array) successcircles_content( 'founder_page', array() );
	$roles = array_map( 'successcircles_schema_text', (array) ( $page['roles'] ?? array() ) );

	$node = array(
		'@type'       => 'Person',
		'@id'         => successcircles_schema_person_id(),
		'name'        => 'Joseph Varghese',
		'givenName'   => 'Joseph',
		'familyName'  => 'Varghese',
		'alternateName' => 'Joseph JV Varghese',
		'url'         => home_url( '/about-joseph-varghese/' ),
		'description' => successcircles_schema_text( $page['lede'] ?? '' ),
		'worksFor'    => array( '@id' => successcircles_schema_id( 'organization' ) ),
	);

	if ( $roles ) {
		$node['jobTitle'] = $roles;
	}

	if ( ! empty( $page['portrait']['file'] ) ) {
		$node['image'] = array(
			'@type'  => 'ImageObject',
			'url'    => SUCCESSCIRCLES_URI . '/assets/img/about/' . $page['portrait']['file'],
			'width'  => (int) ( $page['portrait']['width'] ?? 0 ),
			'height' => (int) ( $page['portrait']['height'] ?? 0 ),
		);
	}

	return $node;
}

/**
 * The WebSite node, with the site search action.
 *
 * @return array<string, mixed>
 */
function successcircles_schema_website() {
	return array(
		'@type'           => 'WebSite',
		'@id'             => successcircles_schema_id( 'website' ),
		'url'             => home_url( '/' ),
		'name'            => successcircles_schema_text( get_bloginfo( 'name' ) ),
		'description'     => successcircles_schema_text( successcircles_content( 'footer.blurb' ) ),
		'publisher'       => array( '@id' => successcircles_schema_id( 'organization' ) ),
		'inLanguage'      => get_bloginfo( 'language' ),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => array(
				'@type'       => 'EntryPoint',
				'urlTemplate' => home_url( '/?s={search_term_string}' ),
			),
			'query-input' => 'required name=search_term_string',
		),
	);
}

/**
 * The breadcrumb trail for the current view.
 *
 * Schema only — the design has no visible breadcrumb.
 *
 * @return array<string, mixed>|null
 */
function successcircles_schema_breadcrumb() {
	if ( is_front_page() ) {
		return null;
	}

	$crumbs = array( array( 'Home', home_url( '/' ) ) );

	if ( is_singular( 'post' ) ) {
		$blog = (int) get_option( 'page_for_posts' );

		if ( $blog ) {
			$crumbs[] = array( get_the_title( $blog ), get_permalink( $blog ) );
		}

		$crumbs[] = array( get_the_title(), get_permalink() );
	} elseif ( is_singular() || is_home() ) {
		$queried = get_queried_object();

		if ( $queried instanceof WP_Post ) {
			foreach ( array_reverse( (array) get_post_ancestors( $queried ) ) as $ancestor ) {
				$crumbs[] = array( get_the_title( $ancestor ), get_permalink( $ancestor ) );
			}

			$crumbs[] = array( get_the_title( $queried ), get_permalink( $queried ) );
		}
	} elseif ( is_search() ) {
		/* translators: %s: search query. */
		$crumbs[] = array( sprintf( __( 'Search: %s', 'successcircles' ), get_search_query() ), successcircles_canonical_url() );
	} elseif ( is_archive() ) {
		$crumbs[] = array( wp_strip_all_tags( get_the_archive_title() ), successcircles_canonical_url() );
	} else {
		return null;
	}

	$items = array();

	foreach ( $crumbs as $position => $crumb ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $position + 1,
			'name'     => successcircles_schema_text( $crumb[0] ),
			'item'     => (string) $crumb[1],
		);
	}

	return array(
		'@type'           => 'BreadcrumbList',
		'@id'             => successcircles_schema_id( 'breadcrumb', successcircles_canonical_url() ),
		'itemListElement' => $items,
	);
}

/** Only unambiguous USD amounts are eligible for numeric offer markup. */
function successcircles_schema_price( $text ) {
	$text = trim( successcircles_schema_text( $text ) );
	if ( ! preg_match( '/^\$?((?:[0-9]{1,3}(?:,[0-9]{3})+|[0-9]+)(?:\.[0-9]{1,2})?)$/', $text, $match ) ) {
		return '';
	}
	return str_replace( ',', '', $match[1] );
}

/** The service's permanent identity is independent of editable CTA destinations. */
function successcircles_schema_service_slugs() {
	return array( 'momentum-labs', 'momentum-buddy', 'momentum-team' );
}

/**
 * The programs as Service nodes with Offers.
 *
 * @return array<int, array<string, mixed>>
 */
function successcircles_schema_services() {
	$programs = (array) successcircles_content( 'programs.cards', array() );
	$nodes    = array();

	foreach ( $programs as $index => $card ) {
		$title = successcircles_schema_text( $card['title'] ?? '' );

		if ( '' === $title ) {
			continue;
		}

		$slugs = successcircles_schema_service_slugs();
		$slug = $slugs[ $index ] ?? '';
		if ( ! $slug || ( ! is_front_page() && successcircles_seo_slug() !== $slug ) ) { continue; }
		$id = successcircles_schema_id( 'service', home_url( '/' . $slug . '/' ) );
		$price = successcircles_program_price( $index, (string) ( $card['price'] ?? '' ) );
		$price = successcircles_schema_price( $price );

		$node = array(
			'@type'       => 'Service',
			'@id'         => $id,
			'name'        => $title,
			'url'         => home_url( '/' . $slug . '/' ),
			'serviceType' => successcircles_schema_text( $card['kind'] ?? '' ),
			'description' => successcircles_schema_text( $card['text'] ?? '' ),
			'provider'    => array( '@id' => successcircles_schema_id( 'organization' ) ),
			'areaServed'  => 'Worldwide',
			'audience'    => array(
				'@type'        => 'Audience',
				'audienceType' => __( 'Established entrepreneurs and business owners', 'successcircles' ),
			),
		);

		if ( is_front_page() && '' !== $price ) {
			$node['offers'] = array(
				'@type'         => 'Offer',
				'price'         => $price,
				'priceCurrency' => 'USD',
				'url'           => successcircles_link_url( (string) ( $card['cta_url'] ?? '' ) ),
				'priceSpecification' => array(
					'@type'         => 'UnitPriceSpecification',
					'price'         => $price,
					'priceCurrency' => 'USD',
					'unitCode'      => 'MON',
					'billingDuration' => 1,
				),
			);
		}

		// Detail-page offers use the exact plan totals visible on that page.
		if ( ! is_front_page() ) {
			$plans = array();
			if ( 'momentum-labs' === $slug ) {
				$plans[] = array( 'name' => 'Monthly membership', 'price' => successcircles_program_price( 0, successcircles_content( 'labs_page.price' ) ), 'text' => successcircles_content( 'labs_page.price_note' ) );
			} else {
				$plans = (array) successcircles_content( ( 'momentum-buddy' === $slug ? 'buddy_page' : 'team_page' ) . '.pricing.plans', array() );
			}
			foreach ( $plans as $plan ) {
				$amount = successcircles_schema_price( $plan['price'] ?? '' );
				if ( '' === $amount ) { continue; }
				$node['offers'][] = array(
					'@type' => 'Offer', 'name' => successcircles_schema_text( $plan['name'] ?? '' ),
					'price' => $amount, 'priceCurrency' => 'USD', 'url' => $node['url'],
					'description' => successcircles_schema_text( implode( '. ', array_filter( array( $plan['cycle'] ?? '', $plan['detail'] ?? '', $plan['text'] ?? '' ) ) ) ),
				);
			}
		}

		$nodes[] = $node;
	}

	return $nodes;
}

/**
 * Flatten a structured FAQ answer (paragraph / list blocks) into one string.
 *
 * Shared by the homepage FAQ section and the FAQ page, which store their
 * answers differently — a plain string and a block array respectively.
 *
 * @param string|array<int, array<string, mixed>> $answer Answer blocks or string.
 * @return string
 */
function successcircles_schema_answer_text( $answer ) {
	if ( ! is_array( $answer ) ) {
		return successcircles_schema_text( $answer );
	}

	$parts = array();

	foreach ( $answer as $block ) {
		if ( isset( $block['p'] ) ) {
			$parts[] = successcircles_schema_text( $block['p'] );
		} elseif ( isset( $block['list'] ) ) {
			foreach ( (array) $block['list'] as $item ) {
				$parts[] = '• ' . successcircles_schema_text( $item );
			}
		}
	}

	return implode( "\n", $parts );
}

/**
 * Question nodes from a list of question/answer pairs.
 *
 * @param array<int, array<string, mixed>> $items Q&A items.
 * @return array<int, array<string, mixed>>
 */
function successcircles_schema_questions( $items ) {
	$questions = array();

	foreach ( (array) $items as $item ) {
		$question = successcircles_schema_text( $item['question'] ?? '' );
		$answer   = successcircles_schema_answer_text( $item['answer'] ?? '' );

		if ( '' === $question || '' === $answer ) {
			continue;
		}

		$questions[] = array(
			'@type'          => 'Question',
			'name'           => $question,
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $answer,
			),
		);
	}

	return $questions;
}

/**
 * Every question on the FAQ page, flattened out of its groups.
 *
 * @return array<int, array<string, mixed>>
 */
function successcircles_faq_page_items() {
	$items = array();

	foreach ( (array) successcircles_content( 'faq_page.groups', array() ) as $group ) {
		foreach ( (array) ( $group['items'] ?? array() ) as $item ) {
			$items[] = $item;
		}
	}

	return $items;
}

/**
 * The BlogPosting node for a single post.
 *
 * @return array<string, mixed>
 */
function successcircles_schema_blogposting() {
	$post_id = get_the_ID();
	$url     = (string) get_permalink();

	$node = array(
		'@type'            => 'BlogPosting',
		'@id'              => successcircles_schema_id( 'article', $url ),
		'headline'         => successcircles_schema_text( get_the_title() ),
		'description'      => successcircles_seo_description(),
		'datePublished'    => (string) get_the_date( DATE_W3C ),
		'dateModified'     => (string) get_the_modified_date( DATE_W3C ),
		'url'              => $url,
		'mainEntityOfPage' => array( '@id' => successcircles_schema_id( 'webpage', $url ) ),
		'isPartOf'         => array( '@id' => successcircles_schema_id( 'website' ) ),
		'publisher'        => array( '@id' => successcircles_schema_id( 'organization' ) ),
		'author'           => array(
			'@type' => 'Person',
			'name'  => successcircles_schema_text( get_the_author_meta( 'display_name', (int) get_post_field( 'post_author', $post_id ) ) ),
			'url'   => get_author_posts_url( (int) get_post_field( 'post_author', $post_id ) ),
		),
		'inLanguage'       => get_bloginfo( 'language' ),
		'wordCount'        => str_word_count( wp_strip_all_tags( (string) get_the_content() ) ),
		'timeRequired'     => 'PT' . max( 1, (int) successcircles_read_time( get_post() ) ) . 'M',
	);

	$role = (string) get_post_meta( $post_id, '_sc_role', true );

	if ( '' !== $role ) {
		// The guest, not the writer — the interviewee is the reason to read it.
		$node['about'] = array(
			'@type'    => 'Person',
			'name'     => successcircles_schema_text( get_the_title() ),
			'jobTitle' => successcircles_schema_text( $role ),
		);
	}

	if ( has_post_thumbnail() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

		if ( $image ) {
			$node['image'] = array(
				'@type'  => 'ImageObject',
				'url'    => $image[0],
				'width'  => (int) $image[1],
				'height' => (int) $image[2],
			);
		}
	}

	return $node;
}

/**
 * The WebPage node, typed to whatever this page actually is.
 *
 * @return array<string, mixed>
 */
function successcircles_schema_webpage() {
	$url  = successcircles_canonical_url();
	$slug = successcircles_seo_slug();

	$types = array(
		'momentum-buddy'        => 'ItemPage',
		'momentum-labs'         => 'ItemPage',
		'momentum-team'         => 'ItemPage',
		'momentum-os'           => 'WebPage',
		'about'                 => 'AboutPage',
		'about-joseph-varghese' => 'AboutPage',
		'contact-us'            => 'ContactPage',
		'faq'                   => 'FAQPage',
		'testimonials'          => 'CollectionPage',
		'weekly-wins'           => 'CollectionPage',
		'rules-for-success'     => 'CollectionPage',
	);

	$type = $types[ $slug ] ?? 'WebPage';

	if ( is_search() ) {
		$type = 'SearchResultsPage';
	} elseif ( is_singular( 'post' ) ) {
		$type = 'ItemPage';
	} elseif ( is_front_page() ) {
		$type = 'WebPage';
	}

	$node = array(
		'@type'       => $type,
		'@id'         => successcircles_schema_id( 'webpage', $url ),
		'url'         => $url,
		'name'        => successcircles_schema_text( wp_get_document_title() ),
		'description' => successcircles_seo_description(),
		'isPartOf'    => array( '@id' => successcircles_schema_id( 'website' ) ),
		'about'       => array( '@id' => successcircles_schema_id( 'organization' ) ),
		'inLanguage'  => get_bloginfo( 'language' ),
	);

	// The homepage FAQ block and the FAQ page hold their Q&A in different
	// shapes; both end up as the same mainEntity here.
	if ( is_front_page() ) {
		$questions = successcircles_schema_questions( successcircles_content( 'faq.items', array() ) );
	} elseif ( 'faq' === $slug ) {
		$questions = successcircles_schema_questions( successcircles_faq_page_items() );
	} else {
		$questions = array();
	}

	if ( $questions ) {
		$node['@type']      = is_front_page() ? array( 'WebPage', 'FAQPage' ) : 'FAQPage';
		$node['mainEntity'] = $questions;
	}

	if ( 'about-joseph-varghese' === $slug ) {
		$node['mainEntity'] = array( '@id' => successcircles_schema_person_id() );
	}

	if ( in_array( $slug, successcircles_schema_service_slugs(), true ) ) {
		$node['mainEntity'] = array( '@id' => successcircles_schema_id( 'service', home_url( '/' . $slug . '/' ) ) );
	}

	if ( 'contact-us' === $slug ) {
		$node['mainEntity'] = array( '@id' => successcircles_schema_id( 'organization' ) );
	}

	if ( is_singular( 'post' ) ) {
		$node['primaryImageOfPage'] = has_post_thumbnail()
			? array( 'url' => (string) get_the_post_thumbnail_url( null, 'full' ) )
			: null;

		$node = array_filter(
			$node,
			static function ( $value ) {
				return null !== $value;
			}
		);
	}

	$breadcrumb = successcircles_schema_breadcrumb();

	if ( $breadcrumb ) {
		$node['breadcrumb'] = array( '@id' => $breadcrumb['@id'] );
	}

	return $node;
}

/**
 * Assemble the whole graph for the current view.
 *
 * @return array<int, array<string, mixed>>
 */
function successcircles_schema_graph() {
	$graph = array(
		successcircles_schema_organization(),
		successcircles_schema_website(),
		successcircles_schema_webpage(),
	);

	$breadcrumb = successcircles_schema_breadcrumb();

	if ( $breadcrumb ) {
		$graph[] = $breadcrumb;
	}

	if ( is_front_page() || in_array( successcircles_seo_slug(), successcircles_schema_service_slugs(), true ) ) {
		$graph = array_merge( $graph, successcircles_schema_services() );
	}

	// The founder is described on every page, not just his own: the
	// Organization points at him sitewide, and a reference that resolves
	// nowhere is worse than no reference.
	$graph[] = successcircles_schema_person();

	if ( is_singular( 'post' ) ) {
		$graph[] = successcircles_schema_blogposting();
	}

	if ( 'rules-for-success' === successcircles_seo_slug() ) {
		$episodes = successcircles_episodes( 12 );

		if ( $episodes ) {
			$graph[] = array(
				'@type'           => 'ItemList',
				'@id'             => successcircles_schema_id( 'episodes', successcircles_canonical_url() ),
				'name'            => successcircles_schema_text( successcircles_content( 'episodes.title' ) ),
				'itemListElement' => array_map(
					static function ( $episode, $index ) {
						return array(
							'@type'    => 'ListItem',
							'position' => $index + 1,
							'url'      => (string) $episode['url'],
							'name'     => successcircles_schema_text( $episode['title'] ),
						);
					},
					$episodes,
					array_keys( $episodes )
				),
			);
		}
	}

	/**
	 * Filter the schema graph before it is printed.
	 *
	 * @param array<int, array<string, mixed>> $graph Graph nodes.
	 */
	return (array) apply_filters( 'successcircles_schema_graph', $graph );
}

/**
 * Print the graph.
 *
 * @return void
 */
function successcircles_schema() {
	if ( successcircles_seo_plugin_active() || is_404() || '' === successcircles_canonical_url() || ( is_singular() && post_password_required() ) ) {
		return;
	}

	$graph = successcircles_schema_graph();

	if ( ! $graph ) {
		return;
	}

	printf(
		'<script type="application/ld+json">%s</script>' . "\n",
		wp_json_encode(
			array(
				'@context' => 'https://schema.org',
				'@graph'   => array_values( $graph ),
			),
			JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
		)
	);
}
add_action( 'wp_head', 'successcircles_schema', 5 );
