<?php
/**
 * Contact Form 7 integration.
 *
 * The theme ships a working, plugin-free contact form (inc/contact.php). If
 * Contact Form 7 is active, this takes over: the first time the contact page
 * renders it creates a "Success Circles Contact" form — fields, labels and mail
 * template included — stores its id in the `sc_cf7_form` option and renders it
 * from then on. Nothing to paste into the page, and moving the theme to a site
 * that already has CF7 provisions itself on the first visit.
 *
 * The form template is the theme's own markup, so CF7's output carries the same
 * .sc-field / .sc-btn classes as the built-in form and needs no extra styling.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

/**
 * Is Contact Form 7 available?
 *
 * @return bool
 */
function successcircles_cf7_active() {
	return class_exists( 'WPCF7_ContactForm' ) && method_exists( 'WPCF7_ContactForm', 'get_template' );
}

/**
 * The CF7 form template — theme markup with CF7 field tags in place of inputs.
 *
 * @return array<string, mixed> Properties for WPCF7_ContactForm::set_properties().
 */
function successcircles_cf7_properties() {
	$copy = (array) successcircles_content( 'contact.form', array() );
	$site = wp_specialchars_decode( (string) get_bloginfo( 'name' ), ENT_QUOTES );

	$label = static function ( $key, $fallback ) use ( $copy ) {
		return esc_html( wp_specialchars_decode( (string) ( $copy[ $key ] ?? $fallback ) ) );
	};

	$form = sprintf(
		'<div class="sc-field">
	<label class="sc-field__label" for="sc-name">%1$s</label>
	[text* sc-name id:sc-name class:sc-field__input autocomplete:name]
</div>

<div class="sc-field">
	<label class="sc-field__label" for="sc-email">%2$s</label>
	[email* sc-email id:sc-email class:sc-field__input autocomplete:email]
</div>

<div class="sc-field">
	<label class="sc-field__label" for="sc-phone">%3$s <span class="sc-field__optional">%4$s</span></label>
	[tel sc-phone id:sc-phone class:sc-field__input autocomplete:tel]
</div>

<div class="sc-field">
	<label class="sc-field__label" for="sc-message">%5$s</label>
	[textarea* sc-message id:sc-message class:sc-field__input class:sc-field__input--area rows:7]
</div>

<div class="sc-form__foot">
	[submit class:sc-btn class:sc-btn--primary "%6$s"]
	<p class="sc-form__note">%7$s</p>
</div>',
		$label( 'name', 'Your name' ),
		$label( 'email', 'Your email' ),
		$label( 'phone', 'Your phone' ),
		$label( 'optional', 'optional' ),
		$label( 'message', 'Your message' ),
		$label( 'submit', 'Send message' ),
		$label( 'consent', '' )
	);

	// No "sent from" line: CF7 posts through its REST endpoint, so [_url] is the
	// endpoint rather than the page, and this form only lives on one page anyway.
	$body = "[sc-name] <[sc-email]>\n"
		. __( 'Phone:', 'successcircles' ) . " [sc-phone]\n\n"
		. '[sc-message]';

	return array(
		'form' => $form,
		'mail' => array(
			/* translators: 1: site name, 2: sender name. */
			'subject'            => sprintf( __( '%1$s enquiry — %2$s', 'successcircles' ), $site, '[sc-name]' ),
			'sender'             => sprintf( '%s <wordpress@%s>', $site, wp_parse_url( home_url(), PHP_URL_HOST ) ),
			'recipient'          => successcircles_contact_email(),
			'body'               => $body,
			'additional_headers' => 'Reply-To: [sc-email]',
			'attachments'        => '',
			'use_html'           => 0,
			'exclude_blank'      => 0,
		),
	);
}

/**
 * The id of the theme's CF7 form, creating it on first use.
 *
 * @return int Form id, or 0 when CF7 is unavailable or the save failed.
 */
function successcircles_cf7_form_id() {
	static $id = null;

	if ( null !== $id ) {
		return $id;
	}

	$id = 0;

	if ( ! successcircles_cf7_active() ) {
		return $id;
	}

	$stored = (int) get_option( 'sc_cf7_form', 0 );

	// Trust the stored id only while the form is still there — deleting it in
	// the admin should hand us a fresh one rather than an empty shortcode.
	if ( $stored && 'wpcf7_contact_form' === get_post_type( $stored ) ) {
		$id = $stored;

		return $id;
	}

	$form = WPCF7_ContactForm::get_template( array( 'title' => __( 'Success Circles Contact', 'successcircles' ) ) );

	if ( ! $form ) {
		return $id;
	}

	$form->set_properties( successcircles_cf7_properties() );
	$saved = (int) $form->save();

	if ( $saved ) {
		update_option( 'sc_cf7_form', $saved, false );
		$id = $saved;
	}

	return $id;
}

/**
 * Render the contact form — CF7 when it is active, the built-in form otherwise.
 *
 * @return void
 */
function successcircles_contact_form() {
	$id = successcircles_cf7_form_id();

	if ( $id ) {
		echo do_shortcode( sprintf( '[contact-form-7 id="%d"]', $id ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		return;
	}

	get_template_part( 'template-parts/contact-form' );
}

/**
 * Give the CF7 form element the theme's form class.
 *
 * @param string $class Space-separated classes.
 * @return string
 */
function successcircles_cf7_form_class( $class ) {
	return $class . ' sc-form';
}
add_filter( 'wpcf7_form_class_attr', 'successcircles_cf7_form_class' );

/**
 * Keep wpautop away from our own form — the template is block markup, and
 * autop would litter it with stray paragraphs and line breaks. Scoped to the
 * theme's form so other CF7 forms on the site keep CF7's default behaviour.
 *
 * @param bool $autop Whether CF7 should run autop.
 * @return bool
 */
function successcircles_cf7_autop( $autop ) {
	$current = WPCF7_ContactForm::get_current();

	return ( $current && (int) $current->id() === successcircles_cf7_form_id() ) ? false : $autop;
}
add_filter( 'wpcf7_autop_or_not', 'successcircles_cf7_autop' );
