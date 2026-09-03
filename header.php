<?php
/**
 * The site header.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="sc-skip-link" href="#sc-main"><?php esc_html_e( 'Skip to content', 'successcircles' ); ?></a>

<?php if ( is_front_page() && successcircles_home_loader_enabled() ) : ?>
	<?php get_template_part( 'template-parts/loader' ); ?>
<?php endif; ?>

<?php get_template_part( 'template-parts/site-header' ); ?>

<main id="sc-main">
