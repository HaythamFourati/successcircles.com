<?php
/** Homepage problem: focused introduction and a compact visual breakdown. */
defined( 'ABSPATH' ) || exit;
$sc_block = (array) successcircles_content( 'problem', array() );
?>
<section id="problem" class="hp-problem sc-band--shade sc-band--curtain" aria-labelledby="sc-problem-title">
	<div class="sc-section">
		<header class="hp-intro">
			<?php successcircles_eyebrow( $sc_block['index'], $sc_block['eyebrow'] ); ?>
			<h2 id="sc-problem-title" class="sc-display sc-display--lg"><?php echo successcircles_inline( $sc_block['title'] ); ?></h2>
			<p class="sc-lede"><?php echo esc_html( wp_specialchars_decode( $sc_block['lede'] ) ); ?></p>
		</header>
		<div class="hp-problem__layout">
			<figure class="hp-problem__visual">
				<img src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/hero-huddle.jpg' ); ?>" alt="<?php esc_attr_e( 'A laptop set up for a video conversation', 'successcircles' ); ?>" width="1170" height="780" loading="lazy" decoding="async">
			</figure>
			<ol class="hp-problem__items">
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
