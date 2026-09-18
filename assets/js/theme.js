/**
 * SuccessCircles theme behaviour.
 *
 * Progressive enhancement only — every section renders and reads correctly
 * with JavaScript disabled.
 */
( function () {
	'use strict';

	var reduceMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	/**
	 * Remove the loader curtain from the accessibility tree and the paint
	 * pipeline once its animation has finished.
	 */
	function initLoader() {
		var loader = document.querySelector( '[data-sc-loader]' );

		if ( ! loader ) {
			return;
		}

		if ( reduceMotion ) {
			loader.remove();
			return;
		}

		var remove = function () {
			if ( loader.parentNode ) {
				loader.parentNode.removeChild( loader );
			}
		};

		loader.addEventListener( 'animationend', function ( event ) {
			if ( event.animationName === 'scCurtain' ) {
				remove();
			}
		} );

		// Safety net in case the animationend event never fires.
		window.setTimeout( remove, 3000 );
	}

	/**
	 * Mobile navigation drawer.
	 */
	function initMenu() {
		var toggle = document.querySelector( '[data-sc-menu-toggle]' );
		var drawer = document.querySelector( '[data-sc-menu]' );

		if ( ! toggle || ! drawer ) {
			return;
		}

		var setOpen = function ( open ) {
			drawer.classList.toggle( 'is-open', open );
			toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		};

		toggle.addEventListener( 'click', function () {
			setOpen( toggle.getAttribute( 'aria-expanded' ) !== 'true' );
		} );

		drawer.addEventListener( 'click', function ( event ) {
			if ( event.target.closest( 'a' ) ) {
				setOpen( false );
			}
		} );

		document.addEventListener( 'keydown', function ( event ) {
			if ( event.key === 'Escape' && toggle.getAttribute( 'aria-expanded' ) === 'true' ) {
				setOpen( false );
				toggle.focus();
			}
		} );

		// Collapse the drawer when we cross back into the desktop layout.
		// Must match the breakpoint in main.css.
		var wide = window.matchMedia( '(min-width: 1180px)' );
		var onChange = function ( event ) {
			if ( event.matches ) {
				setOpen( false );
			}
		};

		if ( typeof wide.addEventListener === 'function' ) {
			wide.addEventListener( 'change', onChange );
		}
	}

	/**
	 * Click-to-play facade for the member story video. Keeps the Vimeo player
	 * (and its cookies) off the page until the visitor asks for it: the trigger
	 * swaps itself for the iframe in place.
	 */
	function initStoryVideo() {
		Array.prototype.forEach.call( document.querySelectorAll( '[data-sc-video]' ), function ( trigger ) {
			trigger.addEventListener( 'click', function ( event ) {
				var src = trigger.getAttribute( 'data-sc-video' );

				if ( ! src ) {
					return;
				}

				event.preventDefault();

				var iframe = document.createElement( 'iframe' );
				iframe.setAttribute( 'src', src );
				iframe.setAttribute( 'title', trigger.getAttribute( 'data-sc-video-title' ) || '' );
				iframe.setAttribute( 'allow', 'autoplay; fullscreen; picture-in-picture' );
				iframe.setAttribute( 'allowfullscreen', 'allowfullscreen' );
				iframe.setAttribute( 'loading', 'lazy' );

				trigger.parentNode.replaceChild( iframe, trigger );
				iframe.focus();
			} );
		} );
	}

	/**
	 * Long-form article behaviour: a contents rail built from the headings the
	 * editor actually wrote, and a reading-progress hairline under the header.
	 *
	 * Both are enhancements. Without JavaScript the rail stays hidden and the
	 * prose takes the measure on its own.
	 */
	function initArticle() {
		var article = document.querySelector( '[data-sc-article]' );

		if ( ! article ) {
			return;
		}

		initContents( article );
		initProgress( article );
	}

	/**
	 * Momentum OS as a cycle: six nodes on a ring, one step in the middle, the
	 * amber arc tracking how far round the loop we are.
	 *
	 * Enhancement only. Without JavaScript — and under prefers-reduced-motion,
	 * where an auto-advancing carousel would be exactly the wrong thing — the
	 * markup stays a plain numbered list of all six steps and the ring is not
	 * drawn at all. A diagram nobody can drive is worth less than legible copy.
	 *
	 * Auto-advance runs only while the ring is on screen, and stops for good the
	 * moment the visitor picks a step themselves.
	 */
	function initMomentumOs() {
		var cycle = document.querySelector( '[data-sc-os]' );

		if ( ! cycle || reduceMotion || ! ( 'IntersectionObserver' in window ) ) {
			return;
		}

		var arc = cycle.querySelector( '[data-sc-os-arc]' );
		var nodes = Array.prototype.slice.call( cycle.querySelectorAll( '.sc-os__node' ) );
		var dots = Array.prototype.slice.call( cycle.querySelectorAll( '[data-sc-os-dot]' ) );
		var steps = Array.prototype.slice.call( cycle.querySelectorAll( '[data-sc-os-step]' ) );

		if ( ! arc || steps.length < 2 || dots.length !== steps.length ) {
			return;
		}

		var length = arc.getTotalLength();
		var index = -1;
		var timer = null;
		var held = false;

		arc.style.strokeDasharray = length;
		arc.style.strokeDashoffset = length;

		cycle.classList.add( 'is-enhanced' );

		var show = function ( next ) {
			index = ( next + steps.length ) % steps.length;

			steps.forEach( function ( step, i ) {
				step.hidden = i !== index;
			} );

			nodes.forEach( function ( node, i ) {
				node.classList.toggle( 'is-active', i === index );
				node.classList.toggle( 'is-done', i < index );
			} );

			dots.forEach( function ( dot, i ) {
				if ( i === index ) {
					dot.setAttribute( 'aria-current', 'step' );
				} else {
					dot.removeAttribute( 'aria-current' );
				}
			} );

			// Full circle on the last step, so the loop visibly closes.
			arc.style.strokeDashoffset = length - ( length * ( index + 1 ) / steps.length );
		};

		var stop = function () {
			window.clearInterval( timer );
			timer = null;
		};

		var start = function () {
			if ( timer || held ) {
				return;
			}

			timer = window.setInterval( function () {
				show( index + 1 );
			}, 3200 );
		};

		dots.forEach( function ( dot, i ) {
			dot.addEventListener( 'click', function () {
				// The visitor is driving now; stop moving under them.
				held = true;
				stop();
				show( i );
			} );
		} );

		// Only cycle while it is actually on screen.
		new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						start();
					} else {
						stop();
					}
				} );
			},
			{ threshold: 0.35 }
		).observe( cycle );

		show( 0 );
	}

	/**
	 * Turn the article's own h2/h3 structure into a sticky contents list.
	 *
	 * @param {HTMLElement} article The article element.
	 */
	function initContents( article ) {
		var toc = article.querySelector( '[data-sc-toc]' );
		var list = article.querySelector( '[data-sc-toc-list]' );
		var prose = article.querySelector( '.sc-prose--article' );

		if ( ! toc || ! list || ! prose ) {
			return;
		}

		var headings = Array.prototype.slice.call( prose.querySelectorAll( 'h2, h3' ) );

		// Below three sections a contents list is noise, not navigation.
		if ( headings.length < 3 ) {
			return;
		}

		var used = {};
		var links = [];

		headings.forEach( function ( heading, index ) {
			if ( ! heading.id ) {
				heading.id = slug( heading.textContent, used, index );
			}

			var item = document.createElement( 'li' );
			var link = document.createElement( 'a' );

			if ( heading.tagName === 'H3' ) {
				item.className = 'sc-toc__sub';
			}

			link.href = '#' + heading.id;
			link.textContent = heading.textContent.trim();

			item.appendChild( link );
			list.appendChild( item );

			links.push( { item: item, heading: heading } );
		} );

		toc.hidden = false;

		// Open on desktop where the rail is sticky; a disclosure on small screens.
		var wide = window.matchMedia( '(min-width: 1100px)' );
		var sync = function ( event ) {
			toc.open = event.matches;
		};

		sync( wide );

		if ( typeof wide.addEventListener === 'function' ) {
			wide.addEventListener( 'change', sync );
		}

		// Close the disclosure again after jumping, on small screens only.
		list.addEventListener( 'click', function () {
			if ( ! wide.matches ) {
				toc.open = false;
			}
		} );

		trackCurrent( links );
	}

	/**
	 * Build a unique, URL-safe id from a heading's text.
	 *
	 * @param {string} text  Heading text.
	 * @param {Object} used  Map of ids already taken.
	 * @param {number} index Heading position, used as the last-resort suffix.
	 * @return {string} The id.
	 */
	function slug( text, used, index ) {
		var base = text
			.toLowerCase()
			.replace( /[\u2018\u2019\u201c\u201d]/g, '' )
			.replace( /[^a-z0-9]+/g, '-' )
			.replace( /^-+|-+$/g, '' )
			.slice( 0, 60 );

		if ( ! base ) {
			base = 'section';
		}

		var id = base;

		while ( used[ id ] || document.getElementById( id ) ) {
			id = base + '-' + ( index + 1 );
			index++;
		}

		used[ id ] = true;

		return id;
	}

	/**
	 * Mark the section currently being read.
	 *
	 * @param {Array} links Pairs of list item and heading.
	 */
	function trackCurrent( links ) {
		if ( ! ( 'IntersectionObserver' in window ) ) {
			return;
		}

		var seen = [];

		var setCurrent = function () {
			// The last heading that has crossed the reading line wins.
			var current = null;

			links.forEach( function ( entry, index ) {
				if ( seen[ index ] ) {
					current = entry;
				}
			} );

			links.forEach( function ( entry ) {
				entry.item.classList.toggle( 'is-current', entry === current );
			} );
		};

		var observer = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					links.forEach( function ( link, index ) {
						if ( link.heading === entry.target ) {
							seen[ index ] = entry.boundingClientRect.top < 140;
						}
					} );
				} );

				setCurrent();
			},
			{ rootMargin: '-140px 0px -60% 0px', threshold: 0 }
		);

		links.forEach( function ( entry ) {
			observer.observe( entry.heading );
		} );
	}

	/**
	 * Scale the hairline under the sticky header to reading progress.
	 *
	 * @param {HTMLElement} article The article element.
	 */
	function initProgress( article ) {
		var bar = document.querySelector( '[data-sc-progress]' );

		if ( ! bar ) {
			return;
		}

		var ticking = false;

		var update = function () {
			ticking = false;

			var start = article.getBoundingClientRect().top + window.pageYOffset;
			var distance = article.offsetHeight - window.innerHeight;
			var scrolled = window.pageYOffset - start;
			var ratio = distance > 0 ? scrolled / distance : 0;

			bar.style.setProperty( '--sc-progress', Math.min( 1, Math.max( 0, ratio ) ).toFixed( 4 ) );
		};

		var request = function () {
			if ( ! ticking ) {
				ticking = true;
				window.requestAnimationFrame( update );
			}
		};

		window.addEventListener( 'scroll', request, { passive: true } );
		window.addEventListener( 'resize', request );
		update();
	}


	/**
	 * The Entrepreneur Test: one question at a time in a native <dialog>, then
	 * a contact step, then the thank-you screen.
	 *
	 * Enhancement only — with JavaScript off the buttons keep their href and the
	 * dialog is never opened.
	 */
	function initQuiz() {
		var dialog = document.querySelector( '[data-sc-quiz-dialog]' );

		if ( ! dialog || typeof dialog.showModal !== 'function' ) {
			return;
		}

		var steps = Array.prototype.slice.call( dialog.querySelectorAll( '[data-sc-quiz-step]' ) );
		var form = dialog.querySelector( '.sc-quiz__form' );
		var error = dialog.querySelector( '[data-sc-quiz-error]' );
		var back = dialog.querySelector( '[data-sc-quiz-back]' );
		var track = dialog.querySelector( '[data-sc-quiz-track] span' );
		var count = dialog.querySelector( '[data-sc-quiz-count]' );
		var current = dialog.querySelector( '[data-sc-quiz-current]' );
		var submit = dialog.querySelector( '[data-sc-quiz-submit]' );
		var submitLabel = submit ? submit.textContent : '';
		var fallback = error.getAttribute( 'data-sc-quiz-fallback' ) || 'Something went wrong. Please try again.';
		var doneIndex = steps.length - 1;
		var answers = {};
		var index = 0;

		var pad = function ( n ) {
			return n < 10 ? '0' + n : String( n );
		};

		var show = function ( next ) {
			index = Math.max( 0, Math.min( doneIndex, next ) );

			steps.forEach( function ( step, i ) {
				step.hidden = i !== index;
			} );

			var done = index === doneIndex;

			back.hidden = index === 0 || done;
			count.hidden = done;
			current.textContent = pad( index + 1 );
			track.style.width = ( ( done ? 1 : ( index + 1 ) / doneIndex ) * 100 ) + '%';

			var heading = steps[ index ].querySelector( '.sc-quiz__question' );

			if ( heading ) {
				heading.focus();
			}
		};

		var open = function () {
			dialog.showModal();
			show( 0 );
		};

		Array.prototype.forEach.call( document.querySelectorAll( '[data-sc-quiz]' ), function ( trigger ) {
			trigger.addEventListener( 'click', function ( event ) {
				event.preventDefault();
				open();
			} );
		} );

		Array.prototype.forEach.call( dialog.querySelectorAll( '[data-sc-quiz-close]' ), function ( button ) {
			button.addEventListener( 'click', function () {
				dialog.close();
			} );
		} );

		back.addEventListener( 'click', function () {
			show( index - 1 );
		} );

		// Reset on close so a second visit starts clean, unless they finished.
		dialog.addEventListener( 'close', function () {
			if ( index !== doneIndex ) {
				return;
			}

			answers = {};
			form.reset();
			error.hidden = true;

			Array.prototype.forEach.call( dialog.querySelectorAll( '.is-chosen, .is-invalid' ), function ( el ) {
				el.classList.remove( 'is-chosen', 'is-invalid' );
			} );

			show( 0 );
		} );

		// Clicking the backdrop closes: the panel is the only child, so a click
		// landing on the dialog itself landed outside it.
		dialog.addEventListener( 'click', function ( event ) {
			if ( event.target === dialog ) {
				dialog.close();
			}
		} );

		dialog.addEventListener( 'click', function ( event ) {
			var option = event.target.closest( '[data-sc-quiz-answer]' );

			if ( ! option ) {
				return;
			}

			var step = option.closest( '[data-sc-quiz-step]' );
			var chosen = option.getAttribute( 'data-sc-quiz-answer' );

			answers[ step.getAttribute( 'data-sc-quiz-question' ) ] = chosen;

			Array.prototype.forEach.call( step.querySelectorAll( '[data-sc-quiz-answer]' ), function ( other ) {
				other.classList.toggle( 'is-chosen', other === option );
			} );

			// A beat so the choice registers visually before the step changes.
			window.setTimeout( function () {
				show( index + 1 );
			}, reduceMotion ? 0 : 180 );
		} );

		form.addEventListener( 'submit', function ( event ) {
			event.preventDefault();

			if ( typeof window.scQuiz === 'undefined' ) {
				return;
			}

			var body = new FormData( form );

			body.append( 'action', 'sc_quiz' );
			body.append( 'nonce', window.scQuiz.nonce );

			Object.keys( answers ).forEach( function ( id ) {
				body.append( 'answers[' + id + ']', answers[ id ] );
			} );

			submit.disabled = true;
			submit.textContent = submit.getAttribute( 'data-sc-quiz-sending' );
			error.hidden = true;

			window.fetch( window.scQuiz.url, { method: 'POST', body: body, credentials: 'same-origin' } )
				.then( function ( response ) {
					return response.json().catch( function () {
						return { success: false };
					} );
				} )
				.then( function ( result ) {
					submit.disabled = false;
					submit.textContent = submitLabel;

					if ( result && result.success ) {
						show( doneIndex );
						return;
					}

					var data = result && result.data ? result.data : {};

					Array.prototype.forEach.call( form.querySelectorAll( '.sc-field' ), function ( field ) {
						var input = field.querySelector( '[name]' );
						var bad = input && data.fields && data.fields.indexOf( input.name ) !== -1;

						field.classList.toggle( 'is-invalid', !! bad );

						if ( input ) {
							input.setAttribute( 'aria-invalid', bad ? 'true' : 'false' );
						}
					} );

					error.textContent = data.message || fallback;
					error.hidden = false;
				} )
				.catch( function () {
					submit.disabled = false;
					submit.textContent = submitLabel;
					error.textContent = fallback;
					error.hidden = false;
				} );
		} );
	}

	function initReviews() {
		var root = document.querySelector( '[data-sc-reviews]' );
		if ( ! root ) { return; }
		var slides = Array.prototype.slice.call( root.querySelectorAll( '[data-sc-reviews-slide]' ) );
		var prevBtn = root.querySelector( '[data-sc-reviews-prev]' );
		var nextBtn = root.querySelector( '[data-sc-reviews-next]' );
		if ( slides.length < 2 ) { return; }
		var index = 0;
		root.classList.add( 'is-enhanced' );
		root.setAttribute( 'aria-label', 'Member reviews' );
		var track = root.querySelector( '.sc-reviews__track' );
		if ( track ) { track.setAttribute( 'aria-live', 'polite' ); }
		function show( next ) {
			index = ( next + slides.length ) % slides.length;
			slides.forEach( function ( slide, i ) {
				slide.classList.toggle( 'is-active', i === index );
				slide.setAttribute( 'aria-hidden', i === index ? 'false' : 'true' );
			} );
		}
		// Let visitors finish reading; reviews advance only on request.
		if ( prevBtn ) { prevBtn.addEventListener( 'click', function () { show( index - 1 ); } ); }
		if ( nextBtn ) { nextBtn.addEventListener( 'click', function () { show( index + 1 ); } ); }
		show( 0 );
	}

	/**
	 * Scroll-triggered fade-in for JV page chapters.
	 * Progressive enhancement — chapters are visible by default without JS.
	 */
	function initJvChapters() {
		if ( reduceMotion || ! ( 'IntersectionObserver' in window ) ) {
			return;
		}

		var chapters = document.querySelectorAll( '.sc-jv__chapter' );

		if ( ! chapters.length ) {
			return;
		}

		var observer = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( 'is-visible' );
						observer.unobserve( entry.target );
					}
				} );
			},
			{ threshold: 0.15, rootMargin: '0px 0px -40px 0px' }
		);

		Array.prototype.forEach.call( chapters, function ( chapter ) {
			observer.observe( chapter );
		} );
	}

	/**
	 * Scroll-triggered reveal for the About page "Our Approach" section.
	 * Adds .is-visible to trigger CSS staggered animations.
	 */
	function initRhythmReveal() {
		if ( reduceMotion || ! ( 'IntersectionObserver' in window ) ) {
			return;
		}

		var section = document.querySelector( '[data-sc-rhythm]' );

		if ( ! section ) {
			return;
		}

		new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( 'is-visible' );
					}
				} );
			},
			{ threshold: 0.2, rootMargin: '0px 0px -60px 0px' }
		).observe( section );
	}

	/**
	 * Expandable testimonials — toggle between excerpt and full text.
	 */
	/**
	 * The testimonials roll call: a cast list on the left driving one stage on
	 * the right, and the letter wall's expand toggles.
	 *
	 * Enhancement only, and only where the CSS actually rearranges anything —
	 * below 1000px every plate is already a visible gallery, so there is nothing
	 * to drive and no timer worth running.
	 */
	function initRollCall() {
		var roll = document.querySelector( '[data-sc-roll]' );

		if ( ! roll ) {
			return;
		}

		var rows = Array.prototype.slice.call( roll.querySelectorAll( '[data-sc-roll-row]' ) );
		var picks = Array.prototype.slice.call( roll.querySelectorAll( '[data-sc-roll-pick]' ) );
		var plates = Array.prototype.slice.call( roll.querySelectorAll( '[data-sc-roll-plate]' ) );

		if ( plates.length < 2 || picks.length !== plates.length ) {
			return;
		}

		var wide = window.matchMedia( '(min-width: 1000px)' );
		var index = -1;
		var timer = null;
		var held = false;
		var playing = false;

		roll.classList.add( 'is-enhanced' );

		var show = function ( next ) {
			index = ( next + plates.length ) % plates.length;

			rows.forEach( function ( row, i ) {
				row.classList.toggle( 'is-active', i === index );
			} );

			plates.forEach( function ( plate, i ) {
				plate.classList.toggle( 'is-active', i === index );
			} );

			picks.forEach( function ( pick, i ) {
				if ( i === index ) {
					pick.setAttribute( 'aria-current', 'true' );
				} else {
					pick.removeAttribute( 'aria-current' );
				}
			} );
		};

		var stop = function () {
			window.clearInterval( timer );
			timer = null;
		};

		var start = function () {
			if ( timer || held || playing || reduceMotion || ! wide.matches ) {
				return;
			}

			timer = window.setInterval( function () {
				show( index + 1 );
			}, 4600 );
		};

		// Detect when a video starts playing inline (iframe replaces the button).
		roll.addEventListener( 'click', function ( event ) {
			if ( event.target.closest( '[data-sc-video]' ) ) {
				playing = true;
				stop();
			}
		} );

		// Also catch the iframe via MutationObserver, since initStoryVideo
		// replaces the button after the click handler runs.
		if ( 'MutationObserver' in window ) {
			new MutationObserver( function ( mutations ) {
				mutations.forEach( function ( m ) {
					if ( m.addedNodes.length && m.addedNodes[0].nodeName === 'IFRAME' ) {
						playing = true;
						stop();
					}
				} );
			} ).observe( roll, { childList: true, subtree: true } );
		}

		picks.forEach( function ( pick, i ) {
			// Pointer over a name previews it; the stage is what plays.
			pick.addEventListener( 'mouseenter', function () {
				if ( wide.matches ) {
					show( i );
				}
			} );

			pick.addEventListener( 'focus', function () {
				if ( wide.matches ) {
					show( i );
				}
			} );

			pick.addEventListener( 'click', function () {
				held = true;
				stop();
				show( i );

				// On a touch screen the stage may be off the fold; bring it in.
				if ( ! wide.matches ) {
					plates[ i ].scrollIntoView( { block: 'nearest' } );
				}
			} );
		} );

		// Hovering the stage or the list should not fight the visitor.
		roll.addEventListener( 'mouseenter', stop );
		roll.addEventListener( 'mouseleave', start );

		if ( 'IntersectionObserver' in window ) {
			new IntersectionObserver(
				function ( entries ) {
					entries.forEach( function ( entry ) {
						if ( entry.isIntersecting ) {
							start();
						} else {
							stop();
						}
					} );
				},
				{ threshold: 0.25 }
			).observe( roll );
		}

		if ( typeof wide.addEventListener === 'function' ) {
			wide.addEventListener( 'change', function () {
				stop();
				start();
			} );
		}

		show( 0 );
	}

	/**
	 * The letters deck: eight testimonials stacked like physical correspondence,
	 * advanced by arrows, ticks, keyboard or swipe.
	 *
	 * Enhancement only — without JavaScript the same markup is an ordinary list
	 * of every letter, so nothing is locked behind the control.
	 *
	 * There is no timer on purpose. These are paragraphs, and sliding one out
	 * from under a reader mid-sentence is hostile; the motion lives in the
	 * shuffle rather than in an autoplay.
	 */
	function initLetterDeck() {
		var deck = document.querySelector( '[data-sc-deck]' );

		if ( ! deck ) {
			return;
		}

		var stack = deck.querySelector( '.sc-deck__stack' );
		var cards = Array.prototype.slice.call( deck.querySelectorAll( '[data-sc-deck-card]' ) );
		var ticks = Array.prototype.slice.call( deck.querySelectorAll( '[data-sc-deck-tick]' ) );
		var prev = deck.querySelector( '[data-sc-deck-prev]' );
		var next = deck.querySelector( '[data-sc-deck-next]' );
		var counter = deck.querySelector( '[data-sc-deck-current]' );

		if ( ! stack || cards.length < 2 || ! prev || ! next ) {
			return;
		}

		var index = 0;

		// Once enhanced every card is absolutely positioned and stretched to fill
		// the stack, so measuring one then just reports the stack's own height
		// back. Drop out of the enhanced layout for the single reflow it takes to
		// read the active letter, then restore it. Caching all the heights up
		// front was fragile: any re-measure after fonts loaded or the window
		// resized captured the stretched value and pinned every letter to it.
		var fit = function () {
			var enhanced = deck.classList.contains( 'is-enhanced' );

			if ( enhanced ) {
				deck.classList.remove( 'is-enhanced' );
			}

			var height = cards[ index ] ? cards[ index ].offsetHeight : 0;

			if ( enhanced ) {
				deck.classList.add( 'is-enhanced' );
			}

			if ( height ) {
				stack.style.setProperty( '--sc-deck-height', height + 'px' );
			}
		};

		var pad = function ( n ) {
			return n < 10 ? '0' + n : String( n );
		};

		var show = function ( to ) {
			index = ( to + cards.length ) % cards.length;

			cards.forEach( function ( card, i ) {
				// Distance forward from the front card, wrapping round.
				var pos = ( i - index + cards.length ) % cards.length;

				card.setAttribute( 'data-sc-deck-pos', pos );
				card.setAttribute( 'aria-hidden', pos === 0 ? 'false' : 'true' );
			} );

			ticks.forEach( function ( tick, i ) {
				if ( i === index ) {
					tick.setAttribute( 'aria-current', 'true' );
				} else {
					tick.removeAttribute( 'aria-current' );
				}
			} );

			if ( counter ) {
				counter.textContent = pad( index + 1 );
			}

			fit();
		};

		prev.addEventListener( 'click', function () {
			show( index - 1 );
		} );

		next.addEventListener( 'click', function () {
			show( index + 1 );
		} );

		ticks.forEach( function ( tick, i ) {
			tick.addEventListener( 'click', function () {
				show( i );
			} );
		} );

		// Clicking a card that is behind brings it forward.
		cards.forEach( function ( card, i ) {
			card.addEventListener( 'click', function () {
				if ( card.getAttribute( 'data-sc-deck-pos' ) !== '0' ) {
					show( i );
				}
			} );
		} );

		deck.addEventListener( 'keydown', function ( event ) {
			if ( event.key === 'ArrowLeft' ) {
				event.preventDefault();
				show( index - 1 );
			} else if ( event.key === 'ArrowRight' ) {
				event.preventDefault();
				show( index + 1 );
			}
		} );

		// Swipe, for the touch screens where the arrows sit furthest from a thumb.
		var startX = null;

		stack.addEventListener( 'pointerdown', function ( event ) {
			startX = event.clientX;
		} );

		stack.addEventListener( 'pointerup', function ( event ) {
			if ( null === startX ) {
				return;
			}

			var dx = event.clientX - startX;

			startX = null;

			if ( Math.abs( dx ) > 46 ) {
				show( dx < 0 ? index + 1 : index - 1 );
			}
		} );

		window.addEventListener( 'resize', fit );

		// Web fonts land after first paint and change how tall the letters run.
		if ( document.fonts && document.fonts.ready ) {
			document.fonts.ready.then( fit );
		}

		deck.classList.add( 'is-enhanced' );
		show( 0 );
	}

	/**
	 * The Momentum Buzz deck: one win at a time, advanced by arrows, keyboard
	 * or swipe. No timer — these are paragraphs, and sliding one out from under
	 * a reader mid-sentence is hostile.
	 *
	 * Enhancement only — without JavaScript the same markup is an ordinary list
	 * of every win, so nothing is locked behind the control.
	 */
	function initBuzzDeck() {
		var deck = document.querySelector( '[data-sc-buzz-deck]' );

		if ( ! deck ) {
			return;
		}

		var stage = deck.querySelector( '[data-sc-buzz-stage]' );
		var slides = Array.prototype.slice.call( deck.querySelectorAll( '[data-sc-buzz-slide]' ) );
		var prev = deck.querySelector( '[data-sc-buzz-prev]' );
		var next = deck.querySelector( '[data-sc-buzz-next]' );
		var counter = deck.querySelector( '[data-sc-buzz-current]' );

		if ( ! stage || slides.length < 2 || ! prev || ! next ) {
			return;
		}

		var index = 0;

		var pad = function ( n ) {
			return n < 10 ? '0' + n : String( n );
		};

		var show = function ( to ) {
			index = ( to + slides.length ) % slides.length;

			slides.forEach( function ( slide, i ) {
				slide.classList.toggle( 'is-active', i === index );
				slide.setAttribute( 'aria-hidden', i === index ? 'false' : 'true' );
			} );

			if ( counter ) {
				counter.textContent = pad( index + 1 );
			}
		};

		prev.addEventListener( 'click', function () {
			show( index - 1 );
		} );

		next.addEventListener( 'click', function () {
			show( index + 1 );
		} );

		deck.setAttribute( 'tabindex', '0' );

		deck.addEventListener( 'keydown', function ( event ) {
			if ( event.key === 'ArrowLeft' ) {
				event.preventDefault();
				show( index - 1 );
			} else if ( event.key === 'ArrowRight' ) {
				event.preventDefault();
				show( index + 1 );
			}
		} );

		/* Swipe, for touch screens where the arrows sit furthest from a thumb. */
		var startX = null;

		stage.addEventListener( 'pointerdown', function ( event ) {
			startX = event.clientX;
		} );

		stage.addEventListener( 'pointerup', function ( event ) {
			if ( null === startX ) {
				return;
			}

			var dx = event.clientX - startX;

			startX = null;

			if ( Math.abs( dx ) > 46 ) {
				show( dx < 0 ? index + 1 : index - 1 );
			}
		} );

		deck.classList.add( 'is-enhanced' );
		show( 0 );
	}

	/**
	 * Light/dark theme toggle.
	 *
	 * The no-flash script in header.php sets the initial data-sc-theme attribute
	 * before first paint. Here we sync every toggle button's aria-pressed state
	 * to the current theme, reveal the buttons (they start hidden so a no-JS
	 * visitor never sees a dead control), and wire the click handler to flip
	 * the attribute and persist the choice in localStorage.
	 */
	function initThemeToggle() {
		var root = document.documentElement;
		var toggles = document.querySelectorAll( '[data-sc-theme-toggle]' );

		if ( ! toggles.length ) {
			return;
		}

		function current() {
			return root.getAttribute( 'data-sc-theme' ) === 'dark' ? 'dark' : 'light';
		}

		function sync() {
			var isDark = current() === 'dark';
			toggles.forEach( function ( btn ) {
				btn.setAttribute( 'aria-pressed', isDark ? 'true' : 'false' );
				btn.hidden = false;
			} );
		}

		sync();

		toggles.forEach( function ( btn ) {
			btn.addEventListener( 'click', function () {
				var next = current() === 'dark' ? 'light' : 'dark';
				root.setAttribute( 'data-sc-theme', next );
				try { localStorage.setItem( 'sc-theme', next ); } catch ( e ) {}
				sync();
			} );
		} );
	}

	/**
	 * Render every ™ as a small raised mark, and mark the four protected product names consistently.
	 * ponytail: done in one DOM pass instead of editing ~80 content strings;
	 * with JS off the ™ still shows, just full size.
	 */
	function initTrademarks() {
		var skip = /^(SCRIPT|STYLE|TEXTAREA|CODE|PRE)$/;
		var walker = document.createTreeWalker( document.body, NodeFilter.SHOW_TEXT, {
			acceptNode: function ( node ) {
				if ( node.parentNode.closest( '.sc-tm' ) || skip.test( node.parentNode.nodeName ) ) {
					return NodeFilter.FILTER_REJECT;
				}
				return /\u2122|Success Circles|Momentum (?:Labs|Buddy|OS)/.test( node.nodeValue ) ? NodeFilter.FILTER_ACCEPT : NodeFilter.FILTER_REJECT;
			}
		} );
		var nodes = [];
		while ( walker.nextNode() ) {
			nodes.push( walker.currentNode );
		}
		nodes.forEach( function ( node ) {
			var html = node.nodeValue
				.replace( /[&<>]/g, function ( c ) {
					return { '&': '&amp;', '<': '&lt;', '>': '&gt;' }[ c ];
				} )
				.replace( /\b(Success Circles|Momentum Labs|Momentum Buddy|Momentum OS)\b(?!\s*\u2122)/g, '$1\u2122' )
				.replace( /\u2122/g, '<sup class="sc-tm">\u2122</sup>' );
			var span = document.createElement( 'span' );
			span.innerHTML = html;
			node.parentNode.replaceChild( span, node );
		} );
	}

	// Progressive enhancement keeps native playback available without JavaScript.
	function initPodcastLibrary() {
		function clock(seconds) {
			seconds = Math.max(0, Math.floor(seconds || 0));
			return Math.floor(seconds / 60) + ':' + String(seconds % 60).padStart(2, '0');
		}
		document.querySelectorAll('.sc-podcast-episode').forEach(function (card) {
			var audio = card.querySelector('audio');
			var controls = card.querySelector('.sc-audio');
			if (!audio || !controls) { return; }
			var toggle = controls.querySelector('button');
			var seek = controls.querySelector('input');
			var elapsed = controls.querySelector('.sc-audio__elapsed');
			var duration = controls.querySelector('.sc-audio__duration');
			var status = controls.querySelector('.sc-audio__status');
			var title = audio.getAttribute('aria-label');
			var parts = duration.textContent.trim().split(':');
			var total = parts.reduce(function (sum, part) { return sum * 60 + Number(part); }, 0);
			if (Number.isFinite(total) && total > 0) { duration.textContent = clock(total); }
			controls.hidden = false;
			audio.hidden = true;
			audio.controls = false;
			function update() {
				var playing = !audio.paused && !audio.ended;
				card.classList.toggle('is-playing', playing);
				toggle.setAttribute('aria-label', (playing ? 'Pause ' : 'Play ') + title);
				toggle.setAttribute('aria-pressed', String(playing));
				elapsed.textContent = clock(audio.currentTime);
				if (Number.isFinite(audio.duration) && audio.duration > 0) {
					seek.disabled = false;
					seek.value = audio.currentTime / audio.duration * 100;
					seek.style.setProperty('--progress', seek.value + '%');
					seek.setAttribute('aria-valuetext', clock(audio.currentTime) + ' of ' + clock(audio.duration));
					duration.textContent = clock(audio.duration);
				}
			}
			toggle.addEventListener('click', function () {
				if (!audio.paused) { audio.pause(); return; }
				status.textContent = 'Loading episode…';
				audio.play().catch(function () { status.textContent = 'Unable to play. Try again or listen on Spotify.'; update(); });
			});
			seek.addEventListener('input', function () {
				if (Number.isFinite(audio.duration)) { audio.currentTime = seek.value / 100 * audio.duration; update(); }
			});
			audio.addEventListener('play', function () {
				document.querySelectorAll('.sc-podcast-episode audio').forEach(function (other) { if (other !== audio) { other.pause(); } });
				update();
			});
			audio.addEventListener('playing', function () { status.textContent = ''; });
			audio.addEventListener('error', function () { status.textContent = 'Unable to play. Try again or listen on Spotify.'; });
			['pause', 'ended', 'timeupdate', 'loadedmetadata'].forEach(function (event) { audio.addEventListener(event, update); });
		});
	}

	function init() {
		initPodcastLibrary();
		initLoader();
		initMenu();
		initStoryVideo();
		initMomentumOs();
		initReviews();
		initArticle();
		initQuiz();
		initJvChapters();
		initRhythmReveal();
		initRollCall();
		initLetterDeck();
		initBuzzDeck();
		initThemeToggle();
		initTrademarks();
	}

	if ( document.readyState !== 'loading' ) {
		init();
	} else {
		document.addEventListener( 'DOMContentLoaded', init );
	}
}() );
