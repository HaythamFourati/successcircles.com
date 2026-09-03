<?php
/**
 * Post meta and first-run setup.
 *
 * There is no testimonials post type: the testimonials page runs on the live
 * site's Weekly Wins feed (see inc/wins.php), so there is nothing to curate in
 * the admin. Rules for Success episodes are ordinary WordPress posts — they are
 * the site's blog. The only thing the theme adds is the `_sc_role` meta used on
 * the cards ("Founder & CEO, Focusmate"). Keeping them as `post` means one
 * content stream, working comments/feeds/search, and no second admin menu.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the post meta the theme adds to a post.
 *
 * @return void
 */
function successcircles_register_meta() {
	$common = array(
		'type'              => 'string',
		'single'            => true,
		'show_in_rest'      => true,
		'sanitize_callback' => 'sanitize_text_field',
		'auth_callback'     => function () {
			return current_user_can( 'edit_posts' );
		},
	);

	register_post_meta(
		'post',
		'_sc_role',
		array_merge(
			$common,
			array( 'description' => __( 'Guest role shown on the post card, e.g. "Founder & CEO, Focusmate".', 'successcircles' ) )
		)
	);

}
add_action( 'init', 'successcircles_register_meta' );

/**
 * Add the meta boxes for the classic editor path.
 *
 * @return void
 */
function successcircles_add_meta_boxes() {
	add_meta_box(
		'sc_details',
		__( 'Success Circles Details', 'successcircles' ),
		'successcircles_render_meta_box',
		'post',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'successcircles_add_meta_boxes' );

/**
 * Render the details meta box.
 *
 * @param WP_Post $post Current post.
 * @return void
 */
function successcircles_render_meta_box( $post ) {
	wp_nonce_field( 'sc_details_save', 'sc_details_nonce' );

	$role = (string) get_post_meta( $post->ID, '_sc_role', true );

	printf(
		'<p><label for="sc_role"><strong>%1$s</strong></label><input type="text" id="sc_role" name="sc_role" value="%2$s" class="widefat"><span class="description">%3$s</span></p>',
		esc_html__( 'Role', 'successcircles' ),
		esc_attr( $role ),
		esc_html__( 'e.g. Founder & CEO, Focusmate', 'successcircles' )
	);
}

/**
 * Persist the meta box values.
 *
 * @param int     $post_id Post ID.
 * @param WP_Post $post    Post object.
 * @return void
 */
function successcircles_save_meta_box( $post_id, $post ) {
	if ( 'post' !== $post->post_type ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! isset( $_POST['sc_details_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['sc_details_nonce'] ) ), 'sc_details_save' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['sc_role'] ) ) {
		update_post_meta( $post_id, '_sc_role', sanitize_text_field( wp_unslash( $_POST['sc_role'] ) ) );
	}
}
add_action( 'save_post', 'successcircles_save_meta_box', 10, 2 );

/**
 * First-run setup: make sure the pages the theme's navigation points at exist,
 * and that the blog has a home, so uploading the theme to a fresh install lands
 * on a working site rather than a set of 404s.
 *
 * Only ever fills in blanks — an existing Posts page or front page is left alone.
 *
 * @return void
 */
function successcircles_activate() {
	$pages = array(
		'home'                   => __( 'Home', 'successcircles' ),
		'rules-for-success'      => __( 'Rules for Success', 'successcircles' ),
		'testimonials'           => __( 'Testimonials', 'successcircles' ),
		'weekly-wins'            => __( 'Momentum Buzz', 'successcircles' ),
		'about'                  => __( 'About', 'successcircles' ),
		'about-joseph-varghese'  => __( 'About Joseph Varghese', 'successcircles' ),
		'faq'                    => __( 'FAQ', 'successcircles' ),
		'contact-us'             => __( 'Contact', 'successcircles' ),
		'momentum-buddy'         => __( 'Momentum Braintrust Buddy', 'successcircles' ),
		'momentum-labs'          => __( 'Momentum Labs', 'successcircles' ),
		'momentum-team'          => __( 'Momentum Team', 'successcircles' ),
	);

	$ids = array();

	foreach ( $pages as $slug => $title ) {
		$page = get_page_by_path( $slug );

		$ids[ $slug ] = $page ? $page->ID : wp_insert_post(
			array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'post_title'  => $title,
				'post_name'   => $slug,
			)
		);
	}

	if ( ! get_option( 'page_for_posts' ) && ! is_wp_error( $ids['rules-for-success'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['home'] );
		update_option( 'page_for_posts', $ids['rules-for-success'] );
	}

	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'successcircles_activate' );
