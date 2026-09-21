<?php
/**
 * One member film — a click-to-play facade.
 *
 * Nothing is requested from Vimeo until the visitor presses play: the poster is
 * a local file and theme.js swaps the button for the iframe on click, so the
 * page carries no third-party player and sets no cookies on load. Same contract
 * as the homepage story video — see initStoryVideo() in theme.js, which replaces
 * the button inside its parent element.
 *
 * @package SuccessCircles
 *
 * @var array<string, mixed> $args {
 *     @type array<string, mixed> $film     One entry from the `testimonials.videos` content block.
 *     @type string               $play     Localised "Play" label.
 *     @type bool                 $featured Larger treatment for the opener.
 *     @type string               $dir      Poster directory under assets/img/. Defaults to "testimonials".
 * }
 */

defined( 'ABSPATH' ) || exit;

$sc_film     = (array) $args['film'];
$sc_play     = isset( $args['play'] ) ? (string) $args['play'] : __( 'Play', 'successcircles' );
$sc_featured = ! empty( $args['featured'] );
$sc_dir      = isset( $args['dir'] ) ? (string) $args['dir'] : 'testimonials';

$sc_embed = add_query_arg(
	array(
		'autoplay' => 1,
		'title'    => 0,
		'byline'   => 0,
		'portrait' => 0,
	),
	'https://player.vimeo.com/video/' . rawurlencode( $sc_film['id'] )
);

/* translators: %s: member name. */
$sc_label = sprintf( __( 'Play: %s', 'successcircles' ), $sc_film['name'] );

?>
<figure class="sc-film<?php echo $sc_featured ? ' sc-film--featured' : ''; ?>">
	<div class="sc-film__frame">
		<button
			class="sc-film__play"
			type="button"
			data-sc-video="<?php echo esc_url( $sc_embed ); ?>"
			data-sc-video-title="<?php echo esc_attr( $sc_film['name'] ); ?>"
			aria-label="<?php echo esc_attr( $sc_label ); ?>"
		>
			<img
				src="<?php echo esc_url( SUCCESSCIRCLES_URI . '/assets/img/' . $sc_dir . '/' . $sc_film['poster'] ); ?>"
				alt=""
				width="<?php echo esc_attr( (string) $sc_film['width'] ); ?>"
				height="<?php echo esc_attr( (string) $sc_film['height'] ); ?>"
				loading="lazy"
				decoding="async"
			>
			<span class="sc-film__scrim" aria-hidden="true"></span>
			<span class="sc-film__disc" aria-hidden="true"></span>
			<?php if ( ! empty( $sc_film['duration'] ) ) : ?><span class="sc-film__time" aria-hidden="true"><?php echo esc_html( $sc_film['duration'] ); ?></span><?php endif; ?>
		</button>
	</div>

	<figcaption class="sc-film__caption">
		<span class="sc-film__name"><?php echo esc_html( $sc_film['name'] ); ?></span>
		<span class="sc-film__kind"><?php echo esc_html( $sc_film['kind'] ); ?></span>
	<?php if ( ! empty( $sc_film['role'] ) ) : ?><span class="sc-film__role"><?php echo esc_html( $sc_film['role'] ); ?></span><?php endif; ?>
	</figcaption>
</figure>
