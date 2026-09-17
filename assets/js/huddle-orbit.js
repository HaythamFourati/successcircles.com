/* The huddle flywheel. Steps and arrows select directly; the loop also turns on
   its own until someone touches it. The turn counter is never wrapped, so the
   ring only ever rotates forwards. */
( function () {
	'use strict';

	var root = document.querySelector( '[data-sc-fly]' );
	if ( ! root ) { return; }

	var ring = root.querySelector( '.sc-fly__ring' );
	var steps = Array.prototype.slice.call( root.querySelectorAll( '[data-sc-fly-step]' ) );
	var controls = root.querySelector( '.sc-fly__controls' );
	var count = steps.length;
	if ( count < 2 ) { return; }

	var turn = 0;
	var timer = 0;
	var reduced = window.matchMedia( '(prefers-reduced-motion: reduce)' );
	var mobile = window.matchMedia( '(max-width: 760px)' );

	function wrap( value ) { return ( ( value % count ) + count ) % count; }

	function render() {
		ring.style.setProperty( '--sc-fly-active', String( turn ) );
		var active = wrap( turn );
		steps.forEach( function ( el, i ) { el.setAttribute( 'aria-pressed', String( i === active ) ); } );
	}

	/* Move to the nearest representation of `index` so the ring never spins the
	   long way round for a one-step change. */
	function go( index ) {
		var delta = wrap( index - wrap( turn ) );
		if ( delta > count / 2 ) { delta -= count; }
		if ( delta ) { turn += delta; render(); }
	}

	function pause() { clearInterval( timer ); timer = 0; }

	function play() {
		pause();
		if ( mobile.matches || reduced.matches || document.hidden ) { return; }
		timer = setInterval( function () { turn += 1; render(); }, 2000 );
	}

	/* Picking a step only holds it while the pointer or focus is on the loop;
	   pointerleave/focusout restart it. */
	steps.forEach( function ( el, i ) {
		el.addEventListener( 'click', function () { pause(); go( i ); } );
	} );
	root.querySelector( '[data-sc-fly-prev]' ).addEventListener( 'click', function () { pause(); turn -= 1; render(); } );
	root.querySelector( '[data-sc-fly-next]' ).addEventListener( 'click', function () { pause(); turn += 1; render(); } );
	controls.hidden = false;

	root.addEventListener( 'pointerenter', pause );
	root.addEventListener( 'pointerleave', play );
	root.addEventListener( 'focusin', pause );
	root.addEventListener( 'focusout', play );
	document.addEventListener( 'visibilitychange', play );
	mobile.addEventListener( 'change', play );

	new IntersectionObserver( function ( entries ) {
		if ( entries[ 0 ].isIntersecting ) { play(); } else { pause(); }
	}, { threshold: 0.25 } ).observe( root );

	if ( reduced.matches ) { ring.style.transition = 'none'; }
	render();
}() );
