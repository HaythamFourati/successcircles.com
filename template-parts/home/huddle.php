<?php
/** Homepage huddle: focused introduction and a compact visual breakdown. */
defined( 'ABSPATH' ) || exit;
$sc_block = (array) successcircles_content( 'huddle', array() );
?>
<section id="huddle" class="hp-huddle sc-band--hairline" aria-labelledby="sc-huddle-title">
	<div class="sc-section">
		<header class="hp-intro">
			<?php successcircles_eyebrow( $sc_block['index'], $sc_block['eyebrow'] ); ?>
			<h2 id="sc-huddle-title" class="sc-display sc-display--lg"><?php echo successcircles_inline( $sc_block['title'] ); ?></h2>
			<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_block['lede'] ) ); ?></p>
		</header>
		<div class="hp-huddle__layout">
			<figure class="hp-huddle__visual">
				<img src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/team/huddle-screen.jpg' ); ?>" alt="<?php esc_attr_e( 'Business owners connecting over a video call', 'successcircles' ); ?>" width="825" height="1100" loading="lazy" decoding="async">
				<figcaption><?php echo esc_html( wp_specialchars_decode( $sc_block['quote'] ) ); ?></figcaption>
			</figure>
			<ol class="hp-huddle__items">
				<?php foreach ( (array) $sc_block['items'] as $sc_index => $sc_item ) : ?>
					<li>
						<span class="hp-item-number" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $sc_index + 1 ) ); ?></span>
						<div>
							<h3><?php echo esc_html( wp_specialchars_decode( $sc_item['title'] ) ); ?></h3>
							<p><?php echo esc_html( wp_specialchars_decode( $sc_item['text'] ) ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</div>
</section>
