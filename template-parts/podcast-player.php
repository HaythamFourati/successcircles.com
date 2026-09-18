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
							<?php if ( $sc_episode['image'] ) : ?><img src="<?php echo esc_url( $sc_episode['image'] ); ?>" alt="" width="96" height="96" loading="lazy"><?php endif; ?>
							<div class="sc-podcast-episode__info">
								<h4><a href="<?php echo esc_url( $sc_episode['url'] ); ?>" title="<?php echo esc_attr( $sc_episode['title'] ); ?>"><?php echo esc_html( $sc_episode['title'] ); ?></a></h4>
								<p><?php echo esc_html( wp_date( 'M j, Y', strtotime( $sc_episode['date'] ) ) ); ?></p>
							</div>
                        <div class="sc-audio" hidden>
                            <button class="sc-audio__toggle" type="button" aria-label="<?php echo esc_attr( 'Play ' . $sc_episode['title'] ); ?>" aria-pressed="false"><svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path class="sc-audio__play" d="m8 5 11 7-11 7z"/><path class="sc-audio__pause" d="M6 5h4v14H6zm8 0h4v14h-4z"/></svg></button>
                            <div class="sc-audio__track"><input class="sc-audio__seek" type="range" min="0" max="100" value="0" step="0.1" disabled aria-label="<?php echo esc_attr( 'Seek in ' . $sc_episode['title'] ); ?>"><div class="sc-audio__times"><span class="sc-audio__elapsed">0:00</span><span class="sc-audio__duration"><?php echo esc_html( $sc_episode['duration'] ); ?></span></div></div>
                            <span class="sc-audio__status screen-reader-text" role="status"></span>
                        </div>
                        <audio controls preload="none" src="<?php echo esc_url( $sc_episode['audio'] ); ?>" aria-label="<?php echo esc_attr( $sc_episode['title'] ); ?>"><a href="<?php echo esc_url( $sc_episode['audio'] ); ?>"><?php esc_html_e( 'Listen to this episode', 'successcircles' ); ?></a></audio>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<p class="sc-podcast-player__scroll-hint"><?php esc_html_e( 'Scroll for more episodes', 'successcircles' ); ?> <span aria-hidden="true">↓</span></p>
		<a class="sc-btn sc-btn--ghost sc-podcast-player__spotify" href="https://open.spotify.com/show/64eUCSg7BqAo0EJf8cOp97" target="_blank" rel="noopener noreferrer">Check on Spotify <span aria-hidden="true">↗</span></a>
	</div>
</div>
