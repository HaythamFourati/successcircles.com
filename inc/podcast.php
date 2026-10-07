<?php
/**
 * Podcast library: Spotify Web API (it is ahead of the Anchor RSS, which missed the
 * Sep 29 2026 episode); every card links out to Spotify to listen. The RSS is the
 * fallback, then the bundled JSON offline.
 *
 * Credentials are entered in Customizer → Success Circles → Podcast (Spotify).
 * Without them the library runs on RSS alone, as before.
 */
defined( 'ABSPATH' ) || exit;

function successcircles_podcast_episodes() {
	$cached = get_transient( 'sc_podcast_library_v3' );
	if ( is_array( $cached ) && $cached ) { return array_slice( $cached, 0, 10 ); }
	$fallback = json_decode( file_get_contents( SUCCESSCIRCLES_DIR . '/assets/data/podcast-episodes.json' ), true );
	$fallback = is_array( $fallback ) ? $fallback : array();
	$episodes = successcircles_podcast_spotify_episodes() ?: successcircles_podcast_rss_episodes();
	$result = $episodes ?: $fallback;
	// Newest first regardless of how the feed orders itself (serial shows can list oldest first).
	usort( $result, static function ( $a, $b ) { return strtotime( $b['date'] ) - strtotime( $a['date'] ); } );
	$result = array_slice( $result, 0, 10 );
	set_transient( 'sc_podcast_library_v3', $result, $episodes ? HOUR_IN_SECONDS : 15 * MINUTE_IN_SECONDS );
	return $result;
}

function successcircles_podcast_rss_episodes() {
	require_once ABSPATH . WPINC . '/feed.php';
	// SimplePie caches feeds for 12h by default on top of our transient; keep both at an hour.
	$sc_feed_ttl = static function () { return HOUR_IN_SECONDS; };
	add_filter( 'wp_feed_cache_transient_lifetime', $sc_feed_ttl );
	$feed = fetch_feed( 'https://anchor.fm/s/10e83df4c/podcast/rss' );
	remove_filter( 'wp_feed_cache_transient_lifetime', $sc_feed_ttl );
	$episodes = array();
	if ( is_wp_error( $feed ) ) { return $episodes; }
	foreach ( $feed->get_items() as $item ) {
		$audio = $item->get_enclosure();
		if ( ! $audio || ! $audio->get_link() || strpos( (string) $audio->get_type(), 'audio/' ) !== 0 ) { continue; }
		$images = $item->get_item_tags( 'http://www.itunes.com/dtds/podcast-1.0.dtd', 'image' );
		$duration = $item->get_item_tags( 'http://www.itunes.com/dtds/podcast-1.0.dtd', 'duration' );
		$episodes[] = array(
			'title' => wp_strip_all_tags( $item->get_title() ),
			'url' => $item->get_permalink(),
			'image' => $images[0]['attribs']['']['href'] ?? '',
			'date' => $item->get_date( DATE_RSS ),
			'duration' => $duration[0]['data'] ?? '',
		);
	}
	return $episodes;
}

/** Latest Spotify episodes; empty without credentials or when Spotify is unreachable. */
function successcircles_podcast_spotify_episodes() {
	$id = trim( (string) get_theme_mod( 'sc_spotify_client_id' ) );
	$secret = trim( (string) get_theme_mod( 'sc_spotify_client_secret' ) );
	if ( ! $id || ! $secret ) { return array(); }
	$token = wp_remote_post( 'https://accounts.spotify.com/api/token', array(
		'timeout' => 8,
		'headers' => array( 'Authorization' => 'Basic ' . base64_encode( $id . ':' . $secret ) ),
		'body' => array( 'grant_type' => 'client_credentials' ),
	) );
	$token = json_decode( wp_remote_retrieve_body( $token ), true )['access_token'] ?? '';
	if ( ! $token ) { return array(); }
	$response = wp_remote_get( 'https://api.spotify.com/v1/shows/64eUCSg7BqAo0EJf8cOp97/episodes?market=US&limit=10', array(
		'timeout' => 8,
		'headers' => array( 'Authorization' => 'Bearer ' . $token ),
	) );
	$items = json_decode( wp_remote_retrieve_body( $response ), true )['items'] ?? array();
	$episodes = array();
	foreach ( array_filter( (array) $items ) as $item ) {
		$seconds = (int) round( $item['duration_ms'] / 1000 );
		$episodes[] = array(
			'title' => $item['name'],
			'url' => $item['external_urls']['spotify'],
			'image' => $item['images'][1]['url'] ?? $item['images'][0]['url'] ?? '',
			'date' => $item['release_date'],
			'duration' => sprintf( '%d:%02d:%02d', $seconds / 3600, $seconds / 60 % 60, $seconds % 60 ),
		);
	}
	return $episodes;
}

/** "49 min" from a feed duration: seconds, M:SS or H:MM:SS. */
function successcircles_podcast_minutes( $duration ) {
	$seconds = 0;
	foreach ( explode( ':', (string) $duration ) as $part ) { $seconds = $seconds * 60 + (int) $part; }
	/* translators: %d: episode length in minutes. */
	return $seconds ? sprintf( __( '%d min', 'successcircles' ), max( 1, round( $seconds / 60 ) ) ) : '';
}
