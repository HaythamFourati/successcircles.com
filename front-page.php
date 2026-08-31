<?php
/**
 * The homepage.
 *
 * Sections are rendered in the order established by the 2026 redesign. Each is
 * a self-contained template part so it can be reordered or reused elsewhere.
 *
 * @package SuccessCircles
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'template-parts/home/hero' );
get_template_part( 'template-parts/home/trust' );
get_template_part( 'template-parts/home/problem' );
get_template_part( 'template-parts/home/system' );
get_template_part( 'template-parts/home/programs' );
get_template_part( 'template-parts/home/process' );
get_template_part( 'template-parts/home/stories' );
get_template_part( 'template-parts/home/test' );
get_template_part( 'template-parts/home/founder' );
get_template_part( 'template-parts/home/faq' );
get_template_part( 'template-parts/home/cta' );

get_footer();
