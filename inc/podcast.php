<?php
/** Official podcast RSS library, cached with a bundled offline fallback. */
defined( 'ABSPATH' ) || exit;

function successcircles_podcast_episodes() {
	$cached = get_transient( 'sc_podcast_library_v1' );
	if ( is_array( $cached ) && $cached ) { return array_slice( $cached, 0, 10 ); }
	$fallback = json_decode( file_get_contents( SUCCESSCIRCLES_DIR . '/assets/data/podcast-episodes.json' ), true );
	$fallback = is_array( $fallback ) ? $fallback : array();
	require_once ABSPATH . WPINC . '/feed.php';
	// SimplePie caches feeds for 12h by default on top of our transient; keep both at an hour.
	$sc_feed_ttl = static function () { return HOUR_IN_SECONDS; };
	add_filter( 'wp_feed_cache_transient_lifetime', $sc_feed_ttl );
	$feed = fetch_feed( 'https://anchor.fm/s/10e83df4c/podcast/rss' );
	remove_filter( 'wp_feed_cache_transient_lifetime', $sc_feed_ttl );
	$episodes = array();
	if ( ! is_wp_error( $feed ) ) {
		foreach ( $feed->get_items() as $item ) {
			$audio = $item->get_enclosure();
			if ( ! $audio || ! $audio->get_link() || strpos( (string) $audio->get_type(), 'audio/' ) !== 0 ) { continue; }
			$images = $item->get_item_tags( 'http://www.itunes.com/dtds/podcast-1.0.dtd', 'image' );
			$duration = $item->get_item_tags( 'http://www.itunes.com/dtds/podcast-1.0.dtd', 'duration' );
			$episodes[] = array(
				'title' => wp_strip_all_tags( $item->get_title() ),
				'url' => $item->get_permalink(),
				'audio' => $audio->get_link(),
				'image' => $images[0]['attribs']['']['href'] ?? '',
				'date' => $item->get_date( DATE_RSS ),
				'duration' => $duration[0]['data'] ?? '',
			);
		}
	}
	$result = $episodes ?: $fallback;
	// Newest first regardless of how the feed orders itself (serial shows can list oldest first).
	usort( $result, static function ( $a, $b ) { return strtotime( $b['date'] ) - strtotime( $a['date'] ); } );
	$result = array_slice( $result, 0, 10 );
	set_transient( 'sc_podcast_library_v1', $result, $episodes ? HOUR_IN_SECONDS : 15 * MINUTE_IN_SECONDS );
	return $result;
}
