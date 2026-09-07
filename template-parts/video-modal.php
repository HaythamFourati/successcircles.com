<?php
/**
 * The shared video lightbox.
 *
 * A native <dialog> that initStoryVideo() in theme.js fills on open and empties
 * on close — emptying is what stops playback, since there is no player API on
 * a cross-origin iframe. Any trigger carrying data-sc-video-modal opens it, so
 * one dialog serves the homepage hero and the testimonials roll call alike.
 *
 * Include it once per page that has such a trigger.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

?>
<dialog class="sc-video-modal" data-sc-video-dialog aria-label="<?php esc_attr_e( 'Video player', 'successcircles' ); ?>">
	<div class="sc-video-modal__panel">
		<button class="sc-video-modal__close" type="button" data-sc-video-close>
			<span class="sc-screen-reader-text"><?php esc_html_e( 'Close video', 'successcircles' ); ?></span>
			<span aria-hidden="true">&times;</span>
		</button>
		<div class="sc-video-modal__frame" data-sc-video-mount></div>
		<p class="sc-video-modal__caption" data-sc-video-caption></p>
	</div>
</dialog>
