/* Load the video and its SDK only when requested; the poster paints immediately. */
( function () {
	'use strict';
	var frame = document.querySelector( '[data-sc-hero-video]' );
	if ( ! frame ) { return; }
	var button = frame.querySelector( 'button' );
	var iframe = frame.querySelector( 'iframe' );
	var fallback = frame.querySelector( '.sc-orbit__video-fallback' );
	var playing = false;
	var player;
	function fail() {
		button.disabled = false;
		button.removeAttribute( 'aria-busy' );
		fallback.hidden = false;
	}
	function sync( active ) {
		playing = active;
		if ( active ) { frame.classList.add( 'has-played' ); }
		frame.classList.toggle( 'is-playing', active );
		button.setAttribute( 'aria-label', active ? 'Pause introduction video' : 'Play introduction video' );
		button.removeAttribute( 'aria-busy' );
		button.disabled = false;
	}
	function loadSDK() {
		if ( window.Vimeo && window.Vimeo.Player ) { return Promise.resolve(); }
		return new Promise( function ( resolve, reject ) {
			var script = document.createElement( 'script' );
			var timer = setTimeout( function () { reject( new Error( 'Video loading timed out' ) ); }, 15000 );
			script.src = 'https://player.vimeo.com/api/player.js';
			script.onload = function () { clearTimeout( timer ); resolve(); };
			script.onerror = function () { clearTimeout( timer ); script.remove(); reject( new Error( 'Video unavailable' ) ); };
			document.head.appendChild( script );
		} );
	}
	function start() {
		if ( player ) { return playing ? player.pause() : player.play(); }
		// The user's requested playback may autoplay once the deferred player loads.
		iframe.src = iframe.dataset.src.replace( 'autoplay=0', 'autoplay=1' );
		return loadSDK().then( function () {
			player = new window.Vimeo.Player( iframe );
			player.on( 'play', function () { sync( true ); } );
			player.on( 'pause', function () { sync( false ); } );
			player.on( 'ended', function () { sync( false ); } );
			player.on( 'error', fail );
			return player.ready().then( function () { return player.play(); } );
		} );
	}
	button.addEventListener( 'click', function () {
		button.disabled = true;
		button.setAttribute( 'aria-busy', 'true' );
		var timer = setTimeout( fail, 15000 );
		start().then( function () { clearTimeout( timer ); button.disabled = false; button.removeAttribute( 'aria-busy' ); } ).catch( function () { clearTimeout( timer ); fail(); } );
	} );
}() );
