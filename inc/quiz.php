<?php
/**
 * The Entrepreneur Test.
 *
 * A small, plugin-free quiz: questions are `sc_question` posts (add, reorder and
 * delete them in the admin), the modal asks one at a time, and the closing step
 * captures name / email / phone and stores it as an `sc_lead` post — WordPress's
 * own tables are the database, so there is nothing to migrate or back up twice.
 *
 * Progressive enhancement, like the rest of the theme: with JavaScript off the
 * "Take the Entrepreneur Test" buttons keep their ordinary href.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

/* -------------------------------------------------------------- Post types */

/**
 * Register the question and lead post types.
 *
 * @return void
 */
function successcircles_register_quiz_types() {
	register_post_type(
		'sc_question',
		array(
			'labels'          => array(
				'name'               => __( 'Test Questions', 'successcircles' ),
				'singular_name'      => __( 'Test Question', 'successcircles' ),
				'add_new_item'       => __( 'Add New Question', 'successcircles' ),
				'edit_item'          => __( 'Edit Question', 'successcircles' ),
				'menu_name'          => __( 'Entrepreneur Test', 'successcircles' ),
				'search_items'       => __( 'Search Questions', 'successcircles' ),
				'not_found'          => __( 'No questions yet.', 'successcircles' ),
				'not_found_in_trash' => __( 'No questions in trash.', 'successcircles' ),
			),
			'description'     => __( 'The question goes in the title; the answers go in the Answer options box. Order them with the Order field.', 'successcircles' ),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'menu_icon'       => 'dashicons-forms',
			'menu_position'   => 22,
			'supports'        => array( 'title', 'page-attributes' ),
			'has_archive'     => false,
			'rewrite'         => false,
			'capability_type' => 'post',
		)
	);

	register_post_type(
		'sc_lead',
		array(
			'labels'          => array(
				'name'          => __( 'Test Leads', 'successcircles' ),
				'singular_name' => __( 'Test Lead', 'successcircles' ),
				'menu_name'     => __( 'Test Leads', 'successcircles' ),
				'search_items'  => __( 'Search Leads', 'successcircles' ),
				'not_found'     => __( 'No one has finished the test yet.', 'successcircles' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => 'edit.php?post_type=sc_question',
			'supports'        => array( 'title', 'editor' ),
			'has_archive'     => false,
			'rewrite'         => false,
			'capability_type' => 'post',
			'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'    => true,
		)
	);
}
add_action( 'init', 'successcircles_register_quiz_types' );

/* --------------------------------------------------------------- Admin UI */

/**
 * Answer options box on the question editor, lead details on a lead.
 *
 * @return void
 */
function successcircles_quiz_meta_boxes() {
	add_meta_box(
		'sc_question_options',
		__( 'Answer options', 'successcircles' ),
		'successcircles_render_options_box',
		'sc_question',
		'normal',
		'high'
	);

	add_meta_box(
		'sc_lead_details',
		__( 'Contact', 'successcircles' ),
		'successcircles_render_lead_box',
		'sc_lead',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'successcircles_quiz_meta_boxes' );

/**
 * Render the answer options textarea.
 *
 * @param WP_Post $post Current question.
 * @return void
 */
function successcircles_render_options_box( $post ) {
	wp_nonce_field( 'sc_question_save', 'sc_question_nonce' );

	printf(
		'<p><textarea name="sc_options" rows="6" class="widefat" placeholder="%1$s">%2$s</textarea></p><p class="description">%3$s</p>',
		esc_attr__( "Yes, every week\nSome weeks\nRarely\nNever", 'successcircles' ),
		esc_textarea( implode( "\n", successcircles_question_options( $post->ID ) ) ),
		esc_html__( 'One answer per line, two to six of them. A question with no options is skipped.', 'successcircles' )
	);
}

/**
 * Render the read-only lead contact details.
 *
 * @param WP_Post $post Current lead.
 * @return void
 */
function successcircles_render_lead_box( $post ) {
	$email = (string) get_post_meta( $post->ID, '_sc_email', true );
	$phone = (string) get_post_meta( $post->ID, '_sc_phone', true );

	printf(
		'<p><strong>%1$s</strong><br><a href="mailto:%2$s">%3$s</a></p><p><strong>%4$s</strong><br><a href="tel:%5$s">%6$s</a></p>',
		esc_html__( 'Email', 'successcircles' ),
		esc_attr( $email ),
		esc_html( $email ),
		esc_html__( 'Phone', 'successcircles' ),
		esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ),
		esc_html( $phone )
	);
}

/**
 * Save the answer options.
 *
 * @param int     $post_id Post ID.
 * @param WP_Post $post    Post object.
 * @return void
 */
function successcircles_save_question( $post_id, $post ) {
	if ( 'sc_question' !== $post->post_type || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ) {
		return;
	}

	if ( ! isset( $_POST['sc_question_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['sc_question_nonce'] ) ), 'sc_question_save' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) || ! isset( $_POST['sc_options'] ) ) {
		return;
	}

	update_post_meta( $post_id, '_sc_options', sanitize_textarea_field( wp_unslash( $_POST['sc_options'] ) ) );
}
add_action( 'save_post', 'successcircles_save_question', 10, 2 );

/**
 * Show the answers and contact details in the leads list.
 *
 * @param array<string, string> $columns Existing columns.
 * @return array<string, string>
 */
function successcircles_lead_columns( $columns ) {
	return array(
		'cb'        => isset( $columns['cb'] ) ? $columns['cb'] : '',
		'title'     => __( 'Name', 'successcircles' ),
		'sc_email'  => __( 'Email', 'successcircles' ),
		'sc_phone'  => __( 'Phone', 'successcircles' ),
		'date'      => __( 'Taken', 'successcircles' ),
	);
}
add_filter( 'manage_sc_lead_posts_columns', 'successcircles_lead_columns' );

/**
 * Fill the lead columns.
 *
 * @param string $column  Column slug.
 * @param int    $post_id Post ID.
 * @return void
 */
function successcircles_lead_column( $column, $post_id ) {
	if ( 'sc_email' === $column ) {
		$email = (string) get_post_meta( $post_id, '_sc_email', true );
		printf( '<a href="mailto:%1$s">%2$s</a>', esc_attr( $email ), esc_html( $email ) );
	}

	if ( 'sc_phone' === $column ) {
		echo esc_html( get_post_meta( $post_id, '_sc_phone', true ) );
	}
}
add_action( 'manage_sc_lead_posts_custom_column', 'successcircles_lead_column', 10, 2 );

/* --------------------------------------------------------------- Reading */

/**
 * A question's answer options.
 *
 * @param int $post_id Question ID.
 * @return array<int, string>
 */
function successcircles_question_options( $post_id ) {
	$raw = (string) get_post_meta( $post_id, '_sc_options', true );

	return array_values( array_filter( array_map( 'trim', preg_split( '/\R/', $raw ) ) ) );
}

/**
 * The published questions, in Order then date order.
 *
 * Questions with no answer options are dropped — a question nobody can answer
 * would stall the modal.
 *
 * @return array<int, array{id:int, title:string, options:array<int, string>}>
 */
function successcircles_quiz_questions() {
	static $questions = null;

	if ( null !== $questions ) {
		return $questions;
	}

	$questions = array();

	$posts = get_posts(
		array(
			'post_type'        => 'sc_question',
			'post_status'      => 'publish',
			'numberposts'      => 50,
			'orderby'          => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
			'suppress_filters' => false,
		)
	);

	foreach ( $posts as $post ) {
		$options = successcircles_question_options( $post->ID );

		if ( count( $options ) < 2 ) {
			continue;
		}

		$questions[] = array(
			'id'      => (int) $post->ID,
			'title'   => $post->post_title,
			'options' => $options,
		);
	}

	return $questions;
}

/**
 * Print the href and hook attribute for a "Take the Entrepreneur Test" button.
 *
 * The href stays a real destination so the button works without JavaScript; the
 * data attribute is what theme.js binds the modal to.
 *
 * @return void
 */
function successcircles_test_link_attrs() {
	printf( 'href="%s"', esc_url( successcircles_test_url() ) );

	if ( successcircles_quiz_questions() ) {
		echo ' data-sc-quiz';
	}
}

/* ------------------------------------------------------------- Submission */

/**
 * Store a completed test as a lead.
 *
 * @return void
 */
function successcircles_handle_quiz() {
	check_ajax_referer( 'sc_quiz', 'nonce' );

	// Honeypot: hidden from people, irresistible to bots. Answer with success so
	// the bot learns nothing from the difference.
	if ( ! empty( $_POST['sc_site'] ) ) {
		wp_send_json_success();
	}

	$name  = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';

	$errors = array();

	if ( '' === $name ) {
		$errors[] = 'name';
	}

	if ( ! is_email( $email ) ) {
		$errors[] = 'email';
	}

	if ( strlen( (string) preg_replace( '/[^0-9]/', '', $phone ) ) < 7 ) {
		$errors[] = 'phone';
	}

	if ( $errors ) {
		wp_send_json_error(
			array(
				'fields'  => $errors,
				'message' => __( 'Please check the highlighted fields.', 'successcircles' ),
			),
			400
		);
	}

	// One submission per address per minute, same as the contact form.
	$throttle = 'sc_quiz_rl_' . md5( $email . '|' . ( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '' ) );

	if ( get_transient( $throttle ) ) {
		wp_send_json_error( array( 'message' => __( 'You just sent this. Give it a minute.', 'successcircles' ) ), 429 );
	}

	set_transient( $throttle, 1, MINUTE_IN_SECONDS );

	// Answers are only trusted as far as the question list: anything that is not
	// one of that question's own options is discarded rather than stored.
	$submitted = isset( $_POST['answers'] ) && is_array( $_POST['answers'] ) ? wp_unslash( $_POST['answers'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- sanitised per value below.
	$lines     = array();

	foreach ( successcircles_quiz_questions() as $question ) {
		$answer = isset( $submitted[ $question['id'] ] ) ? sanitize_text_field( (string) $submitted[ $question['id'] ] ) : '';

		if ( ! in_array( $answer, $question['options'], true ) ) {
			continue;
		}

		$lines[] = $question['title'] . "\n— " . $answer;
	}

	$post_id = wp_insert_post(
		array(
			'post_type'    => 'sc_lead',
			'post_status'  => 'publish',
			'post_title'   => $name,
			'post_content' => implode( "\n\n", $lines ),
		),
		true
	);

	if ( is_wp_error( $post_id ) ) {
		wp_send_json_error( array( 'message' => __( 'Something went wrong saving your answers. Please try again.', 'successcircles' ) ), 500 );
	}

	update_post_meta( $post_id, '_sc_email', $email );
	update_post_meta( $post_id, '_sc_phone', $phone );

	wp_mail(
		successcircles_contact_email(),
		/* translators: %s: person's name. */
		sprintf( __( 'Entrepreneur Test completed — %s', 'successcircles' ), $name ),
		implode(
			"\n",
			array(
				__( 'Name:', 'successcircles' ) . ' ' . $name,
				__( 'Email:', 'successcircles' ) . ' ' . $email,
				__( 'Phone:', 'successcircles' ) . ' ' . $phone,
				'',
				implode( "\n\n", $lines ),
				'',
				'—',
				admin_url( 'post.php?post=' . $post_id . '&action=edit' ),
			)
		),
		array( 'Reply-To: ' . $name . ' <' . $email . '>' )
	);

	wp_send_json_success();
}
add_action( 'wp_ajax_sc_quiz', 'successcircles_handle_quiz' );
add_action( 'wp_ajax_nopriv_sc_quiz', 'successcircles_handle_quiz' );

/* ---------------------------------------------------------------- Front end */

/**
 * Hand the script its endpoint and nonce.
 *
 * @return void
 */
function successcircles_quiz_script_data() {
	if ( ! successcircles_quiz_questions() ) {
		return;
	}

	wp_localize_script(
		'successcircles',
		'scQuiz',
		array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'sc_quiz' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'successcircles_quiz_script_data', 20 );

/**
 * Render the modal once per page, in the footer.
 *
 * @return void
 */
function successcircles_quiz_modal() {
	$questions = successcircles_quiz_questions();

	if ( ! $questions ) {
		return;
	}

	$copy  = (array) successcircles_content( 'test', array() );
	$total = count( $questions ) + 1;

	require SUCCESSCIRCLES_DIR . '/template-parts/quiz-modal.php';
}
add_action( 'wp_footer', 'successcircles_quiz_modal' );

/**
 * Seed a starter set of questions the first time the theme is activated.
 *
 * Demo copy — the client should rewrite these in Entrepreneur Test → Test
 * Questions before launch.
 *
 * @return void
 */
function successcircles_seed_questions() {
	successcircles_register_quiz_types();

	if ( get_posts( array( 'post_type' => 'sc_question', 'post_status' => 'any', 'numberposts' => 1, 'fields' => 'ids' ) ) ) {
		return;
	}

	$seed = array(
		array(
			__( 'How long could your business run well without you in it?', 'successcircles' ),
			array( __( 'A month or more', 'successcircles' ), __( 'A couple of weeks', 'successcircles' ), __( 'A few days', 'successcircles' ), __( 'It would stall tomorrow', 'successcircles' ) ),
		),
		array(
			__( 'How much of last week went to work only you can do?', 'successcircles' ),
			array( __( 'Most of it', 'successcircles' ), __( 'About half', 'successcircles' ), __( 'A little', 'successcircles' ), __( 'None — I was firefighting', 'successcircles' ) ),
		),
		array(
			__( 'Do you know this quarter\'s single most important number?', 'successcircles' ),
			array( __( 'Yes, and I track it weekly', 'successcircles' ), __( 'Yes, roughly', 'successcircles' ), __( 'I have too many numbers', 'successcircles' ), __( 'No', 'successcircles' ) ),
		),
		array(
			__( 'When you commit to something, who holds you to it?', 'successcircles' ),
			array( __( 'A peer group, every week', 'successcircles' ), __( 'My leadership team', 'successcircles' ), __( 'A coach or mentor', 'successcircles' ), __( 'Nobody but me', 'successcircles' ) ),
		),
		array(
			__( 'How often does your team ship what it planned?', 'successcircles' ),
			array( __( 'Almost always', 'successcircles' ), __( 'More often than not', 'successcircles' ), __( 'It slips regularly', 'successcircles' ), __( 'Plans rarely survive the month', 'successcircles' ) ),
		),
		array(
			__( 'What is the real constraint on growth right now?', 'successcircles' ),
			array( __( 'My own time', 'successcircles' ), __( 'People and delegation', 'successcircles' ), __( 'Sales and pipeline', 'successcircles' ), __( 'Focus — too many directions', 'successcircles' ) ),
		),
	);

	foreach ( $seed as $order => $question ) {
		$post_id = wp_insert_post(
			array(
				'post_type'   => 'sc_question',
				'post_status' => 'publish',
				'post_title'  => $question[0],
				'menu_order'  => $order + 1,
			)
		);

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, '_sc_options', implode( "\n", $question[1] ) );
		}
	}
}
add_action( 'after_switch_theme', 'successcircles_seed_questions' );
