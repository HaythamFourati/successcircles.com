<?php
/** Editorial podcast feature, shared by the homepage and episode archive. */
defined( 'ABSPATH' ) || exit;
$sc_podcast = (array) successcircles_content( 'podcast', array() );
$sc_episodes = successcircles_podcast_episodes();
?>
<div class="sc-podcast-player">
	<div class="sc-podcast-player__copy">
		<a class="sc-podcast-player__brand" href="<?php echo successcircles_url( $sc_podcast['brand_url'] ); ?>">
			<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true" focusable="false"><rect x="9" y="2" width="6" height="12" rx="3"/><path d="M5 10v1a7 7 0 0 0 14 0v-1M12 18v4M8 22h8" stroke-linecap="round"/></svg>
			<span>RULESFORSUCCESS.COM</span>
		</a>
		<h2 class="sc-display sc-podcast-player__title"><?php echo successcircles_inline( $sc_podcast['title'] ); ?></h2>
		<p class="sc-podcast-player__intro"><?php esc_html_e( 'Behind every breakthrough is a conversation worth hearing.', 'successcircles' ); ?></p>
		<p class="sc-podcast-player__description"><?php esc_html_e( 'Join Joseph Varghese and experienced entrepreneurs for honest conversations about leadership, growth, and building a business that gives you freedom.', 'successcircles' ); ?></p>
		<a class="sc-btn sc-btn--primary" href="<?php echo is_home() ? esc_url( '#conversations' ) : successcircles_url( $sc_podcast['link']['url'] ); ?>"><?php esc_html_e( 'Explore all episodes', 'successcircles' ); ?><span aria-hidden="true">↗</span></a>
	</div>
	<div class="sc-podcast-player__feature">
		<div class="sc-podcast-player__feature-head">
			<h3 class="sc-podcast-player__feature-label"><?php esc_html_e( 'Pick a conversation.', 'successcircles' ); ?></h3>
			<span class="sc-podcast-player__format"><?php echo esc_html( sprintf( __( '%s episodes', 'successcircles' ), number_format_i18n( count( $sc_episodes ) ) ) ); ?></span>
		</div>
		<div class="sc-podcast-player__library" role="region" aria-label="<?php esc_attr_e( 'Podcast episode library. Scroll to browse all episodes.', 'successcircles' ); ?>" tabindex="0">
			<ul class="sc-podcast-player__episodes">
				<?php foreach ( $sc_episodes as $sc_episode ) : ?>
					<li class="sc-podcast-episode">
						<a class="sc-podcast-episode__link" href="<?php echo esc_url( $sc_episode['url'] ); ?>" target="_blank" rel="noopener noreferrer">
							<?php if ( $sc_episode['image'] ) : ?><img src="<?php echo esc_url( $sc_episode['image'] ); ?>" alt="" width="96" height="96" loading="lazy"><?php endif; ?>
							<span class="sc-podcast-episode__info">
								<h4 title="<?php echo esc_attr( $sc_episode['title'] ); ?>"><?php echo esc_html( $sc_episode['title'] ); ?></h4>
								<span class="sc-podcast-episode__meta"><?php echo esc_html( implode( ' · ', array_filter( array( wp_date( 'M j, Y', strtotime( $sc_episode['date'] ) ), successcircles_podcast_minutes( $sc_episode['duration'] ) ) ) ) ); ?></span>
							</span>
							<span class="sc-podcast-episode__cue"><?php esc_html_e( 'Listen on Spotify', 'successcircles' ); ?> <span aria-hidden="true">↗</span><span class="screen-reader-text"><?php esc_html_e( '(opens in a new tab)', 'successcircles' ); ?></span></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<p class="sc-podcast-player__scroll-hint"><?php esc_html_e( 'Scroll for more episodes', 'successcircles' ); ?> <span aria-hidden="true">↓</span></p>
		<div class="sc-podcast-player__listen">
			<a class="sc-btn sc-btn--ghost" href="https://open.spotify.com/show/64eUCSg7BqAo0EJf8cOp97" target="_blank" rel="noopener noreferrer">Check on Spotify <span aria-hidden="true">↗</span></a>
			<a class="sc-btn sc-btn--ghost" href="https://linktr.ee/rulesforsuccess" target="_blank" rel="noopener noreferrer">Check on Apple, YouTube and iHeart Radio <span aria-hidden="true">↗</span></a>
		</div>
	</div>
</div>
