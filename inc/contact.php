<?php
/**
 * Contact form handling.
 *
 * A deliberately small, plugin-free handler: the form posts to admin-post.php,
 * this validates it, mails it to the site admin (or the Customizer override)
 * and redirects back to the page with a status in the query string. No AJAX,
 * no third-party service, works with JavaScript off.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

/**
 * Where contact enquiries are delivered.
 *
 * @return string
 */
function successcircles_contact_email() {
	$email = (string) get_theme_mod( 'sc_contact_email', '' );

	return is_email( $email ) ? $email : (string) get_option( 'admin_email' );
}

/**
 * Redirect back to the form with a status, and stop.
 *
 * @param string               $status   Status slug read by page-contact-us.php.
 * @param string               $redirect Page to return to.
 * @param array<int, string>   $errors   Field slugs that failed validation.
 * @param array<string, string> $values  Submitted values to repopulate.
 * @return void
 */
function successcircles_contact_redirect( $status, $redirect, $errors = array(), $values = array() ) {
	$args = array( 'sc-contact' => $status );

	if ( $errors ) {
		$args['sc-fields'] = implode( ',', $errors );
	}

	// Hand the submitted values back through a short-lived transient rather than
	// the URL, so a long message is never lost to a failed validation round trip.
	if ( $values ) {
		$token = wp_generate_password( 12, false );
		set_transient( 'sc_contact_' . $token, $values, 5 * MINUTE_IN_SECONDS );
		$args['sc-token'] = $token;
	}

	wp_safe_redirect( add_query_arg( $args, $redirect ) . '#sc-contact-form' );
	exit;
}

/**
 * Validate and send a contact form submission.
 *
 * @return void
 */
function successcircles_handle_contact() {
	$redirect = wp_get_referer();

	if ( ! $redirect ) {
		$redirect = home_url( '/' );
	}

	$redirect = remove_query_arg( array( 'sc-contact', 'sc-fields', 'sc-token' ), $redirect );

	$nonce = isset( $_POST['sc_contact_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['sc_contact_nonce'] ) ) : '';

	if ( ! wp_verify_nonce( $nonce, 'sc_contact' ) ) {
		successcircles_contact_redirect( 'expired', $redirect );
	}

	// Honeypot: a field hidden from people, irresistible to bots. Answer with a
	// success page so the bot has nothing to learn from the difference.
	if ( ! empty( $_POST['sc_site'] ) ) {
		successcircles_contact_redirect( 'sent', $redirect );
	}

	$name    = isset( $_POST['sc_name'] ) ? sanitize_text_field( wp_unslash( $_POST['sc_name'] ) ) : '';
	$email   = isset( $_POST['sc_email'] ) ? sanitize_email( wp_unslash( $_POST['sc_email'] ) ) : '';
	$phone   = isset( $_POST['sc_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['sc_phone'] ) ) : '';
	$message = isset( $_POST['sc_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['sc_message'] ) ) : '';

	$values = array(
		'name'    => $name,
		'email'   => $email,
		'phone'   => $phone,
		'message' => $message,
	);

	$errors = array();

	if ( '' === $name ) {
		$errors[] = 'name';
	}

	if ( ! is_email( $email ) ) {
		$errors[] = 'email';
	}

	if ( strlen( trim( $message ) ) < 10 ) {
		$errors[] = 'message';
	}

	if ( $errors ) {
		successcircles_contact_redirect( 'invalid', $redirect, $errors, $values );
	}

	// One submission per address per minute. Keeps a stuck form or a crude bot
	// from flooding the inbox; real spam volume needs a captcha on top.
	$throttle = 'sc_contact_rl_' . md5( $email . '|' . ( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '' ) );

	if ( get_transient( $throttle ) ) {
		successcircles_contact_redirect( 'throttled', $redirect, array(), $values );
	}

	set_transient( $throttle, 1, MINUTE_IN_SECONDS );

	$body = implode(
		"\n",
		array(
			__( 'Name:', 'successcircles' ) . ' ' . $name,
			__( 'Email:', 'successcircles' ) . ' ' . $email,
			__( 'Phone:', 'successcircles' ) . ' ' . ( '' !== $phone ? $phone : __( 'not given', 'successcircles' ) ),
			'',
			__( 'Message:', 'successcircles' ),
			$message,
			'',
			'—',
			/* translators: %s: page URL the form was submitted from. */
			sprintf( __( 'Sent from %s', 'successcircles' ), $redirect ),
		)
	);

	$sent = wp_mail(
		successcircles_contact_email(),
		/* translators: %s: sender name. */
		sprintf( __( 'SuccessCircles enquiry — %s', 'successcircles' ), $name ),
		$body,
		array( 'Reply-To: ' . $name . ' <' . $email . '>' )
	);

	successcircles_contact_redirect( $sent ? 'sent' : 'failed', $redirect, array(), $sent ? array() : $values );
}
add_action( 'admin_post_nopriv_sc_contact', 'successcircles_handle_contact' );
add_action( 'admin_post_sc_contact', 'successcircles_handle_contact' );

/**
 * Values to repopulate the form with after a failed submission.
 *
 * @return array<string, string>
 */
function successcircles_contact_values() {
	$token = isset( $_GET['sc-token'] ) ? sanitize_key( wp_unslash( $_GET['sc-token'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	$values = $token ? get_transient( 'sc_contact_' . $token ) : array();

	return array(
		'name'    => isset( $values['name'] ) ? (string) $values['name'] : '',
		'email'   => isset( $values['email'] ) ? (string) $values['email'] : '',
		'phone'   => isset( $values['phone'] ) ? (string) $values['phone'] : '',
		'message' => isset( $values['message'] ) ? (string) $values['message'] : '',
	);
}

/**
 * Field slugs that failed validation on the last submission.
 *
 * @return array<int, string>
 */
function successcircles_contact_invalid_fields() {
	$fields = isset( $_GET['sc-fields'] ) ? sanitize_text_field( wp_unslash( $_GET['sc-fields'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	return $fields ? array_filter( array_map( 'sanitize_key', explode( ',', $fields ) ) ) : array();
}
