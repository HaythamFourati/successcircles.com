<?php
/**
 * Homepage content.
 *
 * Every string from the 2026 redesign lives here so copy can be edited in one
 * place without touching markup. Values are read with successcircles_content()
 * using dot notation, e.g. successcircles_content( 'hero.title' ).
 *
 * Customizer settings (prices, phone, CTA URLs) override the matching keys —
 * see inc/customizer.php.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

/**
 * The full homepage content tree.
 *
 * @return array<string, mixed>
 */
function successcircles_content_tree() {
	static $tree = null;

	if ( null !== $tree ) {
		return $tree;
	}

	$tree = array(

		'loader' => array(
			'label' => __( 'Powered by Momentum OS', 'successcircles' ),
		),

		'nav' => array(
			array(
				'label'    => __( 'Programs', 'successcircles' ),
				'url'      => '#programs',
				'children' => array(
					array(
						'label' => __( 'Momentum Braintrust Buddy', 'successcircles' ),
						'url'   => '/momentum-buddy/',
					),
					array(
						'label' => __( 'Momentum Labs', 'successcircles' ),
						'url'   => '/momentum-labs/',
					),
					array(
						'label' => __( 'Momentum Team', 'successcircles' ),
						'url'   => '/momentum-team/',
					),
				),
			),
			array(
				'label' => __( 'How It Works', 'successcircles' ),
				'url'   => '#system',
			),
			array(
				'label'    => __( 'Success Stories', 'successcircles' ),
				'url'      => '/testimonials/',
				'children' => array(
					array(
						'label' => __( 'Testimonials', 'successcircles' ),
						'url'   => '/testimonials/',
					),
					array(
						'label' => __( 'Momentum Buzz', 'successcircles' ),
						'url'   => '/weekly-wins/',
					),
				),
			),
			array(
				'label' => __( 'Podcast', 'successcircles' ),
				'url'   => '/rules-for-success/',
			),
			array(
				'label'    => __( 'About', 'successcircles' ),
				'url'      => '/about/',
				'children' => array(
					array(
						'label' => __( 'Core Values', 'successcircles' ),
						'url'   => '/about/',
					),
					array(
						'label' => __( 'Joseph Varghese', 'successcircles' ),
						'url'   => '/about-joseph-varghese/',
					),
					array(
						'label' => __( 'FAQ', 'successcircles' ),
						'url'   => '/faq/',
					),
				),
			),
			array(
				'label' => __( 'Contact', 'successcircles' ),
				'url'   => '/contact-us/',
			),
		),

		'hero' => array(
			'eyebrow'       => __( 'Peer execution system for entrepreneurs', 'successcircles' ),
			'title'         => __( 'Run your business<br>with <em class="sc-accent">peers</em>, not alone.', 'successcircles' ),
			'lede'          => __( 'Information is abundant. Execution is scarce. SuccessCircles gives established business owners the peers, structure, and accountability that turn intentions into weekly momentum.', 'successcircles' ),
			'primary_cta'   => __( 'Take the Entrepreneur Test', 'successcircles' ),
			'secondary_cta' => __( 'Explore Momentum Buddy', 'successcircles' ),
			'meta'          => array(
				__( '20 years in business', 'successcircles' ),
				__( 'Weekday huddles', 'successcircles' ),
				__( 'Application only', 'successcircles' ),
			),
			'image_alt'     => __( 'Two entrepreneurs in a working conversation', 'successcircles' ),
			'badge_label'   => __( 'Today&rsquo;s huddle', 'successcircles' ),
			'badge_text'    => __( 'One priority. One peer. Fifteen minutes.', 'successcircles' ),
		),

		'trust' => array(
			'label' => __( 'As seen in', 'successcircles' ),
			'logos' => array(
				array(
					'src'  => 'https://commons.wikimedia.org/wiki/Special:FilePath/Inc._(business_magazine)_logo.svg',
					'alt'  => __( 'Inc.', 'successcircles' ),
					'note' => '',
				),
				array(
					'src'  => 'https://commons.wikimedia.org/wiki/Special:FilePath/Trustpilot_Logo_(2022).svg',
					'alt'  => __( 'Trustpilot', 'successcircles' ),
					'note' => __( 'Rated Excellent', 'successcircles' ),
				),
			),
			'names' => array(
				array(
					'name' => __( 'Michael Gerber,', 'successcircles' ),
					'note' => __( 'The E-Myth', 'successcircles' ),
				),
				array(
					'name' => __( 'Blair Singer,', 'successcircles' ),
					'note' => __( 'Rich Dad Advisor', 'successcircles' ),
				),
			),
		),

		'problem' => array(
			'index'   => '01',
			'eyebrow' => __( 'The problem', 'successcircles' ),
			'title'   => __( 'Success gets lonely <br>at the top.', 'successcircles' ),
			'items'   => array(
				array(
					'title' => __( 'Nobody around you is a true peer', 'successcircles' ),
					'text'  => __( 'Employees, family, and vendors can&rsquo;t give you objective feedback at your level. So the hardest decisions get made alone.', 'successcircles' ),
				),
				array(
					'title' => __( 'You know what to do. It doesn&rsquo;t get done', 'successcircles' ),
					'text'  => __( 'The highest-leverage priority slips a week, then a quarter. Not for lack of knowledge &mdash; for lack of a forcing function.', 'successcircles' ),
				),
				array(
					'title' => __( 'No one holds the owner accountable', 'successcircles' ),
					'text'  => __( 'You hold everyone else to a standard. Your own commitments are the only ones with no deadline and no witness.', 'successcircles' ),
				),
				array(
					'title' => __( 'Everything is urgent, so nothing compounds', 'successcircles' ),
					'text'  => __( 'Busy is easy. Progress is the thing you can name at the end of the week &mdash; and most weeks, you can&rsquo;t.', 'successcircles' ),
				),
			),
		),

		'system' => array(
			'index'   => '02',
			'eyebrow' => __( 'The system', 'successcircles' ),
			'title'   => __( 'Powered by <br><span class="sc-accent">Momentum OS</span>', 'successcircles' ),
			'lede'    => __( 'Momentum OS is the repeatable loop our members run every week. It&rsquo;s not a course or a framework you read once &mdash; it&rsquo;s the operating rhythm that peers, structure, and repetition make possible.', 'successcircles' ),
			'formula' => array(
				__( 'Peers', 'successcircles' ),
				__( 'Structure', 'successcircles' ),
				__( 'Accountability', 'successcircles' ),
				__( 'Repetition', 'successcircles' ),
			),
			'result'  => __( 'Momentum', 'successcircles' ),
			'steps'   => array(
				array(
					'title' => __( 'Clarify', 'successcircles' ),
					'text'  => __( 'Name the one priority that actually moves the business this week.', 'successcircles' ),
					'alpha' => '1',
				),
				array(
					'title' => __( 'Commit', 'successcircles' ),
					'text'  => __( 'Say it out loud to a peer who will ask you about it by name.', 'successcircles' ),
					'alpha' => '0.8',
				),
				array(
					'title' => __( 'Huddle', 'successcircles' ),
					'text'  => __( 'A short structured conversation on a weekday rhythm you keep.', 'successcircles' ),
					'alpha' => '0.65',
				),
				array(
					'title' => __( 'Execute', 'successcircles' ),
					'text'  => __( 'Do the work between huddles, with the deadline already public.', 'successcircles' ),
					'alpha' => '0.5',
				),
				array(
					'title' => __( 'Reflect', 'successcircles' ),
					'text'  => __( 'What worked, what didn&rsquo;t, and what the evidence says to change.', 'successcircles' ),
					'alpha' => '0.35',
				),
				array(
					'title' => __( 'Compound', 'successcircles' ),
					'text'  => __( 'Run it again. The loop is where momentum stops being a mood.', 'successcircles' ),
					'alpha' => '0.2',
				),
			),
		),

		'programs' => array(
			'index'   => '03',
			'eyebrow' => __( 'Programs', 'successcircles' ),
			'title'   => __( 'Three ways in. Same <br>operating rhythm.', 'successcircles' ),
			'lede'    => __( 'One is a peer who knows your business by name. One is a room of operators who&rsquo;ve solved your problem before. One is a 90-day cohort that rebuilds how the work gets done. Most members start with one and add another.', 'successcircles' ),
			'cards'   => array(
				array(
					'featured' => true,
					'kind'     => __( 'One-to-one', 'successcircles' ),
					'price'    => '$194',
					'title'    => __( 'Momentum Braintrust Buddy', 'successcircles' ),
					'flag'     => __( 'Most members start here', 'successcircles' ),
					'text'     => __( 'Structured one-to-one peer accountability. Matched intentionally, huddling on weekdays, in roughly two-week cycles so you meet a range of strong peers over time.', 'successcircles' ),
					'features' => array(
						__( 'Intentional peer matching', 'successcircles' ),
						__( 'Recurring weekday huddles', 'successcircles' ),
						__( 'Priorities, commitments, course correction', 'successcircles' ),
						__( 'Full SuccessCircles community access', 'successcircles' ),
					),
					'cta'      => __( 'Explore Momentum Buddy', 'successcircles' ),
					'cta_url'  => '/momentum-buddy/',
				),
				array(
					'featured' => false,
					'kind'     => __( 'Group', 'successcircles' ),
					'price'    => '$97',
					'title'    => __( 'Momentum Labs', 'successcircles' ),
					'flag'     => '',
					'text'     => __( 'Group execution and collaborative peer intelligence. Group huddles, strategic sprints, and a braintrust of operators who bring perspectives you don&rsquo;t have.', 'successcircles' ),
					'features' => array(
						__( 'Group huddles', 'successcircles' ),
						__( 'Strategic sprints', 'successcircles' ),
						__( 'Collaborative problem solving', 'successcircles' ),
						__( 'Community and shared resources', 'successcircles' ),
					),
					'cta'      => __( 'Explore Momentum Labs', 'successcircles' ),
					'cta_url'  => '/momentum-labs/',
				),
				array(
					'featured' => false,
					'kind'     => __( 'Cohort', 'successcircles' ),
					'price'    => '$797',
					'title'    => __( 'Momentum Team', 'successcircles' ),
					'flag'     => __( '90-day AI accelerator', 'successcircles' ),
					'text'     => __( 'A 90-day cohort for owners moving from running the operation to leading it &mdash; an advisory board of elite entrepreneurs, weekly huddles, and AI systems that take the work off your desk.', 'successcircles' ),
					'features' => array(
						__( 'Personal advisory board of entrepreneurs', 'successcircles' ),
						__( 'Personalised daily AI coach', 'successcircles' ),
						__( 'Three one-to-one Momentum coach calls', 'successcircles' ),
						__( 'AI mastery training and implementation', 'successcircles' ),
					),
					'cta'      => __( 'Explore Momentum Team', 'successcircles' ),
					'cta_url'  => '/momentum-team/',
				),
			),
			'note'     => array(
				'before' => __( 'Not sure which fits?', 'successcircles' ),
				'link'   => __( 'The Entrepreneur Test', 'successcircles' ),
				'after'  => __( 'points you to one in about five minutes.', 'successcircles' ),
			),
			'includes' => array(
				array(
					'title' => __( 'Every membership includes', 'successcircles' ),
					'text'  => __( 'Immediate access to $10,000 in member resources on peak performance, energy management, delegation, focus, and automation.', 'successcircles' ),
				),
				array(
					'title' => __( 'Your cadence, your call', 'successcircles' ),
					'text'  => __( 'Huddle every weekday morning, or three days a week on Mondays, Wednesdays, and Fridays. Faith-based matching on request.', 'successcircles' ),
				),
				array(
					'title' => __( '30-day guarantee', 'successcircles' ),
					'text'  => __( 'Two full partnership cycles. If you&rsquo;re unhappy with your results for any reason, we refund your investment.', 'successcircles' ),
				),
			),
		),

		'process' => array(
			'index'   => '04',
			'eyebrow' => __( 'How it works', 'successcircles' ),
			'title'   => __( 'From application to compounding progress.', 'successcircles' ),
			'steps'   => array(
				array(
					'title' => __( 'Tell us the goal', 'successcircles' ),
					'text'  => __( 'A brief application, then a facilitator reaches out to confirm this is the right fit before anything starts.', 'successcircles' ),
					'alpha' => '1',
				),
				array(
					'title' => __( 'Get matched', 'successcircles' ),
					'text'  => __( 'A short intro questionnaire on your situation, strengths, and 90-day goals drives the match. Buddies rotate every two weeks, four at most.', 'successcircles' ),
					'alpha' => '0.75',
				),
				array(
					'title' => __( 'Huddle and execute', 'successcircles' ),
					'text'  => __( 'Weekday huddles keep the priority named, the commitment public, and the week honest.', 'successcircles' ),
					'alpha' => '0.5',
				),
				array(
					'title' => __( 'Compound momentum', 'successcircles' ),
					'text'  => __( 'Cycles repeat, peers rotate, and the standard you hold yourself to keeps moving up.', 'successcircles' ),
					'alpha' => '0.28',
				),
			),
		),

		'stories' => array(
			'index'         => '05',
			'eyebrow'       => __( 'Success stories', 'successcircles' ),
			'title'         => __( 'Members who stopped <br>deciding alone.', 'successcircles' ),
			'links'         => array(
				array(
					'label' => __( 'See all success stories', 'successcircles' ),
					'url'   => '/testimonials/',
				),
				array(
					'label' => __( 'Momentum Buzz &mdash; member wins', 'successcircles' ),
					'url'   => '/weekly-wins/',
				),
			),
			'video'         => array(
				'embed_url'  => 'https://player.vimeo.com/video/870306260?title=0&byline=0&portrait=0&autoplay=1',
				'title'      => __( 'Dare to play a bigger game', 'successcircles' ),
				'duration'   => __( '2 min', 'successcircles' ),
				'poster_alt' => __( 'Joseph Varghese, founder of SuccessCircles', 'successcircles' ),
			),
			'feature_quote' => array(
				'text' => __( 'I just had my breakthrough VIP session with Joseph. Learning about Success Circles was very exciting to me. They have created something unique and affordable that brings tremendous value to business owners. Joseph was so generous and giving of his time that I signed up without him ever asking me to join. This was exactly what I was looking for.', 'successcircles' ),
				'name' => __( 'H. William Song', 'successcircles' ),
				'role' => __( 'Member', 'successcircles' ),
			),
			'quotes'        => array(
				array(
					'text' => __( 'Success Circles is an amazing experience like no other. I found out things about myself that I did not know, by simply talking my self to my buddy. Having an accountability buddy gets you in the right momentum to succeed. What an incredible program and experience.', 'successcircles' ),
					'name' => __( 'Andy Zapata', 'successcircles' ),
					'role' => __( 'Member', 'successcircles' ),
				),
				array(
					'text' => __( 'Being a part of the Success Circles community is sooo amazing! I am so appreciative of what Joseph and the Success Circles Team are doing! As a subject matter expert in the small business space, it is critical that I have someone to hold me accountable in MY daily activities. I am honored and blessed to be connected with such a dynamic community!!!', 'successcircles' ),
					'name' => __( 'Robin Haynes', 'successcircles' ),
					'role' => __( 'Small business expert', 'successcircles' ),
				),
			),
		),

		'test' => array(
			'index'   => '06',
			'eyebrow' => __( 'The Entrepreneur Test', 'successcircles' ),
			'title'   => __( 'Are you running your business&mdash;or is it running you?', 'successcircles' ),
			'lede'    => __( 'A serious diagnostic for established owners. Twelve questions on ownership, focus, and execution &mdash; then a straight read on where the leak is and which program addresses it.', 'successcircles' ),
			'cta'     => __( 'Take the Entrepreneur Test', 'successcircles' ),
			'note'    => __( '5 minutes', 'successcircles' ),
		),

		'founder' => array(
			'index'         => '07',
			'eyebrow'       => __( 'Founder', 'successcircles' ),
			'name'          => __( 'Joseph JV Varghese', 'successcircles' ),
			'portrait'      => SUCCESSCIRCLES_URI . '/assets/img/founder-portrait.png',
			'portrait_alt'  => __( 'Joseph Varghese, founder of Success Circles', 'successcircles' ),
			'signature'     => SUCCESSCIRCLES_URI . '/assets/img/founder-signature.png',
			'signature_alt' => __( 'Signature of Joseph Varghese', 'successcircles' ),
			'bio'           => __( 'Joseph started SuccessCircles in 2005 on a simple observation: the owners who kept their commitments weren&rsquo;t more disciplined &mdash; they were less alone. An engineer by training, he built the structure around that.', 'successcircles' ),
			'bio_secondary' => __( 'Two decades later, Momentum OS is what came out of it &mdash; and a community of owners who run it, not a coaching practice of one.', 'successcircles' ),
			'link'          => array(
				'label' => __( 'Meet Joseph', 'successcircles' ),
				'url'   => '/about-joseph-varghese/',
			),
		),

		'podcast' => array(
			'index'    => '08',
			'eyebrow'  => __( 'Rules for Success', 'successcircles' ),
			'title'    => __( 'Success leaves clues.', 'successcircles' ),
			'link'     => array(
				'label' => __( 'All episodes', 'successcircles' ),
				'url'   => '/rules-for-success/',
			),
			'empty'    => __( 'The first episodes are being recorded. Check back shortly.', 'successcircles' ),
		),

		'faq' => array(
			'index'   => '08',
			'eyebrow' => __( 'Questions', 'successcircles' ),
			'title'   => __( 'The ones owners <br>actually ask.', 'successcircles' ),
			'link'    => array(
				'label' => __( 'Read the full FAQ', 'successcircles' ),
				'url'   => '/faq/',
			),
			'items'   => array(
				array(
					'question' => __( 'How often do I get a new buddy?', 'successcircles' ),
					'answer'   => __( 'Buddies are assigned bi-monthly, with a maximum of two cycles &mdash; four weeks &mdash; with the same partner. Fresh feedback from different peers is what breaks the plateau.', 'successcircles' ),
				),
				array(
					'question' => __( 'How do you know my buddy is the right fit?', 'successcircles' ),
					'answer'   => __( 'We match on goals and strengths: if another member is strong where you want to grow, or has already reached the goal you&rsquo;re aiming at, we pair you. Members rate each experience and can request a specific buddy.', 'successcircles' ),
				),
				array(
					'question' => __( 'Why peers instead of a coach?', 'successcircles' ),
					'answer'   => __( 'Because a peer is on the same playing field. You stay autonomous in your decisions, and you contribute as much as you receive. Research points to peer accountability as the strongest driver of performance.', 'successcircles' ),
				),
				array(
					'question' => __( 'What if it doesn&rsquo;t work for me?', 'successcircles' ),
					'answer'   => __( 'You have a 30-day trial &mdash; two partnership cycles. Unhappy with your results for any reason, and we refund your investment.', 'successcircles' ),
				),
			),
		),

		'faq_page' => array(
			'eyebrow' => __( 'Frequently asked questions', 'successcircles' ),
			'title'   => __( 'Everything owners <em class="sc-accent">actually</em> ask.', 'successcircles' ),
			'lede'    => __( 'SuccessCircles is a results-driven peer momentum, braintrust, and execution system for high-achieving entrepreneurs &mdash; a structured, and genuinely fun, way to take daily action, stay focused, and accelerate. Here is how it works, and what to expect.', 'successcircles' ),
			'groups'  => array(
				array(
					'label' => __( 'The system', 'successcircles' ),
					'items' => array(
						array(
							'question' => __( 'What are the benefits of joining SuccessCircles?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'As a member, you will:', 'successcircles' ) ),
								array(
									'list' => array(
										__( 'Turn action into a game &mdash; execution becomes fun when you&rsquo;re part of a system that rewards progress.', 'successcircles' ),
										__( 'Gain unstoppable momentum &mdash; move the needle forward daily with braintrust and peer momentum.', 'successcircles' ),
										__( 'Increase profitability and impact &mdash; consistently execute on your biggest opportunities.', 'successcircles' ),
										__( 'Simplify your focus &mdash; stop spinning your wheels and focus on what truly matters.', 'successcircles' ),
										__( 'Build sustainable habits &mdash; small daily improvements compound into massive long-term gains.', 'successcircles' ),
										__( 'Never feel isolated &mdash; be part of a powerful braintrust and community that lifts you up.', 'successcircles' ),
										__( 'Grow in confidence &mdash; from stacking positive references of success and having clarity of purpose.', 'successcircles' ),
										__( 'Get immediate access to $10,000 in resources for peak performance, energy management, delegation, focus, and automation on joining the Momentum Braintrust Buddy Action program.', 'successcircles' ),
									),
								),
							),
						),
						array(
							'question' => __( 'How does it work?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'We combine Braintrust Partnerships, daily Momentum (Braintrust) Buddy calls, and optional group huddles to help you set clear intentions and take massive action. Each call aligns your focus on wins, priorities, and course corrections &mdash; so you stay on track and keep leveling up.', 'successcircles' ) ),
								array( 'p' => __( 'Success isn&rsquo;t a straight path; it&rsquo;s about consistently adapting and optimizing. With regular feedback and structured momentum, you reach your goals faster and with far greater ease.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'What makes SuccessCircles sustainable?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'Our system is built around a proprietary question-and-answer framework that keeps you engaged and focused. Instead of passive learning, we emphasize execution and real-world results. Unlike traditional coaching or mastermind groups, this is hands-on, action-driven, and fun &mdash; where taking purposeful action is the priority.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'How does this improve time management and productivity?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'Through our process, you&rsquo;ll:', 'successcircles' ) ),
								array(
									'list' => array(
										__( 'Master delegation, focus, and time management with proven tools and strategies.', 'successcircles' ),
										__( 'Turn distractions into clarity &mdash; cut through noise and focus on high-impact actions.', 'successcircles' ),
										__( 'Leverage accountability for consistency &mdash; stay aligned with your top goals every day.', 'successcircles' ),
										__( 'Create freedom through structure &mdash; the right systems let you scale without burnout.', 'successcircles' ),
									),
								),
								array( 'p' => __( 'Instead of just being &ldquo;busy,&rdquo; you become strategically productive, moving toward your biggest outcomes.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'I think I have Attention Deficiency Disorder. Will this help?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'Before joining, many members experienced high levels of what they called ADD &mdash; difficulty focusing on one thing, trouble staying on a subject, unfinished tasks, poor follow-through, and the inability to hold a habit until it becomes consistent. If that sounds familiar, the SuccessCircles process is the ultimate means of maintaining focus &mdash; a quality that is paramount for success, and one these same members now embrace.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'This sounds complicated. Does it really work?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'Yes &mdash; if you&rsquo;re committed to results over reasons, it absolutely works. Once you begin, you&rsquo;ll find the program to be genuinely simple and very supportive in streamlining how you reach your goals. We&rsquo;ve been doing this for over ten years, with hundreds of success stories around the world.', 'successcircles' ) ),
								array( 'p' => __( 'We&rsquo;ve been acknowledged by top leaders in entrepreneurship &mdash; Michael Gerber of the E-Myth, Blair Singer of Rich Dad Poor Dad, and Inc. Magazine, among others.', 'successcircles' ) ),
							),
						),
					),
				),
				array(
					'label' => __( 'Your Momentum Buddy', 'successcircles' ),
					'items' => array(
						array(
							'question' => __( 'What is a Momentum (Braintrust) Buddy?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'Your Momentum Braintrust Buddy is your braintrust partner, matched to your goals and strengths. They:', 'successcircles' ) ),
								array(
									'list' => array(
										__( 'Challenge you to execute at your highest level.', 'successcircles' ),
										__( 'Help you break through roadblocks with insights and solutions.', 'successcircles' ),
										__( 'Keep you accountable so you maintain momentum.', 'successcircles' ),
										__( 'Encourage smart course corrections for maximum efficiency.', 'successcircles' ),
									),
								),
								array( 'p' => __( 'We pair you with someone complementary to your strengths, so both of you grow in the areas that matter.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'How often will I get a new Momentum Buddy?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'Buddies are assigned bi-monthly, with a maximum of two cycles &mdash; four weeks &mdash; with the same partner. Partnering with different members and getting fresh feedback is what breaks you through to real results. You can choose daily momentum calls each weekday morning, or three days a week (typically Monday, Wednesday, and Friday).', 'successcircles' ) ),
								array( 'p' => __( 'Assignments are based on your chosen level of accountability, drive for growth, and time availability. You can request a faith-based partner and we&rsquo;ll do our best to match you. Working on a specific area? We&rsquo;ll aim to pair you with a member strong there, or one who has already met a goal you&rsquo;re aiming for. Regular surveys let you rate the experience and request a particular buddy.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'How will I know my buddy can hold me accountable?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'We use a unique process to connect members as Momentum Braintrust Buddies. If another member is strong in an area you want to grow, we&rsquo;ll do our best to connect you. If someone has already reached a goal you&rsquo;re aiming for, you&rsquo;ll have the chance to learn their winning strategies. You&rsquo;ll also connect virtually with members around the world and can choose your own buddy &mdash; perspective goes a long way.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'What Peer Momentum services do you offer?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'SuccessCircles currently offers two primary services:', 'successcircles' ) ),
								array(
									'list' => array(
										__( 'Momentum Team 90-Day AI Incubator &mdash; our program where we play the 90-Day Year.', 'successcircles' ),
										__( 'Momentum Braintrust Buddy Action &mdash; daily accountability calls, generally one-on-one with a member a step ahead of you in an area you&rsquo;re committed to progressing.', 'successcircles' ),
									),
								),
								array( 'p' => __( 'As you move through different buddies within the huddle calls, you&rsquo;ll eventually select the ones who impacted you most &mdash; your first draft picks. If they select you too, we create a quarterly Dream Team to support your top five outcomes each month. The Circle of Five is an optional component for members seeking further feedback.', 'successcircles' ) ),
							),
						),
					),
				),
				array(
					'label' => __( 'Fit &amp; signing up', 'successcircles' ),
					'items' => array(
						array(
							'question' => __( 'I&rsquo;m not an entrepreneur. Can I still join?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'The majority of our members are entrepreneurs, but we have several who are between jobs or transitioning careers. Members who joined during a transition became significantly more engaged in their search and often credit SuccessCircles as the accelerating factor that got their career on track. We also have members who aren&rsquo;t entrepreneurs but have the flexibility to hold a consistent call three days a week.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'I&rsquo;m ready. How do I sign up?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'Sign up to see if you qualify for the network, and one of our facilitators will reach out to make sure it&rsquo;s the right fit. If you&rsquo;re unhappy with your results for any reason after the 30-day trial period &mdash; two partnership cycles &mdash; we&rsquo;ll gladly refund your investment.', 'successcircles' ) ),
							),
						),
					),
				),
			),
			'aside'   => array(
				'title' => __( 'Still have a question?', 'successcircles' ),
				'text'  => __( 'Talk to a facilitator and we&rsquo;ll help you figure out whether SuccessCircles is the right room for you.', 'successcircles' ),
				'link'  => array(
					'label' => __( 'Take the Entrepreneur Test', 'successcircles' ),
					'url'   => '#test',
				),
				'secondary' => array(
					'label' => __( 'Contact us', 'successcircles' ),
					'url'   => '/contact-us/',
				),
			),
		),

		'contact' => array(
			'eyebrow'  => __( 'Contact', 'successcircles' ),
			'title'    => __( 'Start with a <em class="sc-accent">conversation</em>.', 'successcircles' ),
			'lede'     => __( 'Call, book a slot, or send a note. A facilitator reads every message &mdash; not a queue, not a bot &mdash; and answers within one business day.', 'successcircles' ),
			'channels' => array(
				array(
					'label'  => __( 'Call or WhatsApp', 'successcircles' ),
					'value'  => __( '+1 (747) 2CIRCLE', 'successcircles' ),
					'detail' => __( '+1 (747) 224-7253', 'successcircles' ),
					'url'    => 'tel:+17472247253',
					'note'   => __( 'One number for calls and WhatsApp Business.', 'successcircles' ),
				),
				array(
					'label'  => __( 'Book a call', 'successcircles' ),
					'value'  => __( 'jv.zone', 'successcircles' ),
					'detail' => '',
					'url'    => 'http://jv.zone',
					'note'   => __( 'Twenty minutes with a facilitator. Pick any open slot.', 'successcircles' ),
				),
				array(
					'label'  => __( 'Visit', 'successcircles' ),
					'value'  => __( '290 5th Ave, 5th Floor', 'successcircles' ),
					'detail' => __( 'New York, NY 10001', 'successcircles' ),
					'url'    => 'https://g.page/successcircles',
					'note'   => __( 'Mail and meetings by appointment. The Circles run online.', 'successcircles' ),
				),
			),
			'steps'    => array(
				array(
					'title' => __( 'We read it', 'successcircles' ),
					'text'  => __( 'Every message lands with a facilitator, not a support queue.', 'successcircles' ),
				),
				array(
					'title' => __( 'We reply', 'successcircles' ),
					'text'  => __( 'Usually the same day, always within one business day.', 'successcircles' ),
				),
				array(
					'title' => __( 'We talk', 'successcircles' ),
					'text'  => __( 'If it looks like a fit, a short call comes before anything else.', 'successcircles' ),
				),
			),
			'form'     => array(
				'eyebrow' => __( 'Send a note', 'successcircles' ),
				'title'   => __( 'Tell us what you&rsquo;re working on.', 'successcircles' ),
				'lede'    => __( 'A sentence or two about your business and what you want to move is plenty. We&rsquo;ll take it from there.', 'successcircles' ),
				'name'    => __( 'Your name', 'successcircles' ),
				'email'   => __( 'Your email', 'successcircles' ),
				'phone'   => __( 'Your phone', 'successcircles' ),
				'optional' => __( 'optional', 'successcircles' ),
				'message' => __( 'Your message', 'successcircles' ),
				'submit'  => __( 'Send message', 'successcircles' ),
				'consent' => __( 'We use your details to answer you, and for nothing else.', 'successcircles' ),
			),
			'notices'  => array(
				'sent'      => __( 'Thank you &mdash; your message is on its way. Expect a reply within one business day.', 'successcircles' ),
				'invalid'   => __( 'Almost. Check the highlighted fields and send it again.', 'successcircles' ),
				'expired'   => __( 'That form sat open a while and its security token expired. Please send it once more.', 'successcircles' ),
				'throttled' => __( 'That one came through already. Give us a minute before sending another.', 'successcircles' ),
				'failed'    => __( 'The site could not send that message. Please call us, or email us directly.', 'successcircles' ),
			),
			'social'   => array(
				'label' => __( 'Follow along', 'successcircles' ),
			),
		),

		'cta' => array(
			'title'         => __( 'Dare to play a <em class="sc-accent">bigger</em> game.', 'successcircles' ),
			'lede'          => __( 'Start with the test. It takes five minutes and tells you which room you belong in.', 'successcircles' ),
			'primary_cta'   => __( 'Take the Entrepreneur Test', 'successcircles' ),
			'secondary_cta' => __( 'Compare the programs', 'successcircles' ),
		),

		'episodes' => array(
			'eyebrow' => __( 'Rules for Success', 'successcircles' ),
			'title'   => __( 'Success leaves clues.', 'successcircles' ),
			'lede'    => __( 'Conversations with founders, operators and advisors about the rules they actually run on &mdash; not the ones they put on a slide.', 'successcircles' ),
			'empty'   => __( 'New episodes are on the way.', 'successcircles' ),
		),

		// The Momentum Buzz page runs on the live Weekly Wins feed — see inc/wins.php.
		// Only the framing copy lives here; every quote comes from the source site.
		'buzz' => array(
			'eyebrow'    => __( 'Momentum Buzz', 'successcircles' ),
			'title'      => __( 'Wins, <em class="sc-accent">week</em> after week.', 'successcircles' ),
			'lede'       => __( 'Every week members post what actually moved &mdash; deals closed, habits held, ceilings broken. No case studies and no composite characters: these are the wins exactly as they were written.', 'successcircles' ),
			'wall_label' => __( 'Member wins', 'successcircles' ),
			'source'     => __( 'Pulled from successcircles.com', 'successcircles' ),
			'empty'      => __( 'Member wins are syncing from successcircles.com. Check back shortly.', 'successcircles' ),
			'link'       => array(
				'label' => __( 'Read the full testimonials', 'successcircles' ),
				'url'   => '/testimonials/',
			),
		),

		// The Joseph Varghese page. Copy transcribed verbatim from
		// successcircles.com/about-joseph-varghese/ — see §7g.
		'founder_page' => array(
			'eyebrow'  => __( 'Founder', 'successcircles' ),
			'title'    => __( 'About Joseph <em class="sc-accent">Varghese</em>.', 'successcircles' ),
			'roles'    => array(
				__( 'Founder of Success Circles', 'successcircles' ),
				__( 'The Breakthrough Engineer', 'successcircles' ),
				__( 'Momentum Architect', 'successcircles' ),
			),
			'lede'     => __( 'Joseph John Varghese is obsessed with one idea &mdash; success leaves clues and proximity is power. If you can model the habits, systems, and mindset of someone a few steps ahead, you can shortcut years of trial and error.', 'successcircles' ),
			'intro'    => array(
				__( 'That belief shaped his life&rsquo;s work.', 'successcircles' ),
				__( 'After years as an unfulfilled process engineer, Joseph witnessed the world&rsquo;s resilience and unity after 9/11. Inspired by people stepping up to help one another, he made it his mission to build ventures that amplify human potential through connection and execution.', 'successcircles' ),
			),
			'portrait' => array(
				'file'   => 'jv-portrait.png',
				'alt'    => __( 'Joseph Varghese, founder of SuccessCircles', 'successcircles' ),
				'width'  => 1200,
				'height' => 2000,
			),
			'plate'    => array(
				'file'   => 'jv-mastermind.jpg',
				'alt'    => __( 'Joseph Varghese leading a mastermind session', 'successcircles' ),
				'width'  => 2560,
				'height' => 1920,
			),
			'quote'    => __( 'If you can identify, simplify, and execute on the patterns of someone just a few steps ahead, progress is inevitable.', 'successcircles' ),
			'sections' => array(
				array(
					'title' => __( 'From Engineer to Momentum Architect', 'successcircles' ),
					'body'  => array(
						__( 'Between 2003 and 2005, Joseph launched Metrofly, a movement that merged nightlife, purpose, and philanthropy &mdash; raising money for New York nonprofits while connecting people for something bigger than themselves. That experience sparked his fascination with crowdsourcing success.', 'successcircles' ),
						__( 'By 2005, he founded Success Circles, a peer-momentum community built to help high level entrepreneurs stay focused, accountable, and on fire. He realized that while information was everywhere, execution was the missing link &mdash; and that accountability, structure, and rhythm could change everything.', 'successcircles' ),
						__( 'Success Circles also became an extension of the JV Alliance family office, established in the honor of Joseph&rsquo;s late father John Varghese who passed away in 2004.', 'successcircles' ),
						__( 'For over 20 years, Joseph has been immersed in the science of peak performance, productivity, and gamification. He calls himself The Breakthrough Engineer because he designs systems for clarity, freedom, and momentum &mdash; helping driven leaders turn vision into reality.', 'successcircles' ),
					),
				),
				array(
					'title' => __( 'Modeling Success in the AI Era', 'successcircles' ),
					'body'  => array(
						__( 'Today, Joseph combines his engineering background with AI-driven tools to help entrepreneurs work smarter, not harder. Through programs like the 90-Day Momentum Team&trade; Accelerator and the 3-Day AI Challenge, members learn to model others&rsquo; patterns, simplify systems, and execute consistently with the help of AI and peer support.', 'successcircles' ),
						__( 'Joseph is also a sought-after speaker who inspires audiences &mdash; from students to executives &mdash; to balance ambition with purpose and play. His message is simple: Momentum beats motivation.', 'successcircles' ),
					),
				),
				array(
					'title' => __( 'Mission &amp; Legacy', 'successcircles' ),
					'body'  => array(
						__( 'Through Success Circles, Joseph continues to connect entrepreneurs and professionals committed to growth, accountability, and impact. He calls this mission and his WHY G.I. Joseph &mdash; Generational Impact, a movement to create freedom, fulfillment, and fun for the next generation of owners and leaders.', 'successcircles' ),
					),
				),
			),
		),

		// The Testimonials page. Videos and quotes transcribed from
		// successcircles.com/testimonials/ — see §7f. Weekly member wins are a
		// separate page and a separate content block ('buzz').
		'testimonials' => array(
			'eyebrow'        => __( 'Success stories', 'successcircles' ),
			'title'          => __( 'In their <em class="sc-accent">own</em> words.', 'successcircles' ),
			'lede'           => __( 'Members of the Circles on what changed once they stopped deciding alone &mdash; on camera, and in writing.', 'successcircles' ),
			'films_eyebrow'  => __( 'On camera', 'successcircles' ),
			'films_title'    => __( 'Eleven members, in their own voice.', 'successcircles' ),
			'films_note'     => __( 'Nothing loads from Vimeo until you press play.', 'successcircles' ),
			'play_label'     => __( 'Play', 'successcircles' ),
			'written_eyebrow' => __( 'In writing', 'successcircles' ),
			'written_title'  => __( 'What members write to us.', 'successcircles' ),
			'link'           => array(
				'label' => __( 'Momentum Buzz &mdash; weekly member wins', 'successcircles' ),
				'url'   => '/weekly-wins/',
			),
			'videos'         => array(
				array(
					'id'       => '668470106',
					'name'     => __( 'Robert Grant', 'successcircles' ),
					'kind'     => __( 'Member story', 'successcircles' ),
					'duration' => '4:30',
					'poster'   => '668470106.jpg',
					'width'    => 1280,
					'height'   => 800,
				),
				array(
					'id'       => '699437524',
					'name'     => __( 'Tanya Straker', 'successcircles' ),
					'kind'     => __( 'Member story', 'successcircles' ),
					'duration' => '1:53',
					'poster'   => '699437524.jpg',
					'width'    => 1280,
					'height'   => 720,
				),
				array(
					'id'       => '561090138',
					'name'     => __( 'Alison Hemmings', 'successcircles' ),
					'kind'     => __( 'Case study', 'successcircles' ),
					'duration' => '5:40',
					'poster'   => '561090138.jpg',
					'width'    => 1280,
					'height'   => 720,
				),
				array(
					'id'       => '227501919',
					'name'     => __( 'Jeff McBride', 'successcircles' ),
					'kind'     => __( 'Member story', 'successcircles' ),
					'duration' => '2:23',
					'poster'   => '227501919.jpg',
					'width'    => 960,
					'height'   => 540,
				),
				array(
					'id'       => '344202259',
					'name'     => __( 'George Arroyo', 'successcircles' ),
					'kind'     => __( 'Member story', 'successcircles' ),
					'duration' => '4:59',
					'poster'   => '344202259.jpg',
					'width'    => 960,
					'height'   => 540,
				),
				array(
					'id'       => '858257750',
					'name'     => __( 'Kabir', 'successcircles' ),
					'kind'     => __( 'Member story', 'successcircles' ),
					'duration' => '2:01',
					'poster'   => '858257750.jpg',
					'width'    => 960,
					'height'   => 543,
				),
				array(
					'id'       => '457144641',
					'name'     => __( 'Ruth Dorsainville', 'successcircles' ),
					'kind'     => __( 'Case study', 'successcircles' ),
					'duration' => '16:59',
					'poster'   => '457144641.jpg',
					'width'    => 960,
					'height'   => 540,
				),
				array(
					'id'       => '292972577',
					'name'     => __( 'Elaine Williams', 'successcircles' ),
					'kind'     => __( 'Member story', 'successcircles' ),
					'duration' => '2:05',
					'poster'   => '292972577.jpg',
					'width'    => 960,
					'height'   => 540,
				),
				array(
					'id'       => '294165813',
					'name'     => __( 'Arvin Khamseh', 'successcircles' ),
					'kind'     => __( 'Member story', 'successcircles' ),
					'duration' => '1:51',
					'poster'   => '294165813.jpg',
					'width'    => 1280,
					'height'   => 720,
				),
				array(
					'id'       => '457023345',
					'name'     => __( 'David Vogel', 'successcircles' ),
					'kind'     => __( 'Member story', 'successcircles' ),
					'duration' => '5:25',
					'poster'   => '457023345.jpg',
					'width'    => 1280,
					'height'   => 720,
				),
				array(
					'id'       => '561469180',
					'name'     => __( 'Garth Sandiford', 'successcircles' ),
					'kind'     => __( 'Member story', 'successcircles' ),
					'duration' => '1:35',
					'poster'   => '561469180.jpg',
					'width'    => 960,
					'height'   => 543,
				),
			),
			'quotes'         => array(
				array(
					'name' => __( 'AJ Mihrzad', 'successcircles' ),
					'role' => __( 'The Online Super Coach', 'successcircles' ),
					'text' => __( 'Such a powerful program! I&rsquo;ve done many personal development programs in the past and this is one of the BEST! I Highly recommend Success Circles!', 'successcircles' ),
				),
				array(
					'name' => __( 'Stephanie Chin', 'successcircles' ),
					'role' => __( 'Singer / Songwriter', 'successcircles' ),
					'text' => __( 'I highly recommend working with Success Circles. Here are some of the results I experienced in my time with them: &ndash; I&rsquo;ve stepped up my game in my physical health. I&rsquo;ve been consistently practicing yoga and am already seeing a decrease in back pain. &ndash; I launched a new single and music video. I reached 1600 streams on Spotify in one week and 1500 views on youtube in one week. That&rsquo;s the most success I&rsquo;ve had to date with music. It&rsquo;s going to grow the more I learn and the more I release music.', 'successcircles' ),
				),
				array(
					'name' => __( 'Jane Wilcox', 'successcircles' ),
					'role' => '',
					'text' => __( 'I love the accountability calls every day and appreciate when my buddy is consistently on the other end of the phone. Writing out my daily action plan the night before gives me a base on which to move through my day and let&rsquo;s me see where I may have fallen short of a goal or action.', 'successcircles' ),
				),
				array(
					'name' => __( 'Douglas Samuel', 'successcircles' ),
					'role' => '',
					'text' => __( 'Success Circles has helped me develop personally and professionally. I&rsquo;ve got much more focus, and I&rsquo;ve had the opportunity to help many other people focus on what&rsquo;s important in their life.Success Circles is a must have for anyone who wants to step up their game, especially if they have big personal or business goals they are aiming for.', 'successcircles' ),
				),
				array(
					'name' => __( 'Jay', 'successcircles' ),
					'role' => __( 'www.WeekendDating.com', 'successcircles' ),
					'text' => __( 'Hi, just some positive words on Success Circles. I recently met someone at a networking event who was a life coach and offered me a free introductory package. After that, it was crazy money, somewhere around $1200- $1500 for an evaluation session, 4 follow up sessions and email correspondence in between. I really did not know what a life coach does. As I started going through the early phases with this person, I said, wait, I am already doing this with Success Circles. A lot of the materials presented (wheel of life, making sure to have different categories of life covered) are all things I learned through Success Circles at a fraction of what the cost would be. So kuddos to you. After one evaluation session and one follow up session, I let her know that it really was duplicative of what I was already experiencing with Peer Success. All the best!', 'successcircles' ),
				),
				array(
					'name' => __( 'Heather Cottrell', 'successcircles' ),
					'role' => __( 'Holistic Nutrition &amp; Lifestyle Coach', 'successcircles' ),
					'text' => __( 'Being a part of Success Circles has made a dramatic difference in my life. Suddenly I am no longer on my own &ndash; I have a daily accountability partner who supports me to achieve my goals as I do the same for them. I created a habit of waking 4-6 hours earlier than usual creating more time each day to build my business, spend time with friends and family and practice self-care. People need people, especially heart-centered entrepreneurs who work alone putting out so much energy to help others. Start each day with a supportive partner who holds you accountable, is with you through challenges and celebrates your daily and weekly wins and discover what becomes possible in your life.', 'successcircles' ),
				),
				array(
					'name' => __( 'Kay Kinder-Francis', 'successcircles' ),
					'role' => '',
					'text' => __( 'Success Circle is the way I start each day &ndash; focused, inspired, in a state of gratitude with an action list that gets done each day towards my goals and dreams. Having a daily accountability partner has made all the difference from wanting to do things to actually doing things. Every day I learn more about myself &ndash; every day I live my dreams with passion and focus. Every day I build my future while savoring the day now. For those who have not signed up for one of the most motivating programs that leads to action towards your goals and dreams my question is this &ndash; what are you waiting for? You will never get better life changing value for so little.', 'successcircles' ),
				),
				array(
					'name' => __( 'Melissa E.', 'successcircles' ),
					'role' => '',
					'text' => __( 'I&rsquo;m incredibly grateful for my buddying experience with Valerie. She helped me step into a career change I&rsquo;ve been looking to make for several months but had a hard time pulling the trigger on and getting started. Her presence, empathy, determination, and bubbly attitude made each phone call a real joy and success propelling forward fearlessly into the unknown, and scary action items. She rocks!!! I can&rsquo;t speak more highly about peer success circles. The power of holding space for people to step into their dreams and keeping them accountable is priceless! Never mind the life long friends I&rsquo;ve made here in the past. Thank you!', 'successcircles' ),
				),
			),
		),

		'about' => array(
			'title'     => __( 'Twenty years of <em class="sc-accent">peers</em>, <br>not platforms.', 'successcircles' ),
			'lede'      => __( 'Since 2005, SuccessCircles has helped thousands of entrepreneurs and business owners stay the course and win the game of work, life and play.', 'successcircles' ),
			'meta'      => array(
				__( 'Founded 2005', 'successcircles' ),
				__( 'Started with 8 friends', 'successcircles' ),
				__( 'Now an international community', 'successcircles' ),
			),
			'bleed_alt' => __( 'SuccessCircles members in a working huddle', 'successcircles' ),

			'mission'   => array(
				'title' => __( 'Our mission is simply <br>to make you <em class="sc-accent">better</em>.', 'successcircles' ),
				'lede'  => __( 'The mission of SuccessCircles is simply to make you better. Making you better makes us better.', 'successcircles' ),
				'body'  => __( 'We aim to always inspire our members to make 1% DAILY meaningful and measurable progress and enjoy the journey in winning the game of life, work, and play. When you get a little bit better every day, you have now tapped into exponential growth while enjoying the journey getting there.', 'successcircles' ),
			),

			'vision'    => array(
				'title'     => __( 'Nobody should have to <br>brave the journey alone.', 'successcircles' ),
				'image_alt' => __( 'An entrepreneur working alone at a desk', 'successcircles' ),
				'body'      => array(
					__( 'Create a world where entrepreneurs and business leaders no longer have to brave the journey alone.', 'successcircles' ),
					__( 'Success Circles is a Goal Purposing System (GPS). Just as a captain needs to make continual course corrections to get to a destination, so does every entrepreneur and business leader. Success Circles provides that daily flight plan goal realignment by connecting members together in peer-to-peer partnerships, all while tracking their growth and progress while receiving consistent feedback. It&rsquo;s the ultimate blend of productivity and relationships.', 'successcircles' ),
					__( 'We believe that to have a quality life, it helps to be asked quality questions. Quality questions establish the framework for all our Momentum &ldquo;Braintrust&rdquo; Buddy calls. It&rsquo;s our intention that each member leads an inspiring and fulfilling life full on play.', 'successcircles' ),
				),
			),

			'values'    => array(
				'title' => __( 'Two vows, made <br>on the way in.', 'successcircles' ),
				'lede'  => __( 'Upon joining, every member of Success Circles makes a commitment to respect and uphold the community&rsquo;s core founding values:', 'successcircles' ),
				// The club's own core-values seal, carrying both vows around its
				// ring — which is why it sits with the section heading rather
				// than beside either vow.
				'badge' => array(
					'file'   => 'core-values.png',
					'alt'    => __( 'SuccessCircles core values seal: make others better than you found them, and aim to be better today than yesterday. #BETTERPRINCIPLES', 'successcircles' ),
					'width'  => 584,
					'height' => 603,
				),
				'items' => array(
					array(
						'title' => __( 'Make Others Better Than You Found Them', 'successcircles' ),
						'text'  => __( 'You contribute as much as you receive. The call is not a service you consume &mdash; it is a room you hold open for someone else.', 'successcircles' ),
					),
					array(
						'title' => __( 'Be BETTER Today Than Yesterday', 'successcircles' ),
						'text'  => __( 'Not a transformation. One percent, measurable, today &mdash; then again tomorrow, until the compounding does the rest.', 'successcircles' ),
					),
				),
			),

			'story'     => array(
				'title' => __( 'How it all got started.', 'successcircles' ),
				'body'  => array(
					__( 'The concept of Success Circles began 20 years ago in 2005 initially with 8 personal friends including Joseph J. Varghese as an extension of a family office that he began in honor of his late father John Varghese. John Varghese was a master in understanding generational impact and compound growth having invested in helping other members of the family realize their dreams.', 'successcircles' ),
					__( 'Joseph found that all those initial 8 Success Circles members were able to continue making progress toward reaching their goals and dreams through the daily engagement of peer-to-peer momentum calls. What started as a small braintrust of unique individuals has now grown into an International community.', 'successcircles' ),
					__( 'Success Circles pairs our members with a momentum &ldquo;huddle&rdquo; buddy who shares similar values and who is also committed to personal and professional growth and improvement. We do our best to pair you up with someone who is a few steps ahead of you in a specific area of life, or with someone who has already reached a goal you are striving for.', 'successcircles' ),
					__( 'We rise to the quality of expectations that we establish with our peers. When you join Success Circles, you will find yourself continually leveling up simply based on how our community sees you as an extraordinary leader.', 'successcircles' ),
				),
				'arc'   => array(
					array(
						'scale'  => '0.38',
						'figure' => __( '8', 'successcircles' ),
						'label'  => __( 'friends, one call a day, 2005', 'successcircles' ),
					),
					array(
						'scale'  => '0.66',
						'figure' => __( '1%', 'successcircles' ),
						'label'  => __( 'better each day, measured', 'successcircles' ),
					),
					array(
						'scale'  => '1',
						'figure' => __( 'Thousands', 'successcircles' ),
						'label'  => __( 'owners, across the world, today', 'successcircles' ),
					),
				),
			),
		),

		// The Momentum Braintrust Buddy program page. Transcribed from the live
		// Kartra landing page at momentumbuddy.com (2026-08-28) so the program
		// lives on this site instead of sending visitors off to a funnel.
		// Testimonials, prices and the stat line are the client's own copy.
		'buddy_page' => array(
			'eyebrow'  => __( 'Momentum Braintrust Buddy&trade;', 'successcircles' ),
			'title'    => __( 'Dare to play <em class="sc-accent">bigger</em>.', 'successcircles' ),
			'lede'     => __( 'Transform your entrepreneurial journey with the Momentum Braintrust Buddy action program &mdash; structured one-to-one peer accountability, every weekday, with owners playing at your level.', 'successcircles' ),
			'cta'      => __( 'I want momentum', 'successcircles' ),
			'cta_note' => __( 'No commission fee or contract. You can cancel anytime.', 'successcircles' ),
			'notice'   => __( 'Peak season in full swing. Few spots open.', 'successcircles' ),
			// The source page's hero was a content-free blue/orange gradient — a
			// coloured block where an image belongs, and off-palette besides.
			// The programme is peer matching, so the peers are the image: the
			// twelve members who gave the testimonials further down the page,
			// set around the theme's own orbit ring.
			'ring'     => array(
				'centre' => __( 'A new buddy every two weeks', 'successcircles' ),
				'faces'  => array(
					'susan-hum.jpg',
					'aj-mihrzad.jpg',
					'elaine-williams.png',
					'tanya-straker.jpg',
					'garth-sandiford.jpg',
					'steve-zhou.jpg',
					'heather-cottrell.png',
					'ruth-dorsainville.png',
					'damon-dickinson.png',
					'david-rush.jpg',
					'erick-rivas.jpg',
					'ken-van-liew.jpg',
				),
			),
			'badge'    => array(
				'file'   => 'trustpilot.png',
				'alt'    => __( 'Rated 5 out of 5 on Trustpilot, powered by Peer Momentum', 'successcircles' ),
				'width'  => 1800,
				'height' => 600,
			),
			'stats'    => array(
				array(
					'figure' => __( '6,330', 'successcircles' ),
					'label'  => __( 'successful Momentum Buddies', 'successcircles' ),
				),
				array(
					'figure' => __( '7,880', 'successcircles' ),
					'label'  => __( 'goals reached, cumulatively', 'successcircles' ),
				),
				array(
					'figure' => __( '20', 'successcircles' ),
					'label'  => __( 'years running the program', 'successcircles' ),
				),
			),
			'stats_note' => __( 'Yes, we track this stuff.', 'successcircles' ),

			'problem'  => array(
				'title' => __( 'The hidden struggles of <em class="sc-accent">successful</em> entrepreneurs.', 'successcircles' ),
				'lede'  => __( 'You&rsquo;ve built a thriving business, maybe even multiple ventures. You can step away while your teams manage operations. On paper, you&rsquo;re living the entrepreneurial dream. But something&rsquo;s off, isn&rsquo;t it?', 'successcircles' ),
				'items' => array(
					array(
						'title' => __( 'The isolation at the top', 'successcircles' ),
						'text'  => __( 'Success has a price, and it&rsquo;s often paid in solitude. The higher you climb, the fewer people understand your challenges. Who can you really talk to about the weight of leadership, the constant need for innovation, the pressure to stay ahead?', 'successcircles' ),
					),
					array(
						'title' => __( 'The paralysis of prioritization', 'successcircles' ),
						'text'  => __( 'Your to-do list is endless. Every task seems crucial, every opportunity too good to pass up. But which moves will truly move the needle? The overwhelm is real, and it&rsquo;s suffocating your ability to focus on what truly matters.', 'successcircles' ),
					),
					array(
						'title' => __( 'The stagnation of success', 'successcircles' ),
						'text'  => __( 'Remember the fire that drove you when you started? It&rsquo;s still there, but the flames are flickering. Complacency is a silent killer in business. You know you should be pushing boundaries, but finding that drive when things are &ldquo;good enough&rdquo; feels impossible.', 'successcircles' ),
					),
					array(
						'title' => __( 'The echo chamber of ideas', 'successcircles' ),
						'text'  => __( 'You&rsquo;re surrounded by people who look up to you, who rely on your vision. But where&rsquo;s your sounding board? Where are the people who can challenge your thinking, push you to new heights? The lack of peer-level interaction is stunting your growth and critical thinking.', 'successcircles' ),
					),
					array(
						'title' => __( 'The fading fun factor', 'successcircles' ),
						'text'  => __( 'Remember when business felt like an exhilarating game? Now it&rsquo;s a grind. The joy of the hustle, the thrill of the win &mdash; they&rsquo;re memories rather than daily experiences. You&rsquo;re successful, but are you fulfilled?', 'successcircles' ),
					),
				),
			),

			'huddles'  => array(
				'eyebrow' => __( 'Daily huddles', 'successcircles' ),
				'title'   => __( 'Your catalyst for clarity and action.', 'successcircles' ),
				'lede'    => __( 'Start each day with a 30-minute power session braintrust with a hand-selected peer. Use our proprietary braintrust system to:', 'successcircles' ),
				'items'   => array(
					__( 'Celebrate victories (reigniting your passion)', 'successcircles' ),
					__( 'Tackle challenges head-on (sharpening your problem-solving skills)', 'successcircles' ),
					__( 'Set and crush daily goals (mastering prioritization)', 'successcircles' ),
					__( 'Break through mental blocks (enhancing critical thinking)', 'successcircles' ),
				),
				'quote'   => __( 'Quality questions establish the framework for all our Momentum Braintrust Buddy calls.', 'successcircles' ),
			),

			'growth'   => array(
				'eyebrow' => __( 'Continuous growth and accountability', 'successcircles' ),
				'title'   => __( 'Your secret weapon.', 'successcircles' ),
				'items'   => array(
					__( 'Get matched with a new Momentum Braintrust Buddy every two weeks (constant fresh perspectives)', 'successcircles' ),
					__( 'Keep pushing your boundaries and avoid complacency (stay sharp, stay hungry)', 'successcircles' ),
					__( 'Access $10,000 worth of resources on delegation, time management, and mindset mastery', 'successcircles' ),
					__( 'Tap into a network of peers playing at the highest level (challenge your thinking)', 'successcircles' ),
				),
				'statement' => __( 'We help business operators to become OWNERS, and business owners to become BETTER OWNERS. That&rsquo;s what Momentum Braintrust Buddy offers.', 'successcircles' ),
			),

			'community' => array(
				'eyebrow' => __( 'A community of high achievers', 'successcircles' ),
				'title'   => __( 'Your new playground.', 'successcircles' ),
				'items'   => array(
					__( 'Connect with fellow entrepreneurs who speak your language', 'successcircles' ),
					__( 'Access weekly and monthly live group huddles (expanding your perspective)', 'successcircles' ),
					__( 'Tap into a network of peers playing at the highest level (challenge your thinking)', 'successcircles' ),
				),
				'quote'   => __( 'Your Momentum Braintrust Buddy can see your potential &mdash; and in two weeks, you will too.', 'successcircles' ),
			),

			'benefits' => array(
				'eyebrow' => __( 'What&rsquo;s included', 'successcircles' ),
				'title'   => __( 'Get these exclusive benefits.', 'successcircles' ),
				'lede'    => __( 'Get a Momentum Braintrust Buddy. Huddle up one-to-one on weekdays with other members of Success Circles&trade; every two weeks. Every sport in life has a huddle, and you deserve an opportunity to huddle up, get daily feedback, strategize your day, and play to win.', 'successcircles' ),
				'items'   => array(
					__( 'Access to weekly and monthly live group huddles &mdash; AI Pro, Time Mastery and Week-in-Celebration', 'successcircles' ),
					__( 'Access to our Momentum Community platform and member roster. Choose who you want to partner with.', 'successcircles' ),
					__( 'Support and encouragement from our entire community &mdash; entrepreneurs, business owners and peers playing at the highest level', 'successcircles' ),
					__( 'MomentumMate&trade; virtual coworking sessions, three per week, for distraction-free productivity', 'successcircles' ),
					__( 'Your personalised daily AI coach', 'successcircles' ),
					__( '10x personal and professional results. Increased profitability and prosperity.', 'successcircles' ),
					__( 'Higher accountability and strong value-based professional support', 'successcircles' ),
					__( 'Improved overall productivity, effectiveness, and delegation skills', 'successcircles' ),
					__( 'More fun, deeper levels of fulfillment, and a higher quality of living', 'successcircles' ),
					__( 'Tax deductible', 'successcircles' ),
				),
			),

			'pricing'  => array(
				'eyebrow' => __( 'Pricing plans', 'successcircles' ),
				'title'   => __( 'Three ways to commit.', 'successcircles' ),
				'note'    => __( 'No commission fee or contract. You can cancel anytime.', 'successcircles' ),
				'plans'   => array(
					array(
						'name'     => __( 'Quarterly', 'successcircles' ),
						'cycle'    => __( 'Every 3 months', 'successcircles' ),
						'price'    => '$582',
						'detail'   => __( '$194 per month', 'successcircles' ),
						'save'     => '',
						'featured' => true,
					),
					array(
						'name'     => __( 'Half year', 'successcircles' ),
						'cycle'    => __( 'Every 6 months', 'successcircles' ),
						'price'    => '$972',
						'detail'   => __( '$162 per month', 'successcircles' ),
						'save'     => __( 'Save $192', 'successcircles' ),
						'featured' => false,
					),
					array(
						'name'     => __( 'Yearly', 'successcircles' ),
						'cycle'    => __( 'Every 12 months', 'successcircles' ),
						'price'    => '$1,940',
						'detail'   => __( '$162 per month', 'successcircles' ),
						'save'     => __( 'Save $388', 'successcircles' ),
						'featured' => false,
					),
				),
			),

			'closing'  => array(
				'title' => __( 'Dare to play bigger.', 'successcircles' ),
				'body'  => array(
					__( 'You&rsquo;ve already proven you have what it takes to succeed. Now it&rsquo;s time to elevate your game even further. With Momentum Braintrust Buddy you&rsquo;re not just maintaining your success &mdash; you&rsquo;re multiplying it, while rekindling the joy that drew you to entrepreneurship in the first place.', 'successcircles' ),
					__( 'Start writing the next successful chapter of your entrepreneurial story. Join a community of entrepreneurs from diverse industries, all experiencing transformative changes.', 'successcircles' ),
				),
				'items' => array(
					__( 'Break through isolation and connect with peers who get it', 'successcircles' ),
					__( 'Master the art of prioritization and laser-focused action', 'successcircles' ),
					__( 'Reignite your passion for growth and innovation', 'successcircles' ),
					__( 'Enhance your critical thinking with peer-level challenges', 'successcircles' ),
					__( 'Inject more fun and play into your business journey', 'successcircles' ),
					__( 'Achieve goals you never thought possible', 'successcircles' ),
				),
				'outro' => array(
					__( 'Don&rsquo;t let another day pass feeling stuck at the top. Because in the world of business, you&rsquo;re either growing or you&rsquo;re dying &mdash; so why not grow and have fun doing it?', 'successcircles' ),
					__( 'Remember, success without fulfillment is the ultimate failure. Choose growth. Choose joy.', 'successcircles' ),
				),
				'kicker' => __( 'For what it would cost for a cup of your daily brew, you could have a peer coach in your life &mdash; and without the extra caffeine. Are you ready to join the huddle?', 'successcircles' ),
			),

			'quotes'   => array(
				array( 'name' => 'Susan Hum', 'role' => __( 'The Love Hacker / Mind Mastery &amp; Success Coach', 'successcircles' ), 'image' => 'susan-hum.jpg', 'w' => 853, 'h' => 853, 'text' => __( 'I was so impressed with the level quality in the accountability partner that was matched with me. The process of matchmaking was so spot on with regards to the person I was introduced to work with as well as the success in accountability I received within a short period of time. My experience was absolutely rewarding in so many ways!', 'successcircles' ) ),
				array( 'name' => 'AJ Mihrzad', 'role' => __( 'The Online Super Coach', 'successcircles' ), 'image' => 'aj-mihrzad.jpg', 'w' => 640, 'h' => 640, 'text' => __( 'Such a powerful program! I&rsquo;ve done many personal development programs in the past and this is one of the BEST! I highly recommend Momentum Buddy&trade;!', 'successcircles' ) ),
				array( 'name' => 'Elaine Williams', 'role' => __( 'Video &amp; Visibility Coach, Speaker, Author', 'successcircles' ), 'image' => 'elaine-williams.png', 'w' => 500, 'h' => 500, 'text' => __( 'I love my accountability calls! This community is full of amazing people who are up to building their businesses and changing the world. The phone call structure is a great way to get laser focused for the day and I&rsquo;ve found that they&rsquo;ve tripled my effectiveness and productivity! I highly recommend Momentum Buddy&trade; and this community!', 'successcircles' ) ),
				array( 'name' => 'Tanya Straker', 'role' => __( 'Certified Health Coach', 'successcircles' ), 'image' => 'tanya-straker.jpg', 'w' => 500, 'h' => 500, 'text' => __( 'The morning calls are a consistent, steadying factor in a whirl of change. Everyone that I have been partnered with has contributed to my business knowledge and growth. As a solopreneur I highly recommend Momentum Buddy&trade;. The team are amazing!', 'successcircles' ) ),
				array( 'name' => 'Garth Sandiford', 'role' => __( 'Real Estate Agent', 'successcircles' ), 'image' => 'garth-sandiford.jpg', 'w' => 400, 'h' => 400, 'text' => __( 'Being a member of Momentum Buddy&trade; has been one of my best investments in myself. The daily calls help to keep me on track to achieving my personal and professional outcomes. Joseph and his team are amazing and do a fantastic job.', 'successcircles' ) ),
				array( 'name' => 'Steve Zhou', 'role' => __( 'Deputy CFO at Post Acute Care', 'successcircles' ), 'image' => 'steve-zhou.jpg', 'w' => 320, 'h' => 320, 'text' => __( 'Momentum Buddy&trade; is definitely a worthwhile investment. The system has made me more accountable and productive. I lost 10 lbs and achieved my real estate purchase through consistent daily action. I highly recommend it.', 'successcircles' ) ),
				array( 'name' => 'Heather Cottrell', 'role' => __( 'Coach at Holistic Nutrition and Lifestyle', 'successcircles' ), 'image' => 'heather-cottrell.png', 'w' => 150, 'h' => 150, 'text' => __( 'Being a part of Huddle Calls has made a dramatic difference in my life. Suddenly, I am no longer on my own &mdash; I have a daily Momentum Buddy&trade; who supports me to achieve my goals as I do the same for them. I created a habit of waking 4&ndash;6 hours earlier than usual, creating more time each day to build my business, spend time with friends and family, and practice self-care.', 'successcircles' ) ),
				array( 'name' => 'Ruth Dorsainville', 'role' => __( 'CEO at DNA Legacy Group', 'successcircles' ), 'image' => 'ruth-dorsainville.png', 'w' => 626, 'h' => 629, 'text' => __( 'Excellent coaching company with an abundance of resources that helps any entrepreneur succeed in their business. Highly recommended.', 'successcircles' ) ),
				array( 'name' => 'Damon Dickinson', 'role' => __( 'Success Coach', 'successcircles' ), 'image' => 'damon-dickinson.png', 'w' => 220, 'h' => 220, 'text' => __( 'Most cost effective hands-on daily coaching I know of. Since joining, I&rsquo;ve signed on 2 new coaching clients, was introduced to a solid $500 monthly new passive income opportunity, and my rental property is at record levels of income. I&rsquo;m so grateful I joined and you will be too!', 'successcircles' ) ),
				array( 'name' => 'David Rush', 'role' => __( 'Communication Coach', 'successcircles' ), 'image' => 'david-rush.jpg', 'w' => 589, 'h' => 589, 'text' => __( 'Daily accountability has been a challenge for me throughout my career. This system starts my day off with power and structure. I get to speak first thing in the day about my goals, reflect on the day and week prior, and have someone to answer to. Not only that, I get to contribute to others and hold them accountable and be of service to them!', 'successcircles' ) ),
				array( 'name' => 'Erick Rivas', 'role' => __( 'Entrepreneur', 'successcircles' ), 'image' => 'erick-rivas.jpg', 'w' => 460, 'h' => 320, 'text' => __( 'I&rsquo;ve been with Momentum Buddy&trade; for 2 years now and I am also a member of different masterminds, and this group by far has the best structure for accountability and connections with others looking to level up. The Momentum Buddies are crucial and I recommend everyone have an accountability group that they support, and in turn, supports them.', 'successcircles' ) ),
				array( 'name' => 'Ken Van Liew', 'role' => __( 'CEO at Global Real Estate Strategies', 'successcircles' ), 'image' => 'ken-van-liew.jpg', 'w' => 400, 'h' => 400, 'text' => __( 'Momentum Buddy&trade; has morphed into my fabric after participating for over 15 years! The outcomes from daily accountability are second to none, with an established structure for you to achieve lifelong goals while having fun with outstanding people. Take action today, join Momentum Buddy&trade;, and become part of this unique community that treats you like family.', 'successcircles' ) ),
			),
		),

		// The Momentum Labs program page. Transcribed from the live GroovePages
		// landing page at momentumhuddle.com (2026-08-28). The source page's
		// stock vectors and banner are in assets/img/labs/ — see the page
		// template for which are used and why.
		'labs_page' => array(
			'eyebrow'  => __( 'Momentum Labs', 'successcircles' ),
			'title'    => __( 'The secret weapon of wildly <em class="sc-accent">successful</em> entrepreneurs.', 'successcircles' ),
			'lede'     => __( 'Designed to enhance your journey to exponential growth &mdash; group huddles, a braintrust of operators, and the AI and time systems to go with them.', 'successcircles' ),
			'cta'      => __( 'Yes! I want exponential growth', 'successcircles' ),
			'cta_url'  => 'https://www.successcircles.net/yesMomentumLabs',
			'price'    => '$97',
			'price_note' => __( 'per month', 'successcircles' ),
			'seal'     => array(
				'file'   => 'community-huddles.png',
				'alt'    => __( 'Success Circles Momentum Community and Huddles seal', 'successcircles' ),
				'width'  => 300,
				'height' => 300,
			),
			'video'    => array(
				'id'       => '985007994',
				'name'     => __( 'Join Momentum Community &amp; Huddle', 'successcircles' ),
				'kind'     => __( 'A minute inside the Labs', 'successcircles' ),
				'poster'   => 'video-poster.jpg',
				'duration' => '0:56',
				'width'    => 1280,
				'height'   => 720,
			),

			'problem'  => array(
				'title'     => __( 'Is your business stuck in <em class="sc-accent">neutral</em>?', 'successcircles' ),
				'lede'      => __( 'You&rsquo;re working hard, but are you seeing the results you deserve? Imagine waking up every morning excited to tackle the day. Your business is thriving, your productivity is off the charts, and you&rsquo;re part of an elite group of entrepreneurs who are changing the game. This isn&rsquo;t a pipe dream &mdash; it&rsquo;s the reality for members of Momentum Labs.', 'successcircles' ),
				'ask'       => __( 'But first, let me ask you:', 'successcircles' ),
				'questions' => array(
					__( 'Do you often feel isolated, missing the energy and support of a team?', 'successcircles' ),
					__( 'Are you drowning in to-do lists, feeling like there&rsquo;s never enough time?', 'successcircles' ),
					__( 'Does the rapid pace of technology, especially AI, leave you feeling left behind?', 'successcircles' ),
					__( 'Are you tired of making decisions in a vacuum, without trusted advisors to bounce ideas off?', 'successcircles' ),
				),
				'answer'    => __( 'If you nodded to any of these, you&rsquo;re not alone. And more importantly, there&rsquo;s a solution.', 'successcircles' ),
				// The source page's flat vector illustration was replaced with a
				// drawn figure — see the "neutral vs momentum" SVG in
				// page-momentum-labs.php. These are its labels.
				'figure'    => array(
					'caption' => __( 'Two ways a year can go.', 'successcircles' ),
					'flat'    => __( 'On your own', 'successcircles' ),
					'flat_note' => __( 'Effort without compounding', 'successcircles' ),
					'curve'   => __( 'In a Lab', 'successcircles' ),
					'curve_note' => __( '1% a day, compounding', 'successcircles' ),
					'note'    => __( 'Illustrative &mdash; the shape of the difference, not measured data.', 'successcircles' ),
					'alt'     => __( 'A diagram contrasting a flat line, labelled on your own, with a curve that rises steeply, labelled in a Lab.', 'successcircles' ),
				),
			),

			'includes' => array(
				'eyebrow' => __( 'Here&rsquo;s what you get', 'successcircles' ),
				'title'   => __( 'Your shortcut to exponential growth.', 'successcircles' ),
				'items'   => array(
					array(
						'title' => __( 'Flexible access', 'successcircles' ),
						'text'  => __( 'Choose from 4&ndash;8 weekly huddles that fit your schedule. Early bird or night owl, we&rsquo;ve got you covered.', 'successcircles' ),
					),
					array(
						'title' => __( 'Momentum.Community', 'successcircles' ),
						'text'  => __( 'Access to our Circle platform for exclusive, distraction-free conversations with our community of entrepreneurs and business owners.', 'successcircles' ),
					),
					array(
						'title' => __( 'AI mastery', 'successcircles' ),
						'text'  => __( 'Harness the power of AI to skyrocket your business. No tech degree required.', 'successcircles' ),
					),
					array(
						'title' => __( 'Time manipulation secrets', 'successcircles' ),
						'text'  => __( 'Learn to bend time to your will. Get more done in less time, without the burnout.', 'successcircles' ),
					),
					array(
						'title' => __( 'Your personal braintrust', 'successcircles' ),
						'text'  => __( 'Tap into the collective wisdom of ambitious entrepreneurs. Solve problems faster, spot hidden opportunities, and leap over obstacles.', 'successcircles' ),
					),
					array(
						'title' => __( 'Transformation on demand', 'successcircles' ),
						'text'  => __( 'Turn isolation into inspiration. Every huddle is a shot of motivation, accountability, and actionable strategies.', 'successcircles' ),
					),
				),
			),

			'deal'     => array(
				'title'   => __( 'Success isn&rsquo;t a solo sport.', 'successcircles' ),
				'text'    => __( 'The most successful entrepreneurs have a secret weapon &mdash; a community of peers and mentors pushing them to new heights. That&rsquo;s exactly what you&rsquo;ll find in the Momentum Community and Huddles.', 'successcircles' ),
				// The portrait was unattributed, which is odd for a photo of a
				// real person. The quote and role are read from `founder_page`
				// so there is one source of truth for what Joseph actually said.
				'link'    => __( 'Read his story', 'successcircles' ),
				'link_url' => '/about-joseph-varghese/',
				'image'   => array(
					'file'   => 'joseph.png',
					'alt'    => __( 'Joseph Varghese, founder of SuccessCircles', 'successcircles' ),
					'width'  => 650,
					'height' => 800,
				),
			),

			// Broken into its real parts. "This isn't for everyone" was buried as
			// the opening words of a paragraph when it is the actual claim; the
			// section heading was only a label. Same words, honest hierarchy.
			'warning'  => array(
				'label' => __( 'But fair warning', 'successcircles' ),
				'title' => __( 'This isn&rsquo;t for everyone.', 'successcircles' ),
				'body'  => __( 'If you&rsquo;re content with mediocrity, or if you believe success comes from luck rather than strategy and hard work, this probably isn&rsquo;t for you.', 'successcircles' ),
				'turn'  => __( 'However, if you&rsquo;re ready to join the ranks of high-achieving entrepreneurs who are rewriting the rules of business success, then I invite you to take the next step.', 'successcircles' ),
			),

			'closing'  => array(
				'title' => __( 'Surround yourself with <em class="sc-accent">brilliance</em>.', 'successcircles' ),
				'text'  => __( 'The most successful entrepreneurs don&rsquo;t go it alone. They surround themselves with brilliance. Isn&rsquo;t it time you did the same? Join us today and make this quarter your best yet.', 'successcircles' ),
				'note'  => __( 'Your future self will thank you.', 'successcircles' ),
			),
		),

		// The Momentum Team page. Transcribed from the live Kartra landing page
		// at momentum.team (2026-08-28). The 90-day method is a real sequence,
		// which is why it is the one block on the page that carries numbers.
		'team_page' => array(
			'kicker'   => __( '90-day AI accelerator', 'successcircles' ),
			'title'    => __( 'Stop operating <em class="sc-accent">in</em> your business. Start leading from it.', 'successcircles' ),
			'lede'     => __( 'What if you could hit your biggest goal and start the next year 10x stronger, while leveraging AI? A 90-day cohort that moves you from reactive operator to visionary leader.', 'successcircles' ),
			'cta'      => __( 'Apply now', 'successcircles' ),
			'cta_url'  => 'https://www.momentum.team/yes',
			'cta_note' => __( 'Application only. Reviewed within 24 hours.', 'successcircles' ),
			'hero'     => array(
				'file'   => 'members-live.jpg',
				'alt'    => __( 'Momentum Team members together at a live cohort dinner in New York', 'successcircles' ),
				'width'  => 1120,
				'height' => 1400,
			),
			'facts'    => array(
				array( 'term' => __( 'Length', 'successcircles' ), 'value' => __( '90 days', 'successcircles' ) ),
				array( 'term' => __( 'Format', 'successcircles' ), 'value' => __( 'Cohort', 'successcircles' ) ),
				array( 'term' => __( 'Cohort', 'successcircles' ), 'value' => __( 'Our 42nd', 'successcircles' ) ),
				array( 'term' => __( 'Entry', 'successcircles' ), 'value' => __( 'By application', 'successcircles' ) ),
			),

			'prison'   => array(
				'title' => __( 'The hidden prison every successful owner lives in.', 'successcircles' ),
				'lede'  => __( 'You started your business to create freedom. Instead you&rsquo;ve created a sophisticated prison where success feels like punishment. Here&rsquo;s your daily reality:', 'successcircles' ),
				'items' => array(
					array(
						'title' => __( 'You&rsquo;re trapped in your own success', 'successcircles' ),
						'text'  => __( 'Every decision flows through you. Every crisis becomes your emergency. You&rsquo;re not building a business &mdash; you&rsquo;re feeding a beast that consumes everything you have while your biggest dreams collect dust.', 'successcircles' ),
					),
					array(
						'title' => __( 'Your freedom is disappearing', 'successcircles' ),
						'text'  => __( 'Your family gets the leftover version of you. The more successful you become, the more trapped you feel. Your revenue grows, but your freedom shrinks. You&rsquo;re building a prison instead of an empire.', 'successcircles' ),
					),
					array(
						'title' => __( 'You&rsquo;re being left behind', 'successcircles' ),
						'text'  => __( 'While you&rsquo;re bleeding cash on expensive teams, smart entrepreneurs are leveraging communities to get better results at a fraction of the cost. They&rsquo;re using AI to compress months of work into hours while you remain the bottleneck.', 'successcircles' ),
					),
				),
			),

			'scene'    => array(
				'title'  => __( 'Ninety days from now.', 'successcircles' ),
				'lede'   => __( 'You walk into your office and check your dashboard. Revenue is up 40%. Your team is executing flawlessly on three major initiatives you designed but don&rsquo;t need to manage. Your AI-powered systems have handled 80% of what used to consume your days.', 'successcircles' ),
				'turn'   => __( 'But here&rsquo;s the real breakthrough.', 'successcircles' ),
				'shifts' => array(
					array(
						'title' => __( 'Work becomes play', 'successcircles' ),
						'text'  => __( 'You&rsquo;ve discovered that business breakthrough is actually a game. And games are meant to be fun.', 'successcircles' ),
					),
					array(
						'title' => __( 'Strategic over reactive', 'successcircles' ),
						'text'  => __( 'Instead of putting out fires, you&rsquo;re designing the future. Instead of answering the same questions repeatedly, you&rsquo;ve built systems that prevent them.', 'successcircles' ),
					),
					array(
						'title' => __( 'True leadership fulfilment', 'successcircles' ),
						'text'  => __( 'You&rsquo;ve become the leader your business has been desperately waiting for, and you&rsquo;re having the time of your life doing it.', 'successcircles' ),
					),
				),
				'image'  => array(
					'file'   => 'cohort-sketch.jpg',
					'alt'    => __( 'A pen-and-ink drawing of a Momentum Team cohort gathered for a group photo', 'successcircles' ),
					'width'  => 825,
					'height' => 1100,
				),
				'quote'  => __( 'You&rsquo;re no longer in your business. You&rsquo;re leading from it &mdash; and it feels like play.', 'successcircles' ),
				'proof'  => array(
					__( 'Your family sees you present, energized, fulfilled and actually enjoying your work again.', 'successcircles' ),
					__( 'Your competitors wonder how you&rsquo;re moving so fast while seeming so relaxed.', 'successcircles' ),
					__( 'Your team follows a clear vision instead of scrambling to keep up with your latest panic.', 'successcircles' ),
				),
			),

			'stat'     => array(
				'figure' => __( '12,550', 'successcircles' ),
				'label'  => __( 'inspiring goal completions since we began', 'successcircles' ),
				'note'   => __( 'In our game of 1% progress each day, everyone wins. Momentum creates more momentum.', 'successcircles' ),
			),

			'method'   => array(
				'title'  => __( 'The Momentum Team method', 'successcircles' ),
				'lede'   => __( 'Your proven roadmap to visionary leadership, in three phases.', 'successcircles' ),
				'image'  => array(
					'file'   => 'huddle-screen.jpg',
					'alt'    => __( 'A weekly Momentum huddle on screen, nine members on the call', 'successcircles' ),
					'width'  => 825,
					'height' => 1100,
				),
				'phases' => array(
					array(
						'phase'  => __( 'Phase 1', 'successcircles' ),
						'days'   => __( 'Days 1&ndash;30', 'successcircles' ),
						'title'  => __( 'Vision, clarity &amp; foundation', 'successcircles' ),
						'intent' => __( 'Eliminate scattered focus and build your breakthrough foundation.', 'successcircles' ),
						'items'  => array(
							array( 'title' => __( 'Goal crystallization', 'successcircles' ), 'text' => __( 'Define your one breakthrough goal that elevates everything.', 'successcircles' ) ),
							array( 'title' => __( 'Accountability', 'successcircles' ), 'text' => __( 'Join Momentum Labs weekly huddles, and get matched with your Momentum Braintrust Buddy.', 'successcircles' ) ),
							array( 'title' => __( 'AI coach activation', 'successcircles' ), 'text' => __( 'Your personalized AI coach begins optimizing your business decisions.', 'successcircles' ) ),
							array( 'title' => __( 'AI system audit', 'successcircles' ), 'text' => __( 'Map your current workflows and identify automation opportunities.', 'successcircles' ) ),
							array( 'title' => __( 'Community integration', 'successcircles' ), 'text' => __( 'Access the Momentum.Community platform and connect with your advisory network.', 'successcircles' ) ),
							array( 'title' => __( 'Cohort leverage', 'successcircles' ), 'text' => __( 'Learn how to build support systems through community instead of expensive hiring.', 'successcircles' ) ),
						),
						'key'    => array(
							__( 'Weekly Pivot Calls for real-time course correction.', 'successcircles' ),
							__( 'Weekly Week-in-Celebration Reviews to stack victories and maintain momentum.', 'successcircles' ),
							__( 'AI Implementation Sessions to build your automated advantage.', 'successcircles' ),
							__( 'A 1-on-1 Momentum Coach call to establish your starting point.', 'successcircles' ),
							__( 'SimplifySprint: a 5-day gamified intensive to declutter and reclaim focus, with prizes and rewards.', 'successcircles' ),
						),
					),
					array(
						'phase'  => __( 'Phase 2', 'successcircles' ),
						'days'   => __( 'Days 31&ndash;60', 'successcircles' ),
						'title'  => __( 'System building &amp; acceleration', 'successcircles' ),
						'intent' => __( 'Build scalable systems and multiply your execution capacity.', 'successcircles' ),
						'items'  => array(
							array( 'title' => __( 'AI workflow integration', 'successcircles' ), 'text' => __( 'Deploy automated systems that handle routine operations.', 'successcircles' ) ),
							array( 'title' => __( 'Network leverage', 'successcircles' ), 'text' => __( 'Your advisory circle provides feedback, referrals, and solutions.', 'successcircles' ) ),
							array( 'title' => __( 'Breakthrough sessions', 'successcircles' ), 'text' => __( 'Get solutions from entrepreneurs who&rsquo;ve solved your exact challenges.', 'successcircles' ) ),
							array( 'title' => __( 'Delegation framework', 'successcircles' ), 'text' => __( 'Build processes that eliminate you as the bottleneck.', 'successcircles' ) ),
							array( 'title' => __( 'Virtual co-working', 'successcircles' ), 'text' => __( 'Three weekly distraction-free productivity sessions via MomentumMate.', 'successcircles' ) ),
							array( 'title' => __( 'Community-first scaling', 'successcircles' ), 'text' => __( 'Master leveraging relationships over fixed costs for business growth.', 'successcircles' ) ),
						),
						'key'    => array(
							__( 'Continued Weekly Pivot Calls and Week-in-Celebration Reviews.', 'successcircles' ),
							__( 'Advanced AI Implementation Sessions.', 'successcircles' ),
							__( 'A second 1-on-1 Momentum Coach call for personalized breakthrough strategies.', 'successcircles' ),
							__( 'Hello2Yes: a 5-day gamified challenge to overcome fear of rejection through bold requests, with tracking and rewards.', 'successcircles' ),
						),
					),
					array(
						'phase'  => __( 'Phase 3', 'successcircles' ),
						'days'   => __( 'Days 61&ndash;90', 'successcircles' ),
						'title'  => __( 'Momentum multiplication &amp; mastery', 'successcircles' ),
						'intent' => __( 'Lock in your new identity as a visionary leader and scale your impact.', 'successcircles' ),
						'items'  => array(
							array( 'title' => __( 'Visionary identity', 'successcircles' ), 'text' => __( 'Operate consistently from your new leadership level.', 'successcircles' ) ),
							array( 'title' => __( 'Network expansion', 'successcircles' ), 'text' => __( 'Leverage relationships for exponential growth opportunities.', 'successcircles' ) ),
							array( 'title' => __( 'Next steps', 'successcircles' ), 'text' => __( 'Design your next level of visionary challenges.', 'successcircles' ) ),
							array( 'title' => __( 'System optimization', 'successcircles' ), 'text' => __( 'Refine and scale your AI-powered workflows.', 'successcircles' ) ),
							array( 'title' => __( 'Legacy foundation', 'successcircles' ), 'text' => __( 'Build sustainable systems that continue growing without you.', 'successcircles' ) ),
							array( 'title' => __( 'Game mastery', 'successcircles' ), 'text' => __( 'Perfect your ability to make business growth feel like play.', 'successcircles' ) ),
						),
						'key'    => array(
							__( 'Continued Weekly Pivot Calls and Week-in-Celebration Reviews.', 'successcircles' ),
							__( 'Master AI Implementation Sessions.', 'successcircles' ),
							__( 'A third 1-on-1 Momentum Coach call for scaling strategies.', 'successcircles' ),
							__( 'Lifetime network access activation.', 'successcircles' ),
						),
					),
				),
			),

			'arsenal'  => array(
				'title'  => __( 'Your complete breakthrough arsenal.', 'successcircles' ),
				'lede'   => __( 'Everything included with the 90-day accelerator.', 'successcircles' ),
				'groups' => array(
					array(
						'name'  => __( 'Strategic foundation', 'successcircles' ),
						'items' => array(
							array( 'title' => __( 'Your personal advisory board', 'successcircles' ), 'text' => __( 'Elite network of successful entrepreneurs who crowdsource your success with feedback, referrals, and resources.', 'successcircles' ) ),
							array( 'title' => __( 'Momentum Labs access', 'successcircles' ), 'text' => __( 'Comprehensive weekly huddle system including Pivot Calls, Week-in-Celebration Reviews, and breakthrough sessions.', 'successcircles' ) ),
							array( 'title' => __( 'Your personalized daily AI coach', 'successcircles' ), 'text' => __( 'Custom AI system that optimizes your decisions, priorities, and daily execution.', 'successcircles' ) ),
							array( 'title' => __( '90-day goals framework', 'successcircles' ), 'text' => __( 'The proven methodology that&rsquo;s generated over 12,550 successful goal completions.', 'successcircles' ) ),
							array( 'title' => __( 'Community-first scaling system', 'successcircles' ), 'text' => __( 'Leverage cohorts instead of expensive remote teams, reducing fixed costs while increasing support.', 'successcircles' ) ),
						),
					),
					array(
						'name'  => __( 'AI-powered leverage', 'successcircles' ),
						'items' => array(
							array( 'title' => __( 'AI mastery training', 'successcircles' ), 'text' => __( 'Complete integration system to reclaim 10&ndash;15 hours per week for high-value visionary work.', 'successcircles' ) ),
							array( 'title' => __( 'AI implementation sessions', 'successcircles' ), 'text' => __( 'Build automated workflows that handle routine operations without your involvement.', 'successcircles' ) ),
							array( 'title' => __( 'Productivity multiplication tools', 'successcircles' ), 'text' => __( 'Elevate from manual labor to automated excellence.', 'successcircles' ) ),
							array( 'title' => __( 'Smart team building', 'successcircles' ), 'text' => __( 'Replace expensive fixed costs with strategic community leverage.', 'successcircles' ) ),
						),
					),
					array(
						'name'  => __( 'Elite support system', 'successcircles' ),
						'items' => array(
							array( 'title' => __( '10x Momentum Braintrust Buddy', 'successcircles' ), 'text' => __( 'Two weeks of daily one-to-one accountability calls. Like every sport, you deserve to huddle up, strategize your day, and play to win.', 'successcircles' ) ),
							array( 'title' => __( '1-on-1 Momentum Coach calls', 'successcircles' ), 'text' => __( 'Personal momentum sessions with top-tier coaches who&rsquo;ve guided hundreds of breakthroughs each month.', 'successcircles' ) ),
							array( 'title' => __( '3+ monthly cohort sessions', 'successcircles' ), 'text' => __( 'Choose from 5+ weekly options that fit your schedule.', 'successcircles' ) ),
							array( 'title' => __( 'Laser feedback', 'successcircles' ), 'text' => __( 'Get solutions to your biggest challenges from people who&rsquo;ve already solved them.', 'successcircles' ) ),
						),
					),
					array(
						'name'  => __( 'Community &amp; networking', 'successcircles' ),
						'items' => array(
							array( 'title' => __( 'Momentum.Community platform access', 'successcircles' ), 'text' => __( 'Real-time communication with your network of peak performers, plus the complete member roster.', 'successcircles' ) ),
							array( 'title' => __( 'MomentumMate&trade; virtual co-working', 'successcircles' ), 'text' => __( 'Three weekly distraction-free productivity sessions with other high achievers.', 'successcircles' ) ),
							array( 'title' => __( 'Live events &amp; elite networking', 'successcircles' ), 'text' => __( 'In-person dinners and experiences for East Coast members (NY, NJ, PA, CT).', 'successcircles' ) ),
							array( 'title' => __( 'Lifetime network access', 'successcircles' ), 'text' => __( 'Keep the relationships and referrals that compound your success for decades.', 'successcircles' ) ),
						),
					),
					array(
						'name'  => __( 'Gamified breakthroughs', 'successcircles' ),
						'items' => array(
							array( 'title' => __( 'SimplifySprint mini-event', 'successcircles' ), 'text' => __( 'A 5-day gamified sprint to declutter, remove distractions, and reclaim momentum through clarity, complete with prizes and rewards.', 'successcircles' ) ),
							array( 'title' => __( 'Hello2Yes mini-event', 'successcircles' ), 'text' => __( 'A 5-day gamified challenge to overcome rejection fear by making bold requests and tracking results, with recognition and rewards for courage.', 'successcircles' ) ),
							array( 'title' => __( 'Monthly workshops', 'successcircles' ), 'text' => __( 'Free access to high-intensity experiences every month designed for breakthrough moments.', 'successcircles' ) ),
							array( 'title' => __( 'Achievement system', 'successcircles' ), 'text' => __( 'Progress tracking, badges, and rewards that make transformation feel like winning.', 'successcircles' ) ),
						),
					),
					array(
						'name'  => __( 'Credibility &amp; assurance', 'successcircles' ),
						'items' => array(
							array( 'title' => __( 'Tax deductible investment', 'successcircles' ), 'text' => __( 'A professional development expense that improves your bottom line.', 'successcircles' ) ),
							array( 'title' => __( 'Rated 5/5 on Trustpilot', 'successcircles' ), 'text' => __( 'Verified reviews from accelerated entrepreneurs.', 'successcircles' ) ),
							array( 'title' => __( '20+ years of proven results', 'successcircles' ), 'text' => __( 'This is our 42nd successful cohort, with documented breakthroughs.', 'successcircles' ) ),
						),
					),
				),
			),

			'results'  => array(
				'title' => __( 'Measurable results.', 'successcircles' ),
				'items' => array(
					array( 'title' => __( '10x performance &amp; profitability', 'successcircles' ), 'text' => __( 'Documented increases in profitability and prosperity.', 'successcircles' ) ),
					array( 'title' => __( 'Systematic accountability', 'successcircles' ), 'text' => __( 'Consistent execution on your most important goals.', 'successcircles' ) ),
					array( 'title' => __( 'Efficiency without burnout', 'successcircles' ), 'text' => __( 'Multiply your impact without increasing workload.', 'successcircles' ) ),
					array( 'title' => __( 'Compounding daily growth', 'successcircles' ), 'text' => __( 'Make each day better than the last for exponential results over time.', 'successcircles' ) ),
				),
			),

			// The same film the homepage runs in its stories section (Vimeo
			// 870306260). It is a client-testimonial reel, so it leads the
			// social proof here rather than sitting up top as an explainer.
			'video'    => array(
				'id'       => '870306260',
				'name'     => __( 'What Our Clients Say About Success Circles', 'successcircles' ),
				'kind'     => __( 'Film', 'successcircles' ),
				'poster'   => 'video-poster.jpg',
				'duration' => '1:58',
				'width'    => 1280,
				'height'   => 760,
			),

			'quotes'   => array(
				array( 'name' => 'Rochelle Lisner', 'role' => __( 'CEO at Dynamic Business Growth', 'successcircles' ), 'image' => 'rochelle-lisner.png', 'text' => __( 'The Momentum Team is a great way to stay focused on the day to day actions needed to deliver on goals. The support and feedback allow me to course-correct so I am constantly moving forward inch by inch. I believe isolation kills success and with the team, I never feel isolated. Many people have my back.', 'successcircles' ) ),
				array( 'name' => 'Arvin Khamseh', 'role' => __( 'Digital Marketing Strategist, Product Marketer', 'successcircles' ), 'image' => 'arvin-khamseh.png', 'text' => __( 'My team grew from 2 to 14 people, a past VP of a national organization is now mentoring me (this is still hard to believe for myself!!) I had so many spontaneous and courageous actions in the past 3 months. This piece really stretched my reality and I value it highly. Knowing someone else is doing it with me gave me more courage to be spontaneous.', 'successcircles' ) ),
				array( 'name' => 'Charles Fritschler', 'role' => __( 'COO at Executive Losers', 'successcircles' ), 'image' => 'charles-fritschler.png', 'text' => __( 'Success Circles offers several programs and opportunities for growth and support. Over the last few months since joining Success Circles, I have benefited greatly from receiving terrific feedback and advice, in addition to specific knowledge. I meet many new like minded people who provide different perspectives; and as a bonus have made ongoing friends, including Success Circles Founder, Joseph.', 'successcircles' ) ),
				array( 'name' => 'Ken Van Liew', 'role' => __( 'Real Estate Developer', 'successcircles' ), 'image' => 'ken-van-liew.png', 'text' => __( 'The Momentum Team is an extraordinary experience that allows you to be held accountable to achieve what&rsquo;s important to you and in the process allows you contribute to others to help them achieve their goals.', 'successcircles' ) ),
			),

			'pricing'  => array(
				'title'    => __( 'Your investment in visionary leadership.', 'successcircles' ),
				'note'     => __( 'Both options include everything above. Both are tax deductible business investments.', 'successcircles' ),
				'plans'    => array(
					array(
						'name'     => __( 'One-time payment', 'successcircles' ),
						'price'    => '$1,997',
						'save'     => __( 'Save $394', 'successcircles' ),
						'text'     => __( 'Complete 90-day journey with immediate access to all systems and community.', 'successcircles' ),
						'featured' => true,
					),
					array(
						'name'     => __( 'Monthly commitment', 'successcircles' ),
						'price'    => '$797',
						'save'     => __( 'Three months', 'successcircles' ),
						'text'     => __( 'Split your investment over 3 months with full access to all acceleration tools.', 'successcircles' ),
						'featured' => false,
					),
				),
				'compare'  => array(
					array(
						'term' => __( 'What this represents', 'successcircles' ),
						'text' => __( 'A fraction of what you&rsquo;d spend on one remote team member for 90 days &mdash; but this accelerates how you operate for the rest of your career, and shows you how to build support systems instead of expensive payrolls.', 'successcircles' ),
					),
					array(
						'term' => __( 'What this replaces', 'successcircles' ),
						'text' => __( 'Years of trying to figure this out alone, thousands in scattered coaching investments, tens of thousands in unnecessary hiring costs, and the opportunity cost of staying stuck in operator mode.', 'successcircles' ),
					),
				),
				'objection' => array(
					'title' => __( 'But I don&rsquo;t have time.', 'successcircles' ),
					'text'  => __( 'Stop. You might think: &ldquo;I don&rsquo;t have time.&rdquo; But if you&rsquo;re on this page, you already have enough time to stay stuck. What you&rsquo;re missing is structure, relentless accountability, and the right tools. That&rsquo;s exactly what we give you. The brutal truth: you don&rsquo;t have time not to do this.', 'successcircles' ),
				),
			),

			'paths'    => array(
				'title' => __( 'Two paths diverge.', 'successcircles' ),
				'items' => array(
					array(
						'label' => __( 'Path A', 'successcircles' ),
						'name'  => __( 'Stay the course', 'successcircles' ),
						'text'  => __( 'Close this page and return to your sophisticated prison. Spend the next 90 days handling the same crises, fighting the same fires, making incremental progress while your biggest vision waits. Watch competitors implement AI systems and build scalable operations while you remain the bottleneck.', 'successcircles' ),
					),
					array(
						'label' => __( 'Path B', 'successcircles' ),
						'name'  => __( 'Accelerate into the leader you&rsquo;re meant to be', 'successcircles' ),
						'text'  => __( 'Apply now and use these next 90 days to become the visionary your business needs. Implement AI systems that reclaim your time. Build processes that scale without you. Surround yourself with people who accelerate your success. Most importantly, rediscover that business success can be fun.', 'successcircles' ),
					),
				),
				'close' => __( 'The next 90 days are coming whether you accelerate or not. The only question is whether you&rsquo;ll use them to break through, or stay exactly where you are.', 'successcircles' ),
			),

			'fit'      => array(
				'title' => __( 'This program is application-only.', 'successcircles' ),
				'lede'  => __( 'We carefully select who joins our visionary circles. You&rsquo;re the right fit if:', 'successcircles' ),
				'items' => array(
					__( 'You&rsquo;re committed to acceleration, not just information.', 'successcircles' ),
					__( 'You can commit to 4 huddles per month, minimum.', 'successcircles' ),
					__( 'You&rsquo;re ready for laser feedback and hot seat coaching.', 'successcircles' ),
					__( 'You&rsquo;re willing to be unreasonably dedicated to your breakthrough goal.', 'successcircles' ),
					__( 'You understand that visionary leaders invest in systems that multiply their impact.', 'successcircles' ),
					__( 'You&rsquo;re ready to dare to play bigger and better, and have fun while you win.', 'successcircles' ),
				),
				'steps' => array(
					__( 'Apply now and complete the intro questionnaire.', 'successcircles' ),
					__( 'Applications are reviewed within 24 hours.', 'successcircles' ),
					__( 'You&rsquo;ll hear directly from Joseph about your acceptance.', 'successcircles' ),
				),
			),
		),

		// Canonical organisation facts, for structured data and llms.txt. The
		// visible contact channels above are display copy; these are the machine
		// readable equivalents, so schema never drifts from a hand-typed literal.
		'org' => array(
			'name'          => __( 'SuccessCircles', 'successcircles' ),
			'legal_name'    => __( 'SuccessCircles', 'successcircles' ),
			'founding_date' => '2005',
			'phone'         => '+1-747-224-7253',
			'map'           => 'https://g.page/successcircles',
			'address'       => array(
				'street'   => __( '290 5th Ave, 5th Floor', 'successcircles' ),
				'locality' => __( 'New York', 'successcircles' ),
				'region'   => 'NY',
				'postal'   => '10001',
				'country'  => 'US',
			),
		),

		'footer' => array(
			'blurb'   => __( 'A peer execution system and advisory community for established entrepreneurs. Since 2005.', 'successcircles' ),
			'columns' => array(
				array(
					'heading' => __( 'Programs', 'successcircles' ),
					'menu'    => 'footer_programs',
					'links'   => array(
						array(
							'label' => __( 'Momentum Braintrust Buddy', 'successcircles' ),
							'url'   => '/momentum-buddy/',
						),
						array(
							'label' => __( 'Momentum Labs', 'successcircles' ),
							'url'   => '/momentum-labs/',
						),
						array(
							'label' => __( 'Momentum Team', 'successcircles' ),
							'url'   => '/momentum-team/',
						),
						array(
							'label' => __( 'Momentum OS', 'successcircles' ),
							'url'   => '#system',
						),
					),
				),
				array(
					'heading' => __( 'Explore', 'successcircles' ),
					'menu'    => 'footer_explore',
					'links'   => array(
						array(
							'label' => __( 'Entrepreneur Test', 'successcircles' ),
							'url'   => '#test',
						),
						array(
							'label' => __( 'Success Stories', 'successcircles' ),
							'url'   => '/testimonials/',
						),
						array(
							'label' => __( 'Rules for Success', 'successcircles' ),
							'url'   => '/rules-for-success/',
						),
						array(
							'label' => __( 'FAQ', 'successcircles' ),
							'url'   => '/faq/',
						),
						array(
							'label' => __( 'Momentum Buzz', 'successcircles' ),
							'url'   => '/weekly-wins/',
						),
					),
				),
				array(
					'heading' => __( 'Company', 'successcircles' ),
					'menu'    => 'footer_company',
					'links'   => array(
						array(
							'label' => __( 'About', 'successcircles' ),
							'url'   => '/about/',
						),
						array(
							'label' => __( 'Joseph JV Varghese', 'successcircles' ),
							'url'   => '/about/',
						),
						array(
							'label' => __( 'Contact', 'successcircles' ),
							'url'   => '/contact-us/',
						),
						array(
							'label' => __( 'Member Login', 'successcircles' ),
							'url'   => 'https://www.successcircles.com/member-resources/',
						),
						array(
							'label' => __( 'Affiliates', 'successcircles' ),
							'url'   => 'https://ilovemomentum.com/',
						),
					),
				),
			),
			'legal'   => array(
				array(
					'label' => __( 'Privacy', 'successcircles' ),
					'url'   => 'https://www.successcircles.com/privacy-policy/',
				),
				array(
					'label' => __( 'Terms', 'successcircles' ),
					'url'   => 'https://www.successcircles.com/terms-conditions/',
				),
			),
			'social'  => array(
				array(
					'label' => __( 'LinkedIn', 'successcircles' ),
					'url'   => 'https://www.linkedin.com/company/successcircles',
				),
				array(
					'label' => __( 'YouTube', 'successcircles' ),
					'url'   => 'https://youtube.com/successcircles',
				),
				array(
					'label' => __( 'Facebook', 'successcircles' ),
					'url'   => 'https://facebook.com/successcircles',
				),
				array(
					'label' => __( 'X', 'successcircles' ),
					'url'   => 'https://twitter.com/successcircles',
				),
			),
			'phone'   => __( 'Tel +1 (747) 2CIRCLE &nbsp;/&nbsp; +1 (747) 224-7253', 'successcircles' ),
		),

		// The Entrepreneur Test modal. The questions themselves are `sc_question`
		// posts — Entrepreneur Test in the admin menu, not this file.
		'quiz'  => array(
			'eyebrow'      => __( 'The Entrepreneur Test', 'successcircles' ),
			'intro'        => __( 'One question at a time. No wrong answers &mdash; just an honest read.', 'successcircles' ),
			'close'        => __( 'Close the test', 'successcircles' ),
			'back'         => __( 'Back', 'successcircles' ),
			'form_title'   => __( 'Where should we reach you?', 'successcircles' ),
			'form_lede'    => __( 'Your answers are in. Tell us who to reach and someone from SuccessCircles will come back to you personally.', 'successcircles' ),
			'name'         => __( 'Full name', 'successcircles' ),
			'email'        => __( 'Email', 'successcircles' ),
			'phone'        => __( 'Phone', 'successcircles' ),
			'submit'       => __( 'Send my answers', 'successcircles' ),
			'sending'      => __( 'Sending&hellip;', 'successcircles' ),
			'privacy'      => __( 'We use this to reach you about your answers, and nothing else.', 'successcircles' ),
			'error'        => __( 'Something went wrong. Please try again.', 'successcircles' ),
			'done_eyebrow' => __( 'Done', 'successcircles' ),
			'done_title'   => __( 'Thank you &mdash; that&rsquo;s the honest version.', 'successcircles' ),
			'done_lede'    => __( 'Your answers are with us. Someone from SuccessCircles will read them properly and come back to you within one business day.', 'successcircles' ),
			'done_cta'     => __( 'Close', 'successcircles' ),
		),

		'links' => array(
			'member_login' => 'https://www.successcircles.com/member-resources/',
			'apply'        => 'https://peersc.com/applyscsite',
			'test'         => '#test',
		),
	);

	/**
	 * Filter the homepage content tree.
	 *
	 * @param array<string, mixed> $tree Content tree.
	 */
	$tree = apply_filters( 'successcircles_content_tree', $tree );

	return $tree;
}

/**
 * Read a value from the content tree using dot notation.
 *
 * @param string $path    Dot-delimited path, e.g. 'hero.title'.
 * @param mixed  $default Fallback when the path is missing.
 * @return mixed
 */
function successcircles_content( $path, $default = '' ) {
	$value = successcircles_content_tree();

	foreach ( explode( '.', $path ) as $segment ) {
		if ( is_array( $value ) && array_key_exists( $segment, $value ) ) {
			$value = $value[ $segment ];
		} else {
			return $default;
		}
	}

	return $value;
}
