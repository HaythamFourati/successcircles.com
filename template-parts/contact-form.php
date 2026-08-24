<?php
/**
 * The built-in contact form.
 *
 * Rendered by successcircles_contact_form() when Contact Form 7 is not active.
 * Posts to admin-post.php and is handled by inc/contact.php — no plugin, no
 * JavaScript. When CF7 is active, inc/cf7.php renders its form instead, using
 * the same markup and classes so the styling is shared.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_form    = (array) successcircles_content( 'contact.form', array() );
$sc_notices = (array) successcircles_content( 'contact.notices', array() );

$sc_status  = isset( $_GET['sc-contact'] ) ? sanitize_key( wp_unslash( $_GET['sc-contact'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
$sc_sent    = 'sent' === $sc_status;
$sc_invalid = successcircles_contact_invalid_fields();
$sc_values  = successcircles_contact_values();

$sc_field_error = static function ( $field ) use ( $sc_invalid ) {
	return in_array( $field, $sc_invalid, true );
};

if ( $sc_status && isset( $sc_notices[ $sc_status ] ) ) :
	?>
	<p class="sc-notice sc-notice--<?php echo $sc_sent ? 'ok' : 'bad'; ?>" role="status" tabindex="-1">
		<?php echo esc_html( wp_specialchars_decode( $sc_notices[ $sc_status ] ) ); ?>
	</p>
	<?php
endif;
?>

<form class="sc-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
	<input type="hidden" name="action" value="sc_contact">
	<?php wp_nonce_field( 'sc_contact', 'sc_contact_nonce' ); ?>

	<div class="sc-field<?php echo $sc_field_error( 'name' ) ? ' is-invalid' : ''; ?>">
		<label class="sc-field__label" for="sc-name"><?php echo esc_html( $sc_form['name'] ); ?></label>
		<input
			class="sc-field__input"
			type="text"
			id="sc-name"
			name="sc_name"
			value="<?php echo esc_attr( $sc_values['name'] ); ?>"
			autocomplete="name"
			required
			<?php echo $sc_field_error( 'name' ) ? 'aria-invalid="true"' : ''; ?>
		>
	</div>

	<div class="sc-field<?php echo $sc_field_error( 'email' ) ? ' is-invalid' : ''; ?>">
		<label class="sc-field__label" for="sc-email"><?php echo esc_html( $sc_form['email'] ); ?></label>
		<input
			class="sc-field__input"
			type="email"
			id="sc-email"
			name="sc_email"
			value="<?php echo esc_attr( $sc_values['email'] ); ?>"
			autocomplete="email"
			required
			<?php echo $sc_field_error( 'email' ) ? 'aria-invalid="true"' : ''; ?>
		>
	</div>

	<div class="sc-field">
		<label class="sc-field__label" for="sc-phone">
			<?php echo esc_html( $sc_form['phone'] ); ?>
			<span class="sc-field__optional"><?php echo esc_html( $sc_form['optional'] ); ?></span>
		</label>
		<input
			class="sc-field__input"
			type="tel"
			id="sc-phone"
			name="sc_phone"
			value="<?php echo esc_attr( $sc_values['phone'] ); ?>"
			autocomplete="tel"
		>
	</div>

	<div class="sc-field<?php echo $sc_field_error( 'message' ) ? ' is-invalid' : ''; ?>">
		<label class="sc-field__label" for="sc-message"><?php echo esc_html( $sc_form['message'] ); ?></label>
		<textarea
			class="sc-field__input sc-field__input--area"
			id="sc-message"
			name="sc_message"
			rows="7"
			required
			<?php echo $sc_field_error( 'message' ) ? 'aria-invalid="true"' : ''; ?>
		><?php echo esc_textarea( $sc_values['message'] ); ?></textarea>
	</div>

	<?php // Honeypot. Hidden from people, filled in by bots — see inc/contact.php. ?>
	<div class="sc-field sc-field--trap" aria-hidden="true">
		<label for="sc-site"><?php esc_html_e( 'Leave this field empty', 'successcircles' ); ?></label>
		<input type="text" id="sc-site" name="sc_site" tabindex="-1" autocomplete="off">
	</div>

	<div class="sc-form__foot">
		<button class="sc-btn sc-btn--primary" type="submit">
			<?php echo esc_html( $sc_form['submit'] ); ?>
		</button>
		<p class="sc-form__note"><?php echo esc_html( wp_specialchars_decode( $sc_form['consent'] ) ); ?></p>
	</div>
</form>
