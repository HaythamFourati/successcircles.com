<?php
/**
 * Light/dark theme toggle.
 *
 * A toggle button rather than a link: aria-pressed carries the state, so a
 * screen reader announces "Dark theme, pressed" without needing the label to be
 * rewritten. The initial value is corrected by assets/js/theme.js on load,
 * because the active theme is only known client-side (localStorage or the OS
 * preference); markup cached by a page cache must not assert either way.
 *
 * Rendered twice — once in the desktop header aside, once in the compact bar —
 * so the script binds every [data-sc-theme-toggle] it finds.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

?>
<button
	class="sc-theme-toggle"
	type="button"
	data-sc-theme-toggle
	aria-pressed="false"
	hidden
>
	<svg class="sc-theme-toggle__icon sc-theme-toggle__icon--moon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
		<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
	</svg>
	<svg class="sc-theme-toggle__icon sc-theme-toggle__icon--sun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
		<circle cx="12" cy="12" r="4.2" />
		<path d="M12 2.4v2.2M12 19.4v2.2M4.22 4.22l1.56 1.56M18.22 18.22l1.56 1.56M2.4 12h2.2M19.4 12h2.2M4.22 19.78l1.56-1.56M18.22 5.78l1.56-1.56" />
	</svg>
	<span class="sc-screen-reader-text"><?php esc_html_e( 'Dark theme', 'successcircles' ); ?></span>
</button>
