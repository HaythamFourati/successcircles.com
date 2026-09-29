/* The poster paints immediately. Once the page has loaded, the video starts as a
   muted, looping preview — browsers only allow autoplay without sound. The big play
   button stays up over it and restarts the film from the top with sound. */
( function () {
	'use strict';
	var frame = document.querySelector( '[data-sc-hero-video]' );
	if ( ! frame ) { return; }
	var button = frame.querySelector( 'button' );
	var iframe = frame.querySelector( 'iframe' );
	var fallback = frame.querySelector( '.sc-orbit__video-fallback' );
	var playing = false;
	var previewing = false;
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
	function attach() {
		player = new window.Vimeo.Player( iframe );
		// During the muted preview the poster goes, but the button keeps offering sound.
		player.on( 'play', function () { frame.classList.add( 'has-played' ); if ( ! previewing ) { sync( true ); } } );
		player.on( 'pause', function () { if ( ! previewing ) { sync( false ); } } );
		player.on( 'ended', function () { if ( ! previewing ) { sync( false ); } } );
		player.on( 'error', fail );
		return player.ready();
	}
	function preview() {
		previewing = true;
		iframe.src = iframe.dataset.src.replace( 'autoplay=0', 'autoplay=1&muted=1&loop=1' );
		loadSDK().then( attach ).catch( function () { previewing = false; player = null; } );
	}
	function start() {
		if ( player && previewing ) {
			previewing = false;
			// The preview is already running: rewind and unmute it rather than calling
			// play() mid-seek, which Vimeo rejects and which left the button stuck centred.
			return player.setCurrentTime( 0 )
				.then( function () { return Promise.all( [ player.setMuted( false ), player.setVolume( 1 ), player.setLoop( false ) ] ); } )
				.then( function () { return player.getPaused(); } )
				.then( function ( paused ) { return paused ? player.play() : null; } )
				.then( function () { sync( true ); } );
		}
		if ( player ) { return playing ? player.pause() : player.play(); }
		// Clicked before the preview's player was ready: play with sound instead.
		previewing = false;
		// The user's requested playback may autoplay once the deferred player loads.
		iframe.src = iframe.dataset.src.replace( 'autoplay=0', 'autoplay=1' );
		return loadSDK().then( attach ).then( function () { return player.play(); } );
	}
	button.addEventListener( 'click', function () {
		button.disabled = true;
		button.setAttribute( 'aria-busy', 'true' );
		var timer = setTimeout( fail, 15000 );
		start().then( function () { clearTimeout( timer ); button.disabled = false; button.removeAttribute( 'aria-busy' ); } ).catch( function () { clearTimeout( timer ); fail(); } );
	} );
	// ponytail: after `load`, so the player never competes with first paint. Skipped for
	// reduced motion and Save-Data; the button still plays it on request.
	var saveData = navigator.connection && navigator.connection.saveData;
	if ( ! window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches && ! saveData ) {
		if ( document.readyState === 'complete' ) { preview(); } else { window.addEventListener( 'load', preview ); }
	}
}() );
