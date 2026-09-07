/* Inline hero playback. Keep the custom control in sync with Vimeo events. */
( function () {
	'use strict';
	var frame = document.querySelector( '[data-sc-hero-video]' );
	if ( ! frame ) { return; }
	var button = frame.querySelector( 'button' );
	var fallback = frame.querySelector( '.sc-orbit__video-fallback' );
	var playing = false;
	function fail() {
		button.hidden = true;
		fallback.hidden = false;
	}
	if ( ! window.Vimeo ) { fail(); return; }
	var player = new window.Vimeo.Player( frame.querySelector( 'iframe' ) );
	function sync( active ) {
		playing = active;
		frame.classList.toggle( 'is-playing', active );
		button.setAttribute( 'aria-label', active ? 'Pause introduction video' : 'Play introduction video' );
		button.disabled = false;
	}
	player.ready().then( function () { sync( false ); } ).catch( fail );
	player.on( 'play', function () { sync( true ); } );
	player.on( 'pause', function () { sync( false ); } );
	player.on( 'ended', function () { sync( false ); } );
	player.on( 'error', fail );
	button.addEventListener( 'click', function () {
		button.disabled = true;
		( playing ? player.pause() : player.play() ).catch( function () {
			button.disabled = false;
			fallback.hidden = false;
		} );
	} );
}() );
