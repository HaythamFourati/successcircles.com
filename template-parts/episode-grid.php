<?php
/**
 * The Rules for Success card grid.
 *
 * Shared by the homepage podcast section and the episode archive so both render
 * the same card. Expects $args['episodes'] as returned by
 * successcircles_episodes() / successcircles_episode_fields().
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

$sc_items = isset( $args['episodes'] ) ? (array) $args['episodes'] : array();

if ( empty( $sc_items ) ) {
	return;
}

?>
<ul class="sc-podcast__grid">
	<?php foreach ( $sc_items as $sc_item ) : ?>
		<li class="sc-episode">
			<a href="<?php echo successcircles_url( $sc_item['url'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
				<?php
				successcircles_image(
					array(
						'id'   => isset( $sc_item['image_id'] ) ? (int) $sc_item['image_id'] : 0,
						'src'  => $sc_item['image'],
						'alt'  => $sc_item['alt'],
						'size' => 'successcircles-episode',
					)
				);
				?>
				<p class="sc-episode__role">
					<?php if ( ! empty( $sc_item['date'] ) ) : ?>
						<time datetime="<?php echo esc_attr( $sc_item['datetime'] ); ?>"><?php echo esc_html( $sc_item['date'] ); ?></time>
						<?php echo '' !== $sc_item['role'] ? ' &nbsp;/&nbsp; ' : ''; ?>
					<?php endif; ?>
					<?php echo esc_html( wp_specialchars_decode( $sc_item['role'] ) ); ?>
				</p>
				<h3 class="sc-episode__title"><?php echo esc_html( $sc_item['title'] ); ?></h3>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
