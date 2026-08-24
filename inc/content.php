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
						'url'   => 'https://www.momentumbuddy.com/',
					),
					array(
						'label' => __( 'Momentum Labs', 'successcircles' ),
						'url'   => 'https://momentumhuddle.com/',
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
						'url'   => '/about/#corevalues',
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
			'title'   => __( 'Two ways in. Same <br>operating rhythm.', 'successcircles' ),
			'lede'    => __( 'One is a peer who knows your business by name. The other is a room of operators who&rsquo;ve solved your problem before. Most members start with one and add the other.', 'successcircles' ),
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
					'cta'      => __( 'Apply for Momentum Buddy', 'successcircles' ),
					'cta_url'  => 'https://www.momentumbuddy.com/',
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
					'cta'      => __( 'Join Momentum Labs', 'successcircles' ),
					'cta_url'  => 'https://momentumhuddle.com/',
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
			'index'   => '09',
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
							'url'   => 'https://www.momentumbuddy.com',
						),
						array(
							'label' => __( 'Momentum Labs', 'successcircles' ),
							'url'   => 'https://momentumhuddle.com/',
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
