<?php
/**
 * The search form.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_search_id = wp_unique_id( 'sc-search-' );

?>
<form class="sc-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sc-screen-reader-text" for="<?php echo esc_attr( $sc_search_id ); ?>">
		<?php esc_html_e( 'Search', 'successcircles' ); ?>
	</label>
	<input
		class="sc-search__field"
		type="search"
		id="<?php echo esc_attr( $sc_search_id ); ?>"
		name="s"
		value="<?php echo esc_attr( get_search_query() ); ?>"
		placeholder="<?php esc_attr_e( 'Search&hellip;', 'successcircles' ); ?>"
	>
	<button class="sc-btn sc-btn--primary sc-btn--compact" type="submit">
		<?php esc_html_e( 'Search', 'successcircles' ); ?>
	</button>
</form>
