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
function successcircles_content_tree( $customized = true ) {
	static $tree = null;

	if ( null !== $tree ) {
		return $customized ? successcircles_customize_link_tree( $tree ) : $tree;
	}

	$tree = array(

		'loader' => array(
			'label' => __( 'Powered by Momentum OS&trade;', 'successcircles' ),
		),

		'nav' => array(
			array(
				'label'    => __( 'Programs', 'successcircles' ),
				'url'      => '#programs',
				'children' => array(
					array(
						'label' => __( 'Momentum Buddy&trade;', 'successcircles' ),
						'url'   => '/momentum-buddy/',
					),
					array(
						'label' => __( 'Momentum Labs™', 'successcircles' ),
						'url'   => '/momentum-labs/',
					),
					array(
						'label' => __( 'Momentum Team', 'successcircles' ),
						'url'   => '/momentum-team/',
					),
				),
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
						'label' => __( 'How It Works', 'successcircles' ),
						'url'   => '/momentum-os/',
					),
					array(
						'label' => __( 'FAQ', 'successcircles' ),
						'url'   => '/faq/',
					),
					array(
						'label' => __( 'About Joseph', 'successcircles' ),
						'url'   => '/about-joseph-varghese/',
					),
				),
			),
			array(
				'label' => __( 'Contact', 'successcircles' ),
				'url'   => '/contact-us/',
			),
		),

		'hero' => array(
			'eyebrow'       => __( 'Advisory Community for Established Entrepreneurs', 'successcircles' ),
			'title'         => __( '<span class="sc-hero__title-line">We help business owners</span><span class="sc-hero__title-line">Turn vision into <em class="sc-accent">momentum</em></span>', 'successcircles' ),
			'lede'          => __( 'Urgent demands can push your biggest goals aside. Success&nbsp;Circles&trade; gives you the focus, accountability, and support to follow through and make consistent progress.', 'successcircles' ),
			'primary_cta'   => __( 'Take the Entrepreneur Test', 'successcircles' ),
			'secondary_cta' => __( 'Check Our Programs', 'successcircles' ),
			'meta'          => array(
				__( 'Founded in 2005', 'successcircles' ),
				__( 'Ongoing Accountability + Peer Support', 'successcircles' ),
				__( 'Curated membership', 'successcircles' ),
			),
			'image_alt'     => __( 'An entrepreneur joining a video call from a shared workspace', 'successcircles' ),
			'badge_text'    => __( 'One priority. One focused call. Thirty minutes.', 'successcircles' ),
		),

		'trust' => array(
			'label' => __( 'As seen in', 'successcircles' ),
			'logos' => array(
				array(
					'src'  => SUCCESSCIRCLES_URI . '/assets/img/inc.svg',
					'alt'  => __( 'Inc.', 'successcircles' ),
					'note' => '',
				),
				array(
					'src'  => SUCCESSCIRCLES_URI . '/assets/img/trustpilot.svg',
					'alt'  => __( 'Trustpilot', 'successcircles' ),
					'note' => __( 'Rated Excellent', 'successcircles' ),
				),
			),
			'names' => array(
				array(
					'name' => __( 'Michael Gerber,', 'successcircles' ),
					'note' => __( 'The E-Myth', 'successcircles' ),
				),
			),
		),

		'problem' => array(
			'index'   => '01',
			'eyebrow' => __( 'The problem', 'successcircles' ),
			'title'   => __( 'Big goals keep losing to <br><em class="sc-accent">urgent work</em>.', 'successcircles' ),
			'lede'    => __( 'Without a structure that protects your priorities, the work that moves the business keeps slipping.', 'successcircles' ),
			'quote'   => __( 'The main thing is to keep the main thing the main thing.', 'successcircles' ),
			'items'   => array(
				array(
					'title' => __( 'The hardest decisions still land on you', 'successcircles' ),
					'text'  => __( 'Your team cares, but they cannot always challenge you as another experienced owner can.', 'successcircles' ),
				),
				array(
					'title' => __( 'Important work keeps slipping', 'successcircles' ),
					'text'  => __( 'The priority that could change the business slips a week, then a quarter.', 'successcircles' ),
				),
				array(
					'title' => __( 'No one holds the owner accountable', 'successcircles' ),
					'text'  => __( 'You hold everyone else to a standard, while your own commitments are the easiest to move.', 'successcircles' ),
				),
				array(
					'title' => __( 'Urgent work drowns real growth', 'successcircles' ),
					'text'  => __( 'A calendar full of urgent tasks can still leave the business exactly where it was.', 'successcircles' ),
				),
			),
		),

		'system' => array(
			'index'   => '03',
			'eyebrow' => __( 'The system', 'successcircles' ),
			'title'   => __( 'Powered by <br><span class="sc-accent">Momentum OS™</span>', 'successcircles' ),
			'lede'    => __( 'Momentum OS™ is the repeatable weekly operating rhythm behind Success Circles&trade;. It helps you choose the priority, commit to it, get focused feedback, take action, and review what changed. So important work keeps moving when daily demands compete for your attention.', 'successcircles' ),
			'formula' => array(
				__( 'Experienced owners', 'successcircles' ),
				__( 'Clear priorities', 'successcircles' ),
				__( 'Accountability', 'successcircles' ),
				__( 'Follow-through', 'successcircles' ),
			),
			'result'  => __( 'Consistent progress', 'successcircles' ),
			'steps'   => array(
				array(
					'title' => __( 'Clarify', 'successcircles' ),
					'text'  => __( 'Name the one priority that actually moves the business this week.', 'successcircles' ),
					'alpha' => '1',
				),
				array(
					'title' => __( 'Commit', 'successcircles' ),
					'text'  => __( 'Tell an experienced owner exactly what you will complete before the next check-in.', 'successcircles' ),
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
					'text'  => __( 'Repeat the cycle until steady progress becomes how you operate.', 'successcircles' ),
					'alpha' => '0.2',
				),
			),
		),

		'huddle' => array(
			'index'   => '02',
			'eyebrow' => __( 'What is a huddle?', 'successcircles' ),
			'title'   => __( 'A short call that keeps <br>the day <em class="sc-accent">on track</em>.', 'successcircles' ),
			'lede'    => __( 'Every weekday, you meet a carefully matched business owner for a thirty-minute huddle. You review what moved, work through one obstacle, and commit to one high-impact action before the next call.', 'successcircles' ),
			'items'   => array(
				array(
					'title' => __( 'Review', 'successcircles' ),
					'text'  => __( 'Recognize completed work and what made it possible.', 'successcircles' ),
				),
				array(
					'title' => __( 'Unblock', 'successcircles' ),
					'text'  => __( 'Work through the one obstacle slowing your progress.', 'successcircles' ),
				),
				array(
					'title' => __( 'Commit', 'successcircles' ),
					'text'  => __( 'Choose one high-impact action to complete before the next huddle.', 'successcircles' ),
				),
				array(
					'title' => __( 'Challenge', 'successcircles' ),
					'text'  => __( 'Test assumptions before they become expensive decisions.', 'successcircles' ),
				),
				array(
					'title' => __( 'Execute', 'successcircles' ),
					'text'  => __( 'Do the work between huddles, with the deadline already public.', 'successcircles' ),
				),
			),
			'hub'     => __( 'The daily loop', 'successcircles' ),
			'quote'   => __( 'Every call turns an important goal into one clear decision and one next commitment.', 'successcircles' ),
		),

		'community' => array(
			'index'   => '04',
			'eyebrow' => __( 'The community', 'successcircles' ),
			'title'   => __( 'Business owners who <br>understand the <em class="sc-accent">weight</em>.', 'successcircles' ),
			'lede'    => __( 'Membership includes full access to the Success Circles&trade; community: a platform, a roster, and live sessions where experienced entrepreneurs help one another stay focused and follow through.', 'successcircles' ),
			'items'   => array(
				array(
					'title' => __( 'Momentum Community platform', 'successcircles' ),
					'text'  => __( 'Access the member roster and choose who you want to partner with.', 'successcircles' ),
				),
				array(
					'title' => __( 'Live group huddles', 'successcircles' ),
					'text'  => __( 'Weekly and monthly sessions: AI Pro, Time Mastery, and Week-in-Celebration.', 'successcircles' ),
				),
				array(
					'title' => __( 'Monthly Sprints', 'successcircles' ),
					'text'  => __( 'Gamified sprints to encourage progress in Cashflow Sprint, 3-Day AI, and Simplify Sprint.', 'successcircles' ),
				),
				array(
					'title' => __( 'Candid feedback', 'successcircles' ),
					'text'  => __( 'Experienced owners who understand the stakes and will challenge your thinking.', 'successcircles' ),
				),
			),
			'link'    => array(
				'label' => __( 'Explore the community', 'successcircles' ),
				'url'   => '/momentum-buddy/',
			),
		),

		'programs' => array(
			'index'   => '05',
			'eyebrow' => __( 'Programs', 'successcircles' ),
			'title'   => __( 'One goal. <br>Three levels of <em class="sc-accent">support</em>.', 'successcircles' ),
			'lede'    => __( 'Experienced peer insight, focused one-to-one accountability, or an intensive 90-day AI accelerator. Every path is designed to turn priorities into consistent follow-through.', 'successcircles' ),
			'cards'   => array(
				array(
					'featured' => false,
					'kind'     => __( 'Group', 'successcircles' ),
					'price'    => '$97',
					'title'    => __( 'Momentum Labs™', 'successcircles' ),
					'flag'     => '',
					'text'     => __( 'Bring your toughest priorities to experienced entrepreneurs who understand the pressure of ownership. Weekly huddles and strategic sprints turn outside perspective into practical next steps.', 'successcircles' ),
					'features' => array(
						__( 'Group huddles', 'successcircles' ),
						__( 'Strategic sprints', 'successcircles' ),
						__( 'Collaborative problem solving', 'successcircles' ),
						__( 'Community and shared resources', 'successcircles' ),
					),
					'cta'      => __( 'Apply to Join Momentum Labs™', 'successcircles' ),
					'cta_url'  => '/momentum-labs/',
				),
				array(
					'featured' => true,
					'kind'     => __( 'One-to-one', 'successcircles' ),
					'price'    => '$194',
					'title'    => __( 'Momentum Buddy&trade;', 'successcircles' ),
					'flag'     => __( 'Recommended start', 'successcircles' ),
					'text'     => __( 'Short weekday accountability calls with an experienced business owner selected around your goals. Partners rotate in focused cycles, giving you fresh perspective and a dependable reason to follow through.', 'successcircles' ),
					'features' => array(
						__( 'Matched with experienced business owners', 'successcircles' ),
						__( 'Recurring weekday huddles', 'successcircles' ),
						__( 'Priorities, commitments, course correction', 'successcircles' ),
						__( 'Full Success Circles&trade; community access', 'successcircles' ),
						__( 'Also includes everything in Momentum Labs™', 'successcircles' ),
					),
					'cta'      => __( 'Apply to Join Momentum Buddy&trade;', 'successcircles' ),
					'cta_url'  => '/momentum-buddy/',
				),
				array(
					'featured' => false,
					'kind'     => __( '90-Day AI Accelerator', 'successcircles' ),
					'price'    => '$797',
					'title'    => __( 'Momentum Team', 'successcircles' ),
					'flag'     => __( 'AI + Strategy', 'successcircles' ),
					'text'     => __( 'A 90-day year cohort for owners ready to move from daily operator to strategic leader. Build practical systems, strengthen delegation, and complete one major goal with focused support.', 'successcircles' ),
					'features' => array(
						__( 'Personal advisory board of entrepreneurs', 'successcircles' ),
						__( 'Personalised daily AI coach', 'successcircles' ),
						__( 'Three one-to-one Momentum coach calls', 'successcircles' ),
						__( 'AI mastery training and implementation', 'successcircles' ),
						__( 'Also includes everything in Momentum Buddy&trade;', 'successcircles' ),
					),
					'cta'      => __( 'Apply to Join Momentum Team', 'successcircles' ),
					'cta_url'  => '/momentum-team/',
				),
			),
			'note'     => array(
				'before' => __( 'Not sure which fits?', 'successcircles' ),
				'link'   => __( 'The Entrepreneur Test', 'successcircles' ),
				'after'  => __( 'points you to one in about five minutes.', 'successcircles' ),
			),
			'includes_eyebrow' => __( 'Included with every program', 'successcircles' ),
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
			'index'   => '06',
			'eyebrow' => __( 'How it works', 'successcircles' ),
			'title'   => __( 'Choose a goal. <br>Build progress every week.', 'successcircles' ),
			'steps'   => array(
				array(
					'title' => __( 'Tell us the goal', 'successcircles' ),
					'text'  => __( 'A brief application, then a facilitator reaches out to confirm this is the right fit before anything starts.', 'successcircles' ),
					'alpha' => '1',
				),
				array(
					'title' => __( 'Meet your accountability partner', 'successcircles' ),
					'text'  => __( 'A short questionnaire about your business, strengths, and 90-day goal helps us match the right partner.', 'successcircles' ),
					'alpha' => '0.75',
				),
				array(
					'title' => __( 'Huddle and execute', 'successcircles' ),
					'text'  => __( 'Weekday huddles keep the priority named, the commitment public, and the week honest.', 'successcircles' ),
					'alpha' => '0.5',
				),
				array(
					'title' => __( 'Repeat what works', 'successcircles' ),
					'text'  => __( 'Each cycle gives you evidence, feedback, and a stronger standard for the next week.', 'successcircles' ),
					'alpha' => '0.28',
				),
			),
		),

		'stories' => array(
			'index'         => '07',
			'eyebrow'       => __( 'Success stories', 'successcircles' ),
			'title'         => __( 'Experienced owners <br>making <em class="sc-accent">meaningful progress</em>.', 'successcircles' ),
			'links'         => array(
				array(
					'label' => __( 'Read More Success Stories', 'successcircles' ),
					'url'   => '/testimonials/',
				),
				array(
					'label' => __( 'Momentum Buzz', 'successcircles' ),
					'url'   => '/weekly-wins/',
				),
			),
			'video'         => array(
				'embed_url'  => 'https://player.vimeo.com/video/870306260?title=0&byline=0&portrait=0&autoplay=1',
				'title'      => __( 'How experienced owners turn goals into progress', 'successcircles' ),
				'duration'   => __( '2 min', 'successcircles' ),
				'poster_alt' => __( 'Joseph Varghese, founder of Success Circles&trade;', 'successcircles' ),
			),
			'feature_quote' => array(
				'text' => __( 'I just had my breakthrough VIP session with Joseph. Learning about Success Circles&trade; was very exciting to me. They have created something unique and affordable that brings tremendous value to business owners. Joseph was so generous and giving of his time that I signed up without him ever asking me to join. This was exactly what I was looking for.', 'successcircles' ),
				'name' => __( 'Dr. William Song', 'successcircles' ),
				'role' => __( 'Owner &amp; CEO, Omni Aesthetics &middot; Co-founder of GUBUM &middot; Investor &middot; Inventor', 'successcircles' ),
			),
			'quotes'        => array(
				array(
					'text' => __( 'Success Circles&trade; is an amazing experience like no other. I found out things about myself that I did not know, by simply talking my self to my buddy. Having an accountability buddy gets you in the right momentum to succeed. What an incredible program and experience.', 'successcircles' ),
					'name' => __( 'Andy Zapata', 'successcircles' ),
					'role' => __( 'Founder &amp; CEO, IKON EMR &middot; Serial Entrepreneur &middot; Top 500 Entrepreneur Magazine Franchise Winner &middot; 50+ Franchises and growing &middot; Miami, Florida', 'successcircles' ),
				),
				array(
					'text' => __( 'Being a part of the Success Circles&trade; community is sooo amazing! I am so appreciative of what Joseph and the Success Circles&trade; Team are doing! As a subject matter expert in the small business space, it is critical that I have someone to hold me accountable in MY daily activities. I am honored and blessed to be connected with such a dynamic community!!!', 'successcircles' ),
					'name' => __( 'Robin Haynes, MBA', 'successcircles' ),
					'role' => __( 'Business Advisor at Goldman Sachs 10,000 Small Businesses', 'successcircles' ),
				),
			),
		),

		'test' => array(
			'index'   => '08',
			'eyebrow' => __( 'The Entrepreneur Test', 'successcircles' ),
			'title'   => __( 'Are you running your business, or is it running you?', 'successcircles' ),
			'lede'    => __( 'Twelve practical questions reveal where urgent demands are crowding out growth, then point you toward the level of support that fits your business.', 'successcircles' ),
			'cta'     => __( 'Take the Entrepreneur Test', 'successcircles' ),
			'note'    => __( '5 minutes', 'successcircles' ),
		),

		'founder' => array(
			'index'         => '09',
			'eyebrow'       => __( 'Founder', 'successcircles' ),
			'name'          => __( 'Joseph JV Varghese', 'successcircles' ),
			'portrait'      => SUCCESSCIRCLES_URI . '/assets/img/founder-portrait.png',
			'portrait_alt'  => __( 'Joseph Varghese, founder of Success Circles&trade;', 'successcircles' ),
			'signature'     => SUCCESSCIRCLES_URI . '/assets/img/founder-signature.png',
			'signature_alt' => __( 'Signature of Joseph Varghese', 'successcircles' ),
			'bio'           => __( 'Joseph founded Success Circles&trade; in 2005 around a simple observation: business owners made more progress when someone understood their goals and held them to their commitments. Drawing on his engineering background, he turned that insight into a practical rhythm of focused conversations, clear priorities, and consistent follow-through.', 'successcircles' ),
			'bio_secondary' => __( 'Two decades later, that approach brings together established entrepreneurs who understand the demands of building and leading a business. Through honest conversations, shared experience, and regular accountability, members help one another make clearer decisions, protect time for their biggest goals, and move important work forward &mdash; with support they can count on.', 'successcircles' ),
			'link'          => array(
				'label' => __( 'Meet Joseph', 'successcircles' ),
				'url'   => '/about-joseph-varghese/',
			),
		),

		// Public destinations from linktr.ee/rulesforsuccess, verified September 18, 2026.
		'article_links' => array(
			'links' => array(
				array( 'label' => __( 'RulesforSuccess.com', 'successcircles' ), 'url' => 'https://www.successcircles.com/blog' ),
				array( 'label' => __( 'Apply Now to be on our Podcast!', 'successcircles' ), 'url' => 'https://successcircles.typeform.com/to/O9SsWYf2' ),
				array( 'label' => __( 'Rules For Success on Spotify', 'successcircles' ), 'url' => 'https://open.spotify.com/show/64eUCSg7BqAo0EJf8cOp97?si=efea62f410044ab0' ),
				array( 'label' => __( 'Rules For Success on Apple', 'successcircles' ), 'url' => 'https://podcasts.apple.com/us/podcast/rules-for-success/id1714987733' ),
				array( 'label' => __( 'Momentum Tips on Spotify', 'successcircles' ), 'url' => 'https://podcasters.spotify.com/pod/show/momentumtips' ),
				array( 'label' => __( 'Momentum Tips on Apple', 'successcircles' ), 'url' => 'https://podcasts.apple.com/us/podcast/momentum-tips/id1714988436' ),
				array( 'label' => __( 'Stream Rules for Success on Audible', 'successcircles' ), 'url' => 'https://www.audible.com/podcast/Rules-For-Success/B0CLBMNCRL?source_code=ASSGB149080119000H&share_location=pdp' ),
				array( 'label' => __( 'Rules For Success | iHeart', 'successcircles' ), 'url' => 'https://www.iheart.com/podcast/269-rules-for-success-126810114/?' ),
				array( 'label' => __( 'Success Circles TikTok', 'successcircles' ), 'url' => 'https://www.tiktok.com/@successcircles' ),
				array( 'label' => __( 'Success Circles Braintrust Programs - Learn More', 'successcircles' ), 'url' => 'https://successcircles.com' ),
			),
			'social' => array(
				array( 'label' => 'Facebook', 'url' => 'https://www.facebook.com/rulesforsuccess' ),
				array( 'label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/company/successcircles' ),
				array( 'label' => 'Instagram', 'url' => 'https://instagram.com/success.circles' ),
				array( 'label' => 'YouTube', 'url' => 'https://www.youtube.com/@successcircles' ),
				array( 'label' => 'TikTok', 'url' => 'https://www.tiktok.com/@successcircles' ),
			),
		),

		'podcast' => array(
			'brand_url' => 'https://rulesforsuccess.com/',
			'index'    => '08',
			'eyebrow'  => __( 'RULESFORSUCCESS.COM', 'successcircles' ),
			'title'    => __( 'Success leaves clues.', 'successcircles' ),
			'link'     => array(
				'label' => __( 'All episodes', 'successcircles' ),
				'url'   => '/rules-for-success/',
			),
			'empty'    => __( 'The first episodes are being recorded. Check back shortly.', 'successcircles' ),
		),

		'faq' => array(
			'index'   => '10',
			'eyebrow' => __( 'Questions', 'successcircles' ),
			'title'   => __( 'The ones owners <br>actually ask.', 'successcircles' ),
			'link'    => array(
				'label' => __( 'Read the full FAQ', 'successcircles' ),
				'url'   => '/faq/',
			),
			'items'   => array(
				array(
					'question' => __( 'How often do I get a new buddy?', 'successcircles' ),
					'answer'   => __( 'You usually work with the same accountability partner for two to four weeks. Regular rotation brings fresh perspective while each cycle gives you enough time to build trust and follow through.', 'successcircles' ),
				),
				array(
					'question' => __( 'How do you know my buddy is the right fit?', 'successcircles' ),
					'answer'   => __( 'We match on goals and strengths: if another member is strong where you want to grow, or has already reached the goal you&rsquo;re aiming at, we pair you. Members rate each experience and can request a specific buddy.', 'successcircles' ),
				),
				array(
					'question' => __( 'Why another business owner instead of a coach?', 'successcircles' ),
					'answer'   => __( 'Another experienced owner understands the weight of decisions, team responsibility, and competing priorities. You keep control of your decisions while gaining honest perspective and mutual accountability.', 'successcircles' ),
				),
				array(
					'question' => __( 'What if it doesn&rsquo;t work for me?', 'successcircles' ),
					'answer'   => __( 'You have a 30-day trial, two partnership cycles. Unhappy with your results for any reason, and we refund your investment.', 'successcircles' ),
				),
			),
		),

		'faq_page' => array(
			'eyebrow' => __( 'Frequently asked questions', 'successcircles' ),
			'title'   => __( 'Everything owners <em class="sc-accent">actually</em> ask.', 'successcircles' ),
			'lede'    => __( 'Success Circles&trade; gives established entrepreneurs structured accountability, trusted outside perspective, and a consistent rhythm for moving important goals forward. Here is what membership looks like in practice.', 'successcircles' ),
			'groups'  => array(
				array(
					'label' => __( 'The system', 'successcircles' ),
					'items' => array(
						array(
							'question' => __( 'What are the benefits of joining Success Circles&trade;?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'As a member, you will:', 'successcircles' ) ),
								array(
									'list' => array(
										__( 'Protect time for the goals that matter most to your business.', 'successcircles' ),
										__( 'Make clearer decisions with perspective from experienced owners.', 'successcircles' ),
										__( 'Follow through consistently because someone will check back.', 'successcircles' ),
										__( 'Turn large goals into practical weekly commitments.', 'successcircles' ),
										__( 'Build habits that continue working after motivation fades.', 'successcircles' ),
										__( 'Lead without carrying every difficult decision alone.', 'successcircles' ),
										__( 'Gain confidence from visible, measurable progress.', 'successcircles' ),
										__( 'Get immediate access to $10,000 in resources for peak performance, energy management, delegation, focus, and automation on joining the Momentum Buddy&trade; Action program.', 'successcircles' ),
									),
								),
							),
						),
						array(
							'question' => __( 'How does it work?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'You begin each check-in by reviewing what moved, choosing the next priority, and making a specific commitment. One-to-one calls provide focused accountability, while optional group huddles add broader experience and practical feedback.', 'successcircles' ) ),
								array( 'p' => __( 'The rhythm is simple: decide, commit, act, review, and adjust. Repeating that cycle keeps meaningful work moving even when the week becomes busy.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'What makes Success Circles&trade; sustainable?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'Every conversation follows the same focused questions, so little time is wasted deciding what to discuss. You leave with one clear commitment, complete the work, and report back. The value comes from repetition and follow-through, not more content to consume.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'How does this improve time management and productivity?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'Through our process, you&rsquo;ll:', 'successcircles' ) ),
								array(
									'list' => array(
										__( 'Choose fewer priorities and finish the ones with the greatest impact.', 'successcircles' ),
										__( 'Identify distractions before they consume another week.', 'successcircles' ),
										__( 'Use regular check-ins to keep important commitments visible.', 'successcircles' ),
										__( 'Build routines that create more time for leadership and growth.', 'successcircles' ),
									),
								),
								array( 'p' => __( 'The goal is not a fuller calendar. It is steady movement on the work that changes the business.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'I think I have Attention Deficiency Disorder. Will this help?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'Success Circles&trade; is not medical care and cannot diagnose or treat ADHD. Its structured questions, short commitments, and regular check-ins may help you organize priorities and improve follow-through. Speak with a qualified healthcare professional if attention difficulties are affecting your daily life.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'This sounds complicated. Does it really work?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'The process is intentionally simple: choose a priority, make a specific commitment, complete the work, and review the result. It works best for owners who participate consistently and are willing to be candid about what did and did not get done.', 'successcircles' ) ),
								array( 'p' => __( 'We&rsquo;ve been acknowledged by top leaders in entrepreneurship &mdash; Michael Gerber of the E-Myth, Blair Singer of Rich Dad Poor Dad, and Inc. Magazine, among others.', 'successcircles' ) ),
							),
						),
					),
				),
				array(
					'label' => __( 'Your Momentum Buddy&trade;', 'successcircles' ),
					'items' => array(
						array(
							'question' => __( 'What is a Momentum Buddy™?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'Your Momentum Buddy&trade; is another business owner selected around your goals, experience, and strengths. They help you:', 'successcircles' ) ),
								array(
									'list' => array(
										__( 'Choose the priority that matters most.', 'successcircles' ),
										__( 'Think through roadblocks with an experienced outside perspective.', 'successcircles' ),
										__( 'Follow through on the commitment you made.', 'successcircles' ),
										__( 'Adjust quickly when the evidence changes.', 'successcircles' ),
									),
								),
								array( 'p' => __( 'We pair you with someone complementary to your strengths, so both of you grow in the areas that matter.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'How often will I get a new Momentum Buddy&trade;?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'Buddies are assigned bi-monthly, with a maximum of two cycles &mdash; four weeks &mdash; with the same partner. Partnering with different members and getting fresh feedback is what breaks you through to real results. You can choose daily momentum calls each weekday morning, or three days a week (typically Monday, Wednesday, and Friday).', 'successcircles' ) ),
								array( 'p' => __( 'Assignments are based on your chosen level of accountability, drive for growth, and time availability. You can request a faith-based partner and we&rsquo;ll do our best to match you. Working on a specific area? We&rsquo;ll aim to pair you with a member strong there, or one who has already met a goal you&rsquo;re aiming for. Regular surveys let you rate the experience and request a particular buddy.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'How will I know my buddy can hold me accountable?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'We use a unique process to connect members as Momentum Buddies. If another member is strong in an area you want to grow, we&rsquo;ll do our best to connect you. If someone has already reached a goal you&rsquo;re aiming for, you&rsquo;ll have the chance to learn their winning strategies. You&rsquo;ll also connect virtually with members around the world and can choose your own buddy &mdash; perspective goes a long way.', 'successcircles' ) ),
							),
						),
						array(
							'question' => __( 'Which programs do you offer?', 'successcircles' ),
							'answer'   => array(
								array( 'p' => __( 'Success Circles&trade; currently offers two primary services:', 'successcircles' ) ),
								array(
									'list' => array(
										__( 'Momentum Team 90-Day AI Incubator &mdash; our program where we play the 90-Day Year.', 'successcircles' ),
										__( 'Momentum Buddy&trade; Action &mdash; daily accountability calls, generally one-on-one with a member a step ahead of you in an area you&rsquo;re committed to progressing.', 'successcircles' ),
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
								array( 'p' => __( 'The majority of our members are entrepreneurs, but we have several who are between jobs or transitioning careers. Members who joined during a transition became significantly more engaged in their search and often credit Success Circles&trade; as the accelerating factor that got their career on track. We also have members who aren&rsquo;t entrepreneurs but have the flexibility to hold a consistent call three days a week.', 'successcircles' ) ),
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
				'text'  => __( 'Talk to a facilitator and we&rsquo;ll help you figure out whether Success Circles&trade; is the right room for you.', 'successcircles' ),
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
					'links'  => array(
						array(
							'label' => __( 'WhatsApp', 'successcircles' ),
							'url'   => 'https://wa.me/successcircles',
						),
						array(
							'label' => __( 'Telegram', 'successcircles' ),
							'url'   => 'http://t.me/successcircles',
						),
					),
				),
				array(
					'label'  => __( 'Book a call', 'successcircles' ),
					'value'  => __( 'Calendly', 'successcircles' ),
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
			'lede'          => __( 'Take five minutes to identify what is blocking progress and which level of support can help you move your biggest goal forward.', 'successcircles' ),
			'primary_cta'   => __( 'Take the Entrepreneur Test', 'successcircles' ),
			'secondary_cta' => __( 'Check Our Programs', 'successcircles' ),
		),

		'episodes' => array(
			'eyebrow' => __( 'RULESFORSUCCESS.COM', 'successcircles' ),
			'title'   => __( 'Success leaves clues.', 'successcircles' ),
			'lede'    => __( 'Conversations with founders, operators and advisors about the rules they actually run on &mdash; not the ones they put on a slide.', 'successcircles' ),
			'empty'   => __( 'New episodes are on the way.', 'successcircles' ),
		),

		// The Momentum Buzz page runs on the live Weekly Wins feed — see inc/wins.php.
		// Only the framing copy lives here; every quote comes from the source site.
		'buzz' => array(
			'eyebrow'    => __( 'Momentum Buzz', 'successcircles' ),
			'title'      => __( 'Wins, <em class="sc-accent">week</em> after week.', 'successcircles' ),
			'lede'       => __( 'Every week members post what actually moved &mdash; deals closed, habits held, ceilings broken. No case studies, no composite characters: these are the wins exactly as they were written.', 'successcircles' ),
			'wall_label' => __( 'Member wins', 'successcircles' ),
			'feed_title' => __( 'Every win, in their <em class="sc-accent">own</em> words.', 'successcircles' ),
			'feed_lede'  => __( 'Explore the decisions, milestones, and everyday progress shared by our members.', 'successcircles' ),
			'latest'     => __( 'Latest win', 'successcircles' ),
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
				__( 'Founder of Success Circles&trade;', 'successcircles' ),
				__( 'The Breakthrough Engineer', 'successcircles' ),
			),
			'lede'     => __( 'Joseph John Varghese helps experienced entrepreneurs turn ambitious goals into clear priorities, practical systems, and consistent action. His work is built on a simple belief: the right support can save years of trial and error.', 'successcircles' ),
			'intro'    => array(
				__( 'A moment of clarity <em class="sc-accent">changed everything.</em>', 'successcircles' ),
				__( 'After years as an unfulfilled process engineer, Joseph witnessed the world&rsquo;s resilience and unity after 9/11. Inspired by people stepping up to help one another, he made it his mission to help ambitious people turn meaningful goals into consistent action.', 'successcircles' ),
			),
			'portrait' => array(
				'file'   => 'jv-portrait.png',
				'alt'    => __( 'Joseph Varghese, founder of Success Circles&trade;', 'successcircles' ),
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
						__( 'By 2005, he founded Success Circles&trade; to help established entrepreneurs stay focused and accountable to the goals that mattered most. He saw that owners rarely lacked information; they needed structure, honest perspective, and a dependable reason to follow through.', 'successcircles' ),
						__( 'Success Circles&trade; also became an extension of the JV Alliance family office, established in the honor of Joseph&rsquo;s late father John Varghese who passed away in 2004.', 'successcircles' ),
						__( 'For over 20 years, Joseph has studied performance, productivity, and the systems that help people follow through. He now applies that work to give experienced entrepreneurs clearer priorities, better operating habits, and steady progress on the goals that matter.', 'successcircles' ),
					),
				),
				array(
					'title' => __( 'Modeling Success in the AI Era', 'successcircles' ),
					'body'  => array(
						__( 'Today, Joseph combines his engineering background with practical AI tools that help entrepreneurs reduce routine work, simplify operations, and make more time for high-value leadership. His programs pair those tools with experienced support and consistent accountability.', 'successcircles' ),
						__( 'Joseph is also a sought-after speaker who inspires audiences &mdash; from students to executives &mdash; to balance ambition with purpose and play. His message is simple: Momentum beats motivation.', 'successcircles' ),
					),
				),
				array(
					'title' => __( 'Mission &amp; Legacy', 'successcircles' ),
					'body'  => array(
						__( 'Through Success Circles&trade;, Joseph continues to connect entrepreneurs and professionals committed to growth, accountability, and impact. He calls this mission and his WHY G.I. Joseph &mdash; Generational Impact, a movement to create freedom, fulfillment, and fun for the next generation of owners and leaders.', 'successcircles' ),
					),
				),
			),
		),

		// The Testimonials page. Videos and quotes transcribed from
		// successcircles.com/testimonials/ — see §7f. Weekly member wins are a
		// separate page and a separate content block ('buzz').
		'testimonials' => array(
			'eyebrow'        => __( 'Featured Story', 'successcircles' ),
			'index'          => '01',
			'title'          => __( 'Success, in their <em class="sc-accent">own</em> words.', 'successcircles' ),
			'lede'           => __( 'Real experiences of a peer community: daily accountability, meaningful connections, and progress shared with fellow members.', 'successcircles' ),
			'films_eyebrow'  => __( 'On Camera', 'successcircles' ),
			'films_index'    => '02',
			'films_title'    => __( 'Members, in their <em class="sc-accent">own</em> voice.', 'successcircles' ),
			'films_note'     => __( 'Choose a member story to hear what changed, what they learned, and how the community helped.', 'successcircles' ),
			'play_label'     => __( 'Play', 'successcircles' ),
			'written_eyebrow' => __( 'In Writing', 'successcircles' ),
			'written_index'  => '03',
			'written_title'  => __( 'The community, through <em class="sc-accent">members’</em> eyes.', 'successcircles' ),
			'link'           => array(
				'label' => __( 'Momentum Buzz &mdash; weekly member wins', 'successcircles' ),
				'url'   => '/weekly-wins/',
			),
			'videos' => array(
				array(
					'id'       => '457023345',
					'name'     => __( 'David Vogel', 'successcircles' ),
					'kind'     => __( 'Member story', 'successcircles' ),
					'duration' => '5:25',
					'poster'   => '457023345.jpg',
					'width'    => 1280,
					'height'   => 720,
					'role' => __( 'Founder | Customer Proof & Video Testimonial Strategist', 'successcircles' ),
				),
				array(
					'id'       => '858257750',
					'name'     => __( 'Kabir Wolf', 'successcircles' ),
					'kind'     => __( 'Member story', 'successcircles' ),
					'duration' => '2:01',
					'poster'   => '858257750.jpg',
					'width'    => 960,
					'height'   => 543,
					'role' => __( 'Co-Founder of Wolf Automation | Co-Founder of Ballot Access Pros', 'successcircles' ),
				),
				array(
					'id' => '866788254',
					'name' => __( 'Chris Oldfield', 'successcircles' ),
					'kind' => __( 'Member story', 'successcircles' ),
					'duration' => '',
					'poster' => 'members/chris.jpg',
					'width' => 800,
					'height' => 800,
					'role' => __( 'Founder & CEO, Producer Advantage AI™', 'successcircles' ),
				),
				array(
					'id'       => '561469180',
					'name'     => __( 'Garth Sandiford', 'successcircles' ),
					'kind'     => __( 'Member story', 'successcircles' ),
					'duration' => '1:35',
					'poster'   => '561469180.jpg',
					'width'    => 960,
					'height'   => 543,
					'role' => __( 'Real Estate Agent', 'successcircles' ),
				),
				array(
					'id'       => '668470106',
					'name'     => __( 'Robert Grant', 'successcircles' ),
					'kind'     => __( 'Member story', 'successcircles' ),
					'duration' => '4:30',
					'poster'   => '668470106.jpg',
					'width'    => 1280,
					'height'   => 800,
					'role' => __( 'Facebook Marketing Strategist | Author | Professional Speaker', 'successcircles' ),
				),
				array(
					'id'       => '457144641',
					'name'     => __( 'Ruth Dorsainville', 'successcircles' ),
					'kind'     => __( 'Case study', 'successcircles' ),
					'duration' => '16:59',
					'poster'   => '457144641.jpg',
					'width'    => 960,
					'height'   => 540,
					'role' => __( 'Recruitment Business Strategist | Relocation Specialist', 'successcircles' ),
				),
			),
			'quotes' => array(
				array(
					'name' => __( 'Vanessa Culver', 'successcircles' ),
					'role' => __( 'Senior Manager, Payments at Zillow', 'successcircles' ),
					'text' => __( 'Having an accountable partner as well as group calls to check in with frequently, sharing wins and challenges, and gathering valuable feedback is invaluable. I wouldn\'t be half as motivated without it. I find [the accountability] pushes me to go beyond my comfort zone and achieve even more. I\'m thankful for this group and have seen a tremendous ROI on this investment. I highly recommend it!', 'successcircles' ),
					'image' => 'vanessa.jpg',
					'source' => __( 'Member testimonial', 'successcircles' ),
				),
				array(
					'name' => __( 'Garth Sandiford', 'successcircles' ),
					'role' => __( 'Real Estate Agent', 'successcircles' ),
					'text' => __( 'Being a member of Success Circles™, has been one of my best investments in myself. The daily calls help to keep me on track to achieving my personal and professional outcomes. Joseph and his team are amazing and do a fantastic job.', 'successcircles' ),
					'image' => 'garth.jpg',
					'source' => __( 'Member testimonial', 'successcircles' ),
				),
				array(
					'name' => __( 'Steve Zhou', 'successcircles' ),
					'role' => __( 'Deputy CFO at Post Acute Care', 'successcircles' ),
					'text' => __( 'Success Circles™ is definitely a worthwhile investment. The system has made me more accountable and productive. I lost 10 lbs and achieved my real estate purchase thru consistent daily action. I highly recommend it.', 'successcircles' ),
					'image' => 'steve.jpg',
					'source' => __( 'Member testimonial', 'successcircles' ),
				),
				array(
					'name' => __( 'Ruth Dorsainville', 'successcircles' ),
					'role' => __( 'Recruitment Business Strategist | Relocation Specialist', 'successcircles' ),
					'text' => __( 'Outstanding community. Positive environment. Members include the Top 2% of entrepreneurs and professionals globally.', 'successcircles' ),
					'image' => 'ruth.jpg',
					'source' => __( 'Trustpilot · Feb 10, 2022', 'successcircles' ),
				),
				array(
					'name' => __( 'Geoff “Jeff” Graham', 'successcircles' ),
					'role' => __( '', 'successcircles' ),
					'text' => __( 'I\'ve been a member of Success Circles since 2010. Thanks to the program I have been able to accomplish some amazing things. A few that stand out are: there was this incredibly challenging open mic in LA and my Momentum Buddy supported me to overcome it. I took a sales position and with the help of a Momentum Buddy and despite never having succeeded in sales, I was able to produce results that were impressive to my sales manager. On a personal level and thanks to a Momentum Buddy, I was able to consistently plan enjoyable date nights that were better than just a dinner and a movie. I\'m so grateful that I was introduced to Success Circles and had the open mindedness to get involved. Out of everything I\'ve done in personal development, this could quite possibly the thing that has yielded me the most results.', 'successcircles' ),
					'image' => 'geoff.png',
					'source' => __( 'Google review', 'successcircles' ),
				),
				array(
					'name' => __( 'Peter Gallo', 'successcircles' ),
					'role' => __( '', 'successcircles' ),
					'text' => __( 'Joseph and his team at Success Circles provide an excellent resource for accountability and connection. In the 14 months I have been a member I have met many amazing people and I have grown exponentially. I\'m finding that through their structure, I am able to fast-track many of my business and personal goals. Goals that I once considered long-term have already been achieved and I feel encouraged to reach further and higher than ever before. I am so glad I found Success Circles and only with I found them sooner.', 'successcircles' ),
					'image' => 'peter.png',
					'source' => __( 'Google review', 'successcircles' ),
				),
				array(
					'name' => __( 'George Arroyo', 'successcircles' ),
					'role' => __( 'CEO at Arroyo Construction', 'successcircles' ),
					'text' => __( 'While attending Business Mastery in 2017, I had the good fortune to meet some quality people at the event. After returning home, I began to contemplate what Tony Robbins was saying in regards to "proximity to power". I called Sarah, one of the people at the event, and asked her what Mastermind group she belonged to. She said that she was in a closed group at the moment, but that she was a long-term member of Success Circles and sent me Joseph\'s contact information. On her recommendation alone, I reached out to Joseph and requested to become a member. I am forever grateful that I did. The group connected me with some super achieving individuals who were like minded about achieving business goals. I have been promised by similar groups that their members are making a real difference in setting goals and holding members accountable to meet those goals, but this group delivered. Success Circle members are not just sitting around wishing things will happen, they are out there actually making things happen. I was forced every day to face my issues and work to resolve them, because the next morning I would have to show results to the person I was partnered with. I grew my business, grew my-self and my personal relationships deepened. It is a holistic way of dealing with the complexity of life today. I also have made lifelong friends and contacts that will always be available to me. It is not just about business, although for me, that was the center of it. The community is strong and the leadership is involved daily. Frequently, I will share wins and private happenings in my life with Joseph, even when I am not actively involved with the community. This works because it\'s based on a timeless principle that never fails.', 'successcircles' ),
					'image' => 'george.jpg',
					'source' => __( 'Trustpilot · May 6, 2022', 'successcircles' ),
				),
				array(
					'name' => __( 'Robert Grant', 'successcircles' ),
					'role' => __( 'Facebook Marketing Strategist | Author | Professional Speaker', 'successcircles' ),
					'text' => __( 'The value is immeasurable. They paired me up with amazing people that have helped me grow my business and grow as a human being exponentially and really helped me think out of the box. One of the best decisions i ever made in my life was joining success circles.', 'successcircles' ),
					'image' => 'robert.jpg',
					'source' => __( 'Trustpilot · Jan 20, 2022', 'successcircles' ),
				),
				array(
					'name' => __( 'David Vogel', 'successcircles' ),
					'role' => __( 'Founder | Customer Proof & Video Testimonial Strategist', 'successcircles' ),
					'text' => __( 'I am so grateful for finding Success Circles and Joseph Varghese. I felt that I wasn\'t making the most out of every day of my life and was looking for a way to accelerate my personal development in every area of my life. Not only has daily accountability been transformative in my life but I have got to meet and work with other amazing business leaders that continue to inspire me each and every day. Thank you Success Circles.', 'successcircles' ),
					'image' => 'david.jpg',
					'source' => __( 'Trustpilot · Jan 12, 2022', 'successcircles' ),
				),
				array(
					'name' => __( 'Christopher Oldfield', 'successcircles' ),
					'role' => __( 'Founder & CEO, Producer Advantage AI™', 'successcircles' ),
					'text' => __( 'I subscribed to Success Circles a little more than 2 years ago (September 2019). Utilizing the framework provided, as well as the partners assigned and/or requested, I\'ve identified tasks in my life/businesses that I wouldn\'t normally have thought of which in turn has allowed me to achieve my desired outcomes. In addition, because I hold management and members in high regard, I find that I often push myself further than I normally would in order to deliver (accountability). As a result, I\'m crushing life! Furthermore, I think what really sets Success Circles apart (their X factor) is that management genuinely cares about their clients and making a difference. For anyone looking to level-up or improve their performance, I highly recommend Success Circles.', 'successcircles' ),
					'image' => 'chris.jpg',
					'source' => __( 'Trustpilot · Dec 3, 2021', 'successcircles' ),
				),
				array(
					'name' => __( 'James Rohrbach', 'successcircles' ),
					'role' => __( '', 'successcircles' ),
					'text' => __( 'Success Circles is a great accountability tool. The huddles are magnificent to get and give support.', 'successcircles' ),
					'image' => 'james.png',
					'source' => __( 'Trustpilot · Oct 18, 2023', 'successcircles' ),
				),
				array(
					'name' => __( 'Jonathan Baillie Strong', 'successcircles' ),
					'role' => __( 'Local SEO & Visibility Consultant at Spotlight Signal', 'successcircles' ),
					'text' => __( 'If you\'re looking for an accountability group that will actually help you get things done and build a network of like minded individuals eager to see you succeed, Success Circles is your answer. The frameworks they provide are top notch, and the network of people in the community is second to none. I\'ve never felt so motivated and focused as I have when I\'m a part of this group. Highly recommend!', 'successcircles' ),
					'image' => 'jonathan.jpg',
					'source' => __( 'Trustpilot · Sep 30, 2022', 'successcircles' ),
				),
				array(
					'name' => __( 'Thomas Green', 'successcircles' ),
					'role' => __( 'Co-Founder of The Really Conscious Group', 'successcircles' ),
					'text' => __( 'The service with Success Circles is incredible. (As with anything, you get out what you put in). However, the Success Circles system allows me to request and buddy up with like-minded peers, who each hold each other to a higher standard and continuing accountability to reach each other\'s goals - in a fortnightly rotating mechanism. With a huge measure of gratitude thrown in too, to really accelerate who we show up as and how we are being through our day, week, fortnight…life. I have invested an hour everyday to this for over six months now and my exchange and yield from the accountability partnerships is compounding.', 'successcircles' ),
					'image' => 'thomas.jpg',
					'source' => __( 'Trustpilot · Feb 9, 2022', 'successcircles' ),
				),
				array(
					'name' => __( 'Donal Warde', 'successcircles' ),
					'role' => __( 'Portfolio Strategy & Investment Advisory, Folio Strategy Partners', 'successcircles' ),
					'text' => __( 'As a company founder, the biggest challenges are staying consistent and accountable when you don\'t have someone doing it for you. My Success Circles calls every morning are the foundation of my day. I check in with (typically) a fellow founder and we discuss our goals, potential roadblocks, and some gratitude. It would be really challenging to replicate this structure without working with Success Circles. They enable self-employed folks to work for themselves through their calls. I\'ve been working with them for around six months and I recommend the service to any friend who needs structure as a solo founder.', 'successcircles' ),
					'image' => 'donal.png',
					'source' => __( 'Trustpilot · Feb 5, 2022', 'successcircles' ),
				),
			),
		),

		'about' => array(
			'title'     => __( 'Twenty years helping owners <em class="sc-accent">follow through</em>.', 'successcircles' ),
			'lede'      => __( 'Since 2005, Success Circles&trade; has helped established entrepreneurs protect their priorities, make clearer decisions, and keep meaningful goals moving.', 'successcircles' ),
			'meta'      => array(
				__( 'Owner-to-owner accountability', 'successcircles' ),
				__( 'Built on weekly accountability', 'successcircles' ),
				__( 'Trusted by owners worldwide', 'successcircles' ),
			),
			'bleed_alt' => __( 'Success Circles™ members in a working huddle', 'successcircles' ),

			'mission'   => array(
				'title' => __( 'Make meaningful progress <em class="sc-accent">every week</em>.', 'successcircles' ),
				'lede'  => __( 'Our mission is to help experienced entrepreneurs turn important goals into clear commitments and completed work.', 'successcircles' ),
				'body'  => __( 'Small, measurable improvements build stronger businesses when they happen consistently. We provide the structure, accountability, and community that keep those improvements from being pushed aside by urgent demands.', 'successcircles' ),
			),

			'vision'    => array(
				'title'     => __( 'No owner should carry every important decision alone.', 'successcircles' ),
				'image_alt' => __( 'An entrepreneur working alone at a desk', 'successcircles' ),
				'body'      => array(
					__( 'We are building a community where experienced entrepreneurs can ask for perspective, test decisions, and stay accountable without giving up their independence.', 'successcircles' ),
					__( 'Members turn large goals into practical commitments, track what changes, and make regular course corrections with support from people who understand the realities of ownership.', 'successcircles' ),
					__( 'Focused questions keep every conversation useful. You leave knowing what matters next, what you committed to, and when someone will check back.', 'successcircles' ),
				),
			),

			'values'    => array(
				'title' => __( 'Two vows. <em class="sc-accent">One standard.</em>', 'successcircles' ),
				'lede'  => __( 'Upon joining, every member of Success Circles&trade; makes a commitment to respect and uphold the community&rsquo;s core founding values:', 'successcircles' ),
				// The club's own core-values seal, carrying both vows around its
				// ring — which is why it sits with the section heading rather
				// than beside either vow.
				'badge' => array(
					'file'   => 'core-values.png',
					'alt'    => __( 'Success Circles™ core values seal: make others better than you found them, and aim to be better today than yesterday. #BETTERPRINCIPLES', 'successcircles' ),
					'width'  => 584,
					'height' => 603,
				),
				'items' => array(
					array(
						'title' => __( 'Make <em class="sc-accent">Others Better</em> Than You Found Them', 'successcircles' ),
						'text'  => __( 'You contribute as much as you receive. Every conversation should leave another owner with greater clarity, confidence, or a practical next step.', 'successcircles' ),
					),
					array(
						'title' => __( 'Be <em class="sc-accent">BETTER Today</em> Than Yesterday', 'successcircles' ),
						'text'  => __( 'Choose one measurable improvement, complete it, and build on it. Consistency matters more than dramatic promises.', 'successcircles' ),
					),
				),
			),

			'story'     => array(
				'title' => __( 'How it all got started.', 'successcircles' ),
				'body'  => array(
					__( 'The concept of Success Circles&trade; began 20 years ago in 2005 initially with 8 personal friends including Joseph J. Varghese as an extension of a family office that he began in honor of his late father John Varghese. John Varghese was a master in understanding generational impact and compound growth having invested in helping other members of the family realize their dreams.', 'successcircles' ),
					__( 'The original eight members made stronger progress because their goals were visible, their commitments were specific, and someone checked back. That small group grew into an international community of entrepreneurs.', 'successcircles' ),
					__( 'Today, members are matched with accountability partners who share similar values and relevant experience. When possible, we connect you with someone who has already solved the problem or reached the goal in front of you.', 'successcircles' ),
					__( 'The community creates a higher standard without taking control away from the owner. Honest questions, useful perspective, and regular follow-up help members make better decisions and complete important work.', 'successcircles' ),
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

		// The Momentum Buddy program page. Transcribed from the live
		// Kartra landing page at momentumbuddy.com (2026-08-28) so the program
		// lives on this site instead of sending visitors off to a funnel.
		// Testimonials, prices and the stat line are the client's own copy.
		'buddy_page' => array(
			'eyebrow'  => __( 'Momentum Buddy&trade;', 'successcircles' ),
			'title'    => __( 'Stop carrying your biggest goals <em class="sc-accent">alone</em>.', 'successcircles' ),
			'lede'     => __( 'AI is used to match you with an experienced business owner around your goals. Short weekday calls help you choose the right priority, make a clear commitment, and follow through consistently.', 'successcircles' ),
			'cta'      => __( 'Get Consistent Accountability', 'successcircles' ),
			'cta_note' => '',
			'notice'   => '',
			// The source page's hero was a content-free blue/orange gradient — a
			// coloured block where an image belongs, and off-palette besides.
			// The programme is peer matching, so the peers are the image: the
			// twelve members who gave the testimonials further down the page,
			// set around the theme's own orbit ring.
			'ring'     => array(
				'centre' => __( 'A new buddy every two weeks', 'successcircles' ),
				'hero_faces' => array(
					array( 'name' => 'David Rush', 'image' => 'david-rush.jpg', 'w' => 589, 'h' => 589 ),
					array( 'name' => 'Vanessa Culver', 'image' => 'vanessa-culver.jpg', 'w' => 800, 'h' => 800 ),
					array( 'name' => 'Ruth Dorsainville', 'image' => 'ruth-dorsainville.jpg', 'w' => 200, 'h' => 200 ),
					array( 'name' => 'Ken Van Liew', 'image' => 'ken-van-liew.jpg', 'w' => 400, 'h' => 400 ),
				),
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
			'stats_note' => __( 'Cumulative results tracked by Success Circles™.', 'successcircles' ),

			'problem'  => array(
				'title' => __( 'Success does not remove the pressure of <em class="sc-accent">ownership</em>.', 'successcircles' ),
				'lede'  => __( 'You have built a capable business and people depend on your decisions. Yet the goals that matter most can still lose ground to daily demands, and there are few people you can speak with candidly about the weight of leading.', 'successcircles' ),
				'items' => array(
					array(
						'title' => __( 'The isolation at the top', 'successcircles' ),
						'text'  => __( 'As the owner, you are expected to have the answer. That makes it difficult to test an idea, admit uncertainty, or get candid feedback from someone who understands the stakes.', 'successcircles' ),
					),
					array(
					'title' => __( 'Too many priorities compete for attention', 'successcircles' ),
					'text'  => __( 'Every opportunity looks important and every issue feels urgent. Without a clear outside check, the work most likely to grow the business keeps moving to next week.', 'successcircles' ),
					),
					array(
					'title' => __( 'Good results can hide stalled growth', 'successcircles' ),
					'text'  => __( 'A stable business can make delayed decisions feel harmless. Months pass, the same bottlenecks remain, and the larger vision receives less attention than it deserves.', 'successcircles' ),
					),
					array(
					'title' => __( 'Your team cannot always challenge you', 'successcircles' ),
					'text'  => __( 'Employees and advisors have their own roles and incentives. You need a trusted business owner who can question your assumptions without needing your approval.', 'successcircles' ),
					),
					array(
						'title' => __( 'The fading fun factor', 'successcircles' ),
						'text'  => __( 'Remember when business felt like an exhilarating game? Now it&rsquo;s a grind. The joy of the hustle, the thrill of the win &mdash; they&rsquo;re memories rather than daily experiences. You&rsquo;re successful, but are you fulfilled?', 'successcircles' ),
					),
				),
			),

			'huddles'  => array(
				'eyebrow' => __( 'Daily huddles', 'successcircles' ),
				'title'   => __( 'Thirty minutes that protect the day&rsquo;s priority.', 'successcircles' ),
				'lede'    => __( 'Start the day with a structured conversation with a carefully matched business owner. Review what moved, work through one obstacle, and state exactly what you will complete next.', 'successcircles' ),
				'items'   => array(
					__( 'Recognize completed work and what made it possible', 'successcircles' ),
					__( 'Work through the obstacle slowing your progress', 'successcircles' ),
					__( 'Choose one high-impact commitment for the day', 'successcircles' ),
					__( 'Challenge assumptions before they become expensive decisions', 'successcircles' ),
				),
				'quote'   => __( 'Every call turns an important goal into one clear decision and one next commitment.', 'successcircles' ),
			),

			'growth'   => array(
				'eyebrow' => __( 'Continuous growth and accountability', 'successcircles' ),
				'title'   => __( 'Fresh perspective without losing control.', 'successcircles' ),
				'items'   => array(
					__( 'Meet a new experienced business owner every two weeks for a fresh perspective', 'successcircles' ),
					__( 'Keep important goals visible when urgent work starts taking over', 'successcircles' ),
					__( 'Use practical resources for delegation, time management, and stronger operating habits', 'successcircles' ),
					__( 'Ask experienced entrepreneurs to challenge your thinking and decisions', 'successcircles' ),
				),
				'statement' => __( 'Momentum Buddy&trade; helps you spend less time reacting and more time leading the business forward.', 'successcircles' ),
			),

			'community' => array(
				'eyebrow' => __( 'A community of high achievers', 'successcircles' ),
				'title'   => __( 'A community that understands ownership.', 'successcircles' ),
				'items'   => array(
					__( 'Connect with experienced entrepreneurs who understand the weight of ownership', 'successcircles' ),
					__( 'Join weekly and monthly group sessions for practical ideas and broader perspective', 'successcircles' ),
					__( 'Get candid feedback from experienced owners who understand the stakes', 'successcircles' ),
				),
				'quote'   => __( 'You leave each conversation with a clearer decision, a visible commitment, and someone expecting you to follow through.', 'successcircles' ),
			),

			'benefits' => array(
				'eyebrow' => __( 'What&rsquo;s included', 'successcircles' ),
				'title'   => __( 'Everything you need to stay focused and follow through.', 'successcircles' ),
				'lede'    => __( 'Your membership combines one-to-one weekday accountability with group sessions, practical resources, focused co-working, and a community of experienced entrepreneurs.', 'successcircles' ),
				'items'   => array(
					__( 'Access to weekly and monthly live group huddles &mdash; AI Pro, Time Mastery and Week-in-Celebration', 'successcircles' ),
					__( 'Access to our Momentum Community platform and member roster. Choose who you want to partner with.', 'successcircles' ),
					__( 'Support and candid feedback from experienced entrepreneurs and business owners', 'successcircles' ),
					__( 'Monthly Sprints: gamified sprints to encourage progress in Cashflow Sprint, 3-Day AI, and Simplify Sprint', 'successcircles' ),
					__( 'Your personalised daily AI coach', 'successcircles' ),
					__( 'A dependable rhythm for protecting high-value work from daily distractions', 'successcircles' ),
					__( 'Visible commitments and regular check-ins that strengthen follow-through', 'successcircles' ),
					__( 'Practical support for productivity, decision-making, and delegation', 'successcircles' ),
					__( 'More clarity about where your time and attention will create the most value', 'successcircles' ),
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
				'title' => __( 'Give your biggest goals a place on the calendar.', 'successcircles' ),
				'body'  => array(
					__( 'You have already built something valuable. Momentum Buddy&trade; helps you protect the next important goal from daily demands and complete the work that moves it forward.', 'successcircles' ),
					__( 'Join experienced entrepreneurs from different industries who bring honest perspective, practical support, and consistent accountability.', 'successcircles' ),
				),
				'items' => array(
					__( 'Stop making every difficult decision alone', 'successcircles' ),
					__( 'Choose fewer priorities and complete the important ones', 'successcircles' ),
					__( 'Reignite your passion for growth and innovation', 'successcircles' ),
					__( 'Test your thinking with experienced business owners', 'successcircles' ),
					__( 'Inject more fun and play into your business journey', 'successcircles' ),
					__( 'Achieve goals you never thought possible', 'successcircles' ),
				),
				'outro' => array(
					__( 'Make room for the work you keep meaning to get to, with a business owner who understands the challenge and checks back on your progress.', 'successcircles' ),
					__( 'Build a business that gives you both meaningful progress and a greater sense of fulfillment.', 'successcircles' ),
				),
				'kicker' => __( 'Ready to give your most important goal consistent attention and accountability?', 'successcircles' ),
			),

			'quotes'   => array(
				array( 'name' => 'David Rush', 'role' => __( 'Communication Coach', 'successcircles' ), 'image' => 'david-rush.jpg', 'w' => 589, 'h' => 589, 'text' => __( 'Daily accountability has been a challenge for me throughout my career. This system starts my day off with power and structure. I get to speak first thing in the day about my goals, reflect on the day and week prior, and have someone to answer to. Not only that, I get to contribute to others and hold them accountable and be of service to them!', 'successcircles' ) ),
				array( 'name' => 'Ken Van Liew', 'role' => __( 'CEO at Global Real Estate Strategies', 'successcircles' ), 'image' => 'ken-van-liew.jpg', 'w' => 400, 'h' => 400, 'text' => __( 'Momentum Buddy&trade; has morphed into my fabric after participating for over 15 years! The outcomes from daily accountability are second to none, with an established structure for you to achieve lifelong goals while having fun with outstanding people. Take action today, join Momentum Buddy&trade;, and become part of this unique community that treats you like family.', 'successcircles' ) ),
				array( 'name' => 'Erick Rivas', 'role' => __( 'Entrepreneur', 'successcircles' ), 'image' => 'erick-rivas.jpg', 'w' => 460, 'h' => 320, 'text' => __( 'I&rsquo;ve been with Momentum Buddy&trade; for 2 years now and I am also a member of different masterminds, and this group by far has the best structure for accountability and connections with others looking to level up. The Momentum Buddies are crucial and I recommend everyone have an accountability group that they support, and in turn, supports them.', 'successcircles' ) ),
				array( 'name' => 'Steve Zhou', 'role' => __( 'Deputy CFO at Post Acute Care', 'successcircles' ), 'image' => 'steve-zhou.jpg', 'w' => 320, 'h' => 320, 'text' => __( 'Momentum Buddy&trade; is definitely a worthwhile investment. The system has made me more accountable and productive. I lost 10 lbs and achieved my real estate purchase through consistent daily action. I highly recommend it.', 'successcircles' ) ),
				array( 'name' => 'Garth Sandiford', 'role' => __( 'Real Estate Agent', 'successcircles' ), 'image' => 'garth-sandiford.jpg', 'w' => 400, 'h' => 400, 'text' => __( 'Being a member of Momentum Buddy&trade; has been one of my best investments in myself. The daily calls help to keep me on track to achieving my personal and professional outcomes. Joseph and his team are amazing and do a fantastic job.', 'successcircles' ) ),
				array( 'name' => 'AJ Mihrzad', 'role' => __( 'The Online Super Coach', 'successcircles' ), 'image' => 'aj-mihrzad.jpg', 'w' => 640, 'h' => 640, 'text' => __( 'Such a powerful program! I&rsquo;ve done many personal development programs in the past and this is one of the BEST! I highly recommend Momentum Buddy&trade;!', 'successcircles' ) ),
				array( 'name' => 'Susan Hum', 'role' => __( 'The Love Hacker / Mind Mastery &amp; Success Coach', 'successcircles' ), 'image' => 'susan-hum.jpg', 'w' => 853, 'h' => 853, 'text' => __( 'I was so impressed with the level quality in the accountability partner that was matched with me. The process of matchmaking was so spot on with regards to the person I was introduced to work with as well as the success in accountability I received within a short period of time. My experience was absolutely rewarding in so many ways!', 'successcircles' ) ),
				array( 'name' => 'Elaine Williams', 'role' => __( 'Video &amp; Visibility Coach, Speaker, Author', 'successcircles' ), 'image' => 'elaine-williams.png', 'w' => 500, 'h' => 500, 'text' => __( 'I love my accountability calls! This community is full of amazing people who are up to building their businesses and changing the world. The phone call structure is a great way to get laser focused for the day and I&rsquo;ve found that they&rsquo;ve tripled my effectiveness and productivity! I highly recommend Momentum Buddy&trade; and this community!', 'successcircles' ) ),
				array( 'name' => 'Tanya Straker', 'role' => __( 'Certified Health Coach', 'successcircles' ), 'image' => 'tanya-straker.jpg', 'w' => 500, 'h' => 500, 'text' => __( 'The morning calls are a consistent, steadying factor in a whirl of change. Everyone that I have been partnered with has contributed to my business knowledge and growth. As a solopreneur I highly recommend Momentum Buddy&trade;. The team are amazing!', 'successcircles' ) ),
				array( 'name' => 'Heather Cottrell', 'role' => __( 'Coach at Holistic Nutrition and Lifestyle', 'successcircles' ), 'image' => 'heather-cottrell.png', 'w' => 150, 'h' => 150, 'text' => __( 'Being a part of Huddle Calls has made a dramatic difference in my life. Suddenly, I am no longer on my own &mdash; I have a daily Momentum Buddy&trade; who supports me to achieve my goals as I do the same for them. I created a habit of waking 4&ndash;6 hours earlier than usual, creating more time each day to build my business, spend time with friends and family, and practice self-care.', 'successcircles' ) ),
				array( 'name' => 'Ruth Dorsainville', 'role' => __( 'CEO at DNA Legacy Group', 'successcircles' ), 'image' => 'ruth-dorsainville.png', 'w' => 626, 'h' => 629, 'text' => __( 'Excellent coaching company with an abundance of resources that helps any entrepreneur succeed in their business. Highly recommended.', 'successcircles' ) ),
				array( 'name' => 'Damon Dickinson', 'role' => __( 'Success Coach', 'successcircles' ), 'image' => 'damon-dickinson.png', 'w' => 220, 'h' => 220, 'text' => __( 'Most cost effective hands-on daily coaching I know of. Since joining, I&rsquo;ve signed on 2 new coaching clients, was introduced to a solid $500 monthly new passive income opportunity, and my rental property is at record levels of income. I&rsquo;m so grateful I joined and you will be too!', 'successcircles' ) ),
			),
		),

		// The Momentum Labs program page. Transcribed from the live GroovePages
		// landing page at momentumhuddle.com (2026-08-28). The source page's
		// stock vectors and banner are in assets/img/labs/ — see the page
		// template for which are used and why.
		'labs_page' => array(
			'eyebrow'  => __( 'Momentum Labs™', 'successcircles' ),
			'title'    => __( 'Solve important problems with owners who have been <em class="sc-accent">there before</em>.', 'successcircles' ),
			'lede'     => __( 'Weekly group huddles give established entrepreneurs a place to protect priorities, challenge decisions, and turn experienced feedback into practical action.', 'successcircles' ),
			'cta'      => __( 'Join Momentum Labs™', 'successcircles' ),
			'cta_url'  => 'https://www.successcircles.net/mlabs',
			'price'    => '$97',
			'price_note' => __( 'per month', 'successcircles' ),
			'seal'     => array(
				'file'   => 'community-huddles.png',
				'alt'    => __( 'Success Circles&trade; Momentum Community and Huddles seal', 'successcircles' ),
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
				'lede'      => __( 'A busy week can still leave the business in the same place. When every decision stays in your head and urgent work controls the calendar, the goals with the greatest long-term value keep getting delayed.', 'successcircles' ),
				'ask'       => __( 'But first, let me ask you:', 'successcircles' ),
				'questions' => array(
					__( 'Do you often feel isolated, missing the energy and support of a team?', 'successcircles' ),
					__( 'Are you drowning in to-do lists, feeling like there&rsquo;s never enough time?', 'successcircles' ),
					__( 'Does the rapid pace of technology, especially AI, leave you feeling left behind?', 'successcircles' ),
					__( 'Are you tired of making decisions in a vacuum, without trusted advisors to bounce ideas off?', 'successcircles' ),
				),
				'answer'    => __( 'Momentum Labs™ gives those decisions and priorities a structured place to move forward each week.', 'successcircles' ),
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
				'title'   => __( 'Practical support for clearer decisions and steady progress.', 'successcircles' ),
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
						'text'  => __( 'Use practical AI tools to reduce routine work and create more time for high-value decisions.', 'successcircles' ),
					),
					array(
						'title' => __( 'Time and priority systems', 'successcircles' ),
						'text'  => __( 'Plan around the work that matters, reduce avoidable distractions, and make progress without extending the workday.', 'successcircles' ),
					),
					array(
						'title' => __( 'Experienced outside perspective', 'successcircles' ),
						'text'  => __( 'Bring a difficult decision to entrepreneurs who can question assumptions, share relevant experience, and help you find a practical next step.', 'successcircles' ),
					),
					array(
						'title' => __( 'Accountability that continues after the call', 'successcircles' ),
						'text'  => __( 'Leave each huddle with a clear commitment, then return with evidence of what changed.', 'successcircles' ),
					),
				),
			),

			'deal'     => array(
				'title'   => __( 'Success isn&rsquo;t a solo sport.', 'successcircles' ),
				'text'    => __( 'Experienced entrepreneurs still need a place where they can think out loud, receive candid feedback, and be held to the goals they set. Momentum Community and Huddles provide that structure.', 'successcircles' ),
				// The portrait was unattributed, which is odd for a photo of a
				// real person. The quote and role are read from `founder_page`
				// so there is one source of truth for what Joseph actually said.
				'link'    => __( 'Read his story', 'successcircles' ),
				'link_url' => '/about-joseph-varghese/',
				'image'   => array(
					'file'   => 'joseph.png',
					'alt'    => __( 'Joseph Varghese, founder of Success Circles&trade;', 'successcircles' ),
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
				'body'  => __( 'Momentum Labs™ requires candid participation, respect for the group, and a willingness to act on the commitments you make.', 'successcircles' ),
				'turn'  => __( 'It is designed for established entrepreneurs who value practical feedback and want important goals to keep moving even when the business gets busy.', 'successcircles' ),
			),

			'closing'  => array(
				'title' => __( 'Give your biggest priority a room where it can <em class="sc-accent">move</em>.', 'successcircles' ),
				'text'  => __( 'Bring the decision, obstacle, or goal that keeps being pushed aside. Leave with useful perspective, a specific commitment, and a group that will ask what happened next.', 'successcircles' ),
				'note'  => __( 'Choose a huddle time that fits your week.', 'successcircles' ),
			),
		),

		// The Momentum Team page. Transcribed from the live Kartra landing page
		// at momentum.team (2026-08-28). The 90-day method is a real sequence,
		// which is why it is the one block on the page that carries numbers.
		'team_page' => array(
			'kicker'   => __( '90-day AI accelerator', 'successcircles' ),
			'title'    => __( 'Stop operating in your business. Start <em class="sc-accent">leading from it.</em>', 'successcircles' ),
			'lede'     => __( 'A 90-day cohort for established owners who need to protect one major goal, reduce their role as the bottleneck, and build systems that keep the business moving without constant intervention.', 'successcircles' ),
			'cta'      => __( 'Apply now', 'successcircles' ),
			'cta_url'  => 'https://www.successcircles.net/yesmomentumteam',
			'cta_note' => '',
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
				'title' => __( 'The business has grown, but your role has not.', 'successcircles' ),
				'lede'  => __( 'You built the company to create opportunity and freedom. Yet too many decisions, emergencies, and approvals still depend on you, leaving little time for the work only the owner can do.', 'successcircles' ),
				'items' => array(
					array(
						'title' => __( 'You&rsquo;re trapped in your own success', 'successcircles' ),
						'text'  => __( 'Decisions, approvals, and emergencies keep returning to your desk. The company stays active while the larger goal you intended to lead keeps waiting.', 'successcircles' ),
					),
					array(
						'title' => __( 'Your freedom is disappearing', 'successcircles' ),
						'text'  => __( 'Revenue may be growing while your calendar becomes less flexible. Work expands into the time that should belong to leadership, family, and life outside the business.', 'successcircles' ),
					),
					array(
					'title' => __( 'Systems keep getting postponed', 'successcircles' ),
					'text'  => __( 'You know delegation, documented processes, and practical AI could remove routine work. Urgent demands make it difficult to design and implement those changes consistently.', 'successcircles' ),
					),
				),
			),

			'scene'    => array(
				'title'  => __( 'Ninety days from now.', 'successcircles' ),
				'lede'   => __( 'Your team knows what to do without waiting for every answer. Routine work follows documented systems. Your calendar has room for the major initiative you chose at the start of the cohort.', 'successcircles' ),
				'turn'   => __( 'The practical difference:', 'successcircles' ),
				'shifts' => array(
					array(
						'title' => __( 'Work becomes more intentional', 'successcircles' ),
						'text'  => __( 'Your attention moves from reacting to whatever is loudest toward designing what the business needs next.', 'successcircles' ),
					),
					array(
						'title' => __( 'Strategic over reactive', 'successcircles' ),
						'text'  => __( 'Instead of putting out fires, you&rsquo;re designing the future. Instead of answering the same questions repeatedly, you&rsquo;ve built systems that prevent them.', 'successcircles' ),
					),
					array(
						'title' => __( 'True leadership fulfilment', 'successcircles' ),
						'text'  => __( 'You spend more time making high-value decisions and less time carrying work the team or a system can handle.', 'successcircles' ),
					),
				),
				'image'  => array(
					'file'   => 'cohort-sketch.jpg',
					'alt'    => __( 'A pen-and-ink drawing of a Momentum Team cohort gathered for a group photo', 'successcircles' ),
					'width'  => 825,
					'height' => 1100,
				),
				'quote'  => __( 'The business no longer needs your attention everywhere, so you can apply it where it matters most.', 'successcircles' ),
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
				'lede'   => __( 'Three focused phases move one major goal from intention to implementation while reducing the work that depends on you.', 'successcircles' ),
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
						'intent' => __( 'Choose the goal, establish a clear baseline, and protect time for the work.', 'successcircles' ),
						'items'  => array(
							array( 'title' => __( 'Goal definition', 'successcircles' ), 'text' => __( 'Define one measurable goal with the greatest value to the business.', 'successcircles' ) ),
							array( 'title' => __( 'Accountability', 'successcircles' ), 'text' => __( 'Join Momentum Labs™ weekly huddles, and get matched with your Momentum Buddy&trade;.', 'successcircles' ) ),
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
						'intent' => __( 'Remove recurring bottlenecks and build systems the team can run consistently.', 'successcircles' ),
						'items'  => array(
							array( 'title' => __( 'AI workflow integration', 'successcircles' ), 'text' => __( 'Deploy automated systems that handle routine operations.', 'successcircles' ) ),
							array( 'title' => __( 'Network leverage', 'successcircles' ), 'text' => __( 'Your advisory circle provides feedback, referrals, and solutions.', 'successcircles' ) ),
							array( 'title' => __( 'Breakthrough sessions', 'successcircles' ), 'text' => __( 'Get solutions from entrepreneurs who&rsquo;ve solved your exact challenges.', 'successcircles' ) ),
							array( 'title' => __( 'Delegation framework', 'successcircles' ), 'text' => __( 'Build processes that eliminate you as the bottleneck.', 'successcircles' ) ),
							array( 'title' => __( 'Monthly Sprints', 'successcircles' ), 'text' => __( 'Gamified sprints to encourage progress in Cashflow Sprint, 3-Day AI, and Simplify Sprint.', 'successcircles' ) ),
							array( 'title' => __( 'Community-first scaling', 'successcircles' ), 'text' => __( 'Master leveraging relationships over fixed costs for business growth.', 'successcircles' ) ),
						),
						'key'    => array(
							__( 'Continued Weekly Pivot Calls and Week-in-Celebration Reviews.', 'successcircles' ),
							__( 'Advanced AI Implementation Sessions.', 'successcircles' ),
							__( 'A second one-to-one Momentum Coach call to remove obstacles and adjust the plan.', 'successcircles' ),
							__( 'Hello2Yes: a 5-day gamified challenge to overcome fear of rejection through bold requests, with tracking and rewards.', 'successcircles' ),
						),
					),
					array(
						'phase'  => __( 'Phase 3', 'successcircles' ),
						'days'   => __( 'Days 61&ndash;90', 'successcircles' ),
						'title'  => __( 'Momentum multiplication &amp; mastery', 'successcircles' ),
						'intent' => __( 'Refine what works, document the new operating rhythm, and plan the next major goal.', 'successcircles' ),
						'items'  => array(
							array( 'title' => __( 'Visionary identity', 'successcircles' ), 'text' => __( 'Operate consistently from your new leadership level.', 'successcircles' ) ),
							array( 'title' => __( 'Network expansion', 'successcircles' ), 'text' => __( 'Build useful relationships that create relevant introductions and opportunities.', 'successcircles' ) ),
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
				'title'  => __( 'What supports the 90-day work.', 'successcircles' ),
				'lede'   => __( 'The people, sessions, and practical tools included throughout the accelerator.', 'successcircles' ),
				'groups' => array(
					array(
						'name'  => __( 'Strategic foundation', 'successcircles' ),
						'items' => array(
							array( 'title' => __( 'Your advisory group', 'successcircles' ), 'text' => __( 'Experienced entrepreneurs who offer candid feedback, relevant introductions, and practical resources.', 'successcircles' ) ),
							array( 'title' => __( 'Momentum Labs™ access', 'successcircles' ), 'text' => __( 'Weekly Pivot Calls, progress reviews, and focused problem-solving sessions.', 'successcircles' ) ),
							array( 'title' => __( 'Your personalized daily AI coach', 'successcircles' ), 'text' => __( 'Custom AI system that optimizes your decisions, priorities, and daily execution.', 'successcircles' ) ),
							array( 'title' => __( '90-day goal system', 'successcircles' ), 'text' => __( 'Turn one important outcome into milestones, weekly commitments, and visible progress.', 'successcircles' ) ),
							array( 'title' => __( 'Community support', 'successcircles' ), 'text' => __( 'Draw on experienced owners and a focused cohort without adding permanent overhead.', 'successcircles' ) ),
						),
					),
					array(
						'name'  => __( 'AI-powered leverage', 'successcircles' ),
						'items' => array(
							array( 'title' => __( 'Practical AI training', 'successcircles' ), 'text' => __( 'Apply AI to routine work so more of your week can go toward decisions and growth.', 'successcircles' ) ),
							array( 'title' => __( 'AI implementation sessions', 'successcircles' ), 'text' => __( 'Build automated workflows that handle routine operations without your involvement.', 'successcircles' ) ),
							array( 'title' => __( 'Practical productivity tools', 'successcircles' ), 'text' => __( 'Reduce manual work and protect time for leadership priorities.', 'successcircles' ) ),
							array( 'title' => __( 'Smart team building', 'successcircles' ), 'text' => __( 'Replace expensive fixed costs with strategic community leverage.', 'successcircles' ) ),
						),
					),
					array(
						'name'  => __( 'Focused support', 'successcircles' ),
						'items' => array(
							array( 'title' => __( '10x Momentum Buddy&trade;', 'successcircles' ), 'text' => __( 'Two weeks of daily one-to-one accountability calls. Like every sport, you deserve to huddle up, strategize your day, and play to win.', 'successcircles' ) ),
							array( 'title' => __( 'One-to-one Momentum Coach calls', 'successcircles' ), 'text' => __( 'Focused coaching sessions to clarify priorities, remove obstacles, and adjust the plan.', 'successcircles' ) ),
							array( 'title' => __( '3+ monthly cohort sessions', 'successcircles' ), 'text' => __( 'Choose from 5+ weekly options that fit your schedule.', 'successcircles' ) ),
							array( 'title' => __( 'Candid feedback', 'successcircles' ), 'text' => __( 'Work through important challenges with people who have solved similar problems.', 'successcircles' ) ),
						),
					),
					array(
						'name'  => __( 'Community &amp; networking', 'successcircles' ),
						'items' => array(
							array( 'title' => __( 'Momentum.Community platform access', 'successcircles' ), 'text' => __( 'Real-time communication with your network of peak performers, plus the complete member roster.', 'successcircles' ) ),
							array( 'title' => __( 'Monthly Sprints', 'successcircles' ), 'text' => __( 'Gamified sprints to encourage progress in Cashflow Sprint, 3-Day AI, and Simplify Sprint.', 'successcircles' ) ),
							array( 'title' => __( 'Live events &amp; owner networking', 'successcircles' ), 'text' => __( 'In-person dinners and experiences for East Coast members (NY, NJ, PA, CT).', 'successcircles' ) ),
							array( 'title' => __( 'Lifetime network access', 'successcircles' ), 'text' => __( 'Keep the relationships and referrals that compound your success for decades.', 'successcircles' ) ),
						),
					),
					array(
						'name'  => __( 'Focused challenges', 'successcircles' ),
						'items' => array(
							array( 'title' => __( 'SimplifySprint mini-event', 'successcircles' ), 'text' => __( 'A 5-day gamified sprint to declutter, remove distractions, and reclaim momentum through clarity, complete with prizes and rewards.', 'successcircles' ) ),
							array( 'title' => __( 'Hello2Yes mini-event', 'successcircles' ), 'text' => __( 'A 5-day gamified challenge to overcome rejection fear by making bold requests and tracking results, with recognition and rewards for courage.', 'successcircles' ) ),
							array( 'title' => __( 'Monthly workshops', 'successcircles' ), 'text' => __( 'Practical monthly sessions focused on a specific business or leadership challenge.', 'successcircles' ) ),
							array( 'title' => __( 'Achievement system', 'successcircles' ), 'text' => __( 'Progress tracking, badges, and rewards that make completed work visible.', 'successcircles' ) ),
						),
					),
					array(
						'name'  => __( 'Credibility &amp; assurance', 'successcircles' ),
						'items' => array(
							array( 'title' => __( 'Tax deductible investment', 'successcircles' ), 'text' => __( 'A professional development expense that improves your bottom line.', 'successcircles' ) ),
							array( 'title' => __( 'Rated 5/5 on Trustpilot', 'successcircles' ), 'text' => __( 'Verified reviews from accelerated entrepreneurs.', 'successcircles' ) ),
							array( 'title' => __( '20+ years of experience', 'successcircles' ), 'text' => __( 'The program has evolved through 42 cohorts and two decades of member feedback.', 'successcircles' ) ),
						),
					),
				),
			),

			'results'  => array(
				'title' => __( 'Measurable results.', 'successcircles' ),
				'items' => array(
					array( 'title' => __( 'Progress on the priority that matters', 'successcircles' ), 'text' => __( 'Consistent action toward one measurable 90-day business goal.', 'successcircles' ) ),
					array( 'title' => __( 'Systematic accountability', 'successcircles' ), 'text' => __( 'Consistent execution on your most important goals.', 'successcircles' ) ),
					array( 'title' => __( 'Efficiency without burnout', 'successcircles' ), 'text' => __( 'Multiply your impact without increasing workload.', 'successcircles' ) ),
					array( 'title' => __( 'Sustainable operating improvements', 'successcircles' ), 'text' => __( 'Keep the routines and systems that continue producing value after the cohort.', 'successcircles' ) ),
				),
			),

			// The same film the homepage runs in its stories section (Vimeo
			// 870306260). It is a client-testimonial reel, so it leads the
			// social proof here rather than sitting up top as an explainer.
			'video'    => array(
				'id'       => '870306260',
				'name'     => __( 'What Our Clients Say About Success Circles&trade;', 'successcircles' ),
				'kind'     => __( 'Film', 'successcircles' ),
				'poster'   => 'video-poster.jpg',
				'duration' => '1:58',
				'width'    => 1280,
				'height'   => 760,
			),

			'quotes'   => array(
				array( 'name' => 'Rochelle Lisner', 'role' => __( 'CEO at Dynamic Business Growth', 'successcircles' ), 'image' => 'rochelle-lisner.png', 'text' => __( 'The Momentum Team is a great way to stay focused on the day to day actions needed to deliver on goals. The support and feedback allow me to course-correct so I am constantly moving forward inch by inch. I believe isolation kills success and with the team, I never feel isolated. Many people have my back.', 'successcircles' ) ),
				array( 'name' => 'Arvin Khamseh', 'role' => __( 'Digital Marketing Strategist, Product Marketer', 'successcircles' ), 'image' => 'arvin-khamseh.png', 'text' => __( 'My team grew from 2 to 14 people, a past VP of a national organization is now mentoring me (this is still hard to believe for myself!!) I had so many spontaneous and courageous actions in the past 3 months. This piece really stretched my reality and I value it highly. Knowing someone else is doing it with me gave me more courage to be spontaneous.', 'successcircles' ) ),
				array( 'name' => 'Charles Fritschler', 'role' => __( 'COO at Executive Losers', 'successcircles' ), 'image' => 'charles-fritschler.png', 'text' => __( 'Success Circles&trade; offers several programs and opportunities for growth and support. Over the last few months since joining Success Circles&trade;, I have benefited greatly from receiving terrific feedback and advice, in addition to specific knowledge. I meet many new like minded people who provide different perspectives; and as a bonus have made ongoing friends, including Success Circles&trade; Founder, Joseph.', 'successcircles' ) ),
				array( 'name' => 'Ken Van Liew', 'role' => __( 'Real Estate Developer', 'successcircles' ), 'image' => 'ken-van-liew.png', 'text' => __( 'The Momentum Team is an extraordinary experience that allows you to be held accountable to achieve what&rsquo;s important to you and in the process allows you contribute to others to help them achieve their goals.', 'successcircles' ) ),
			),

			'pricing'  => array(
				'title'    => __( 'Choose how to invest in the 90-day program.', 'successcircles' ),
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
					'text'  => __( 'The program is designed for owners whose calendars are already full. The work focuses on removing bottlenecks, reducing routine demands, and protecting time for the goal that matters most.', 'successcircles' ),
				),
			),

			'paths'    => array(
				'title' => __( 'What the next 90 days could look like.', 'successcircles' ),
				'items' => array(
					array(
						'label' => __( 'Path A', 'successcircles' ),
						'name'  => __( 'Stay the course', 'successcircles' ),
						'text'  => __( 'Continue handling the same approvals and emergencies while the larger goal waits. The business stays busy, but the bottlenecks and demands on your time remain largely unchanged.', 'successcircles' ),
					),
					array(
						'label' => __( 'Path B', 'successcircles' ),
						'name'  => __( 'Protect the goal and change how the business runs', 'successcircles' ),
						'text'  => __( 'Use the next 90 days to implement useful systems, strengthen delegation, and complete a major initiative with support from entrepreneurs who understand the work.', 'successcircles' ),
					),
				),
				'close' => __( 'The next 90 days will pass either way. The question is whether your most important goal will still be waiting when they do.', 'successcircles' ),
			),

			'fit'      => array(
				'title' => __( 'This program is application-only.', 'successcircles' ),
				'lede'  => __( 'This is designed for established entrepreneurs who are ready to make one important goal visible, measurable, and accountable.', 'successcircles' ),
				'items' => array(
					__( 'You&rsquo;re committed to acceleration, not just information.', 'successcircles' ),
					__( 'You can commit to 4 huddles per month, minimum.', 'successcircles' ),
					__( 'You&rsquo;re ready for candid feedback and focused coaching.', 'successcircles' ),
					__( 'You&rsquo;re willing to protect time for one major business goal.', 'successcircles' ),
					__( 'You want systems that reduce your role as the bottleneck.', 'successcircles' ),
					__( 'You will participate consistently and contribute to the group.', 'successcircles' ),
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
			'name'          => __( 'Success Circles™', 'successcircles' ),
			'legal_name'    => __( 'Success Circles™', 'successcircles' ),
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
			'blurb'   => __( 'An advisory community helping established entrepreneurs protect their priorities, follow through, and grow with greater clarity. Since 2005.', 'successcircles' ),
			'columns' => array(
				array(
					'heading' => __( 'Programs', 'successcircles' ),
					'menu'    => 'footer_programs',
					'links'   => array(
						array(
							'label' => __( 'Momentum Buddy&trade;', 'successcircles' ),
							'url'   => '/momentum-buddy/',
						),
						array(
							'label' => __( 'Momentum Labs™', 'successcircles' ),
							'url'   => '/momentum-labs/',
						),
						array(
							'label' => __( 'Momentum Team', 'successcircles' ),
							'url'   => '/momentum-team/',
						),
						array(
							'label' => __( 'Momentum OS&trade;', 'successcircles' ),
							'url'   => '/momentum-os/',
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
							'url'   => '/about-joseph-varghese/',
						),
						array(
							'label' => __( 'Contact', 'successcircles' ),
							'url'   => '/contact-us/',
						),
						array(
							'label' => __( 'Member Login', 'successcircles' ),
							'url'   => 'https://www.momentum.network/',
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
				array(
					'label' => __( 'Instagram', 'successcircles' ),
					'url'   => 'https://www.instagram.com/success.circles',
				),
				array(
					'label' => __( 'TikTok', 'successcircles' ),
					'url'   => 'https://www.tiktok.com/@successcircles',
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
			'form_lede'    => __( 'Your answers are in. Tell us who to reach and someone from Success Circles&trade; will come back to you personally.', 'successcircles' ),
			'name'         => __( 'Full name', 'successcircles' ),
			'email'        => __( 'Email', 'successcircles' ),
			'phone'        => __( 'Phone', 'successcircles' ),
			'submit'       => __( 'Send my answers', 'successcircles' ),
			'sending'      => __( 'Sending&hellip;', 'successcircles' ),
			'privacy'      => __( 'We use this to reach you about your answers, and nothing else.', 'successcircles' ),
			'error'        => __( 'Something went wrong. Please try again.', 'successcircles' ),
			'done_eyebrow' => __( 'Done', 'successcircles' ),
			'done_title'   => __( 'Thank you &mdash; that&rsquo;s the honest version.', 'successcircles' ),
			'done_lede'    => __( 'Your answers are with us. Someone from Success Circles&trade; will read them properly and come back to you within one business day.', 'successcircles' ),
			'done_cta'     => __( 'Close', 'successcircles' ),
		),

		'links' => array(
			'member_login' => 'https://www.momentum.network/',
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

	return $customized ? successcircles_customize_link_tree( $tree ) : $tree;
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
