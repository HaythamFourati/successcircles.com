<?php
/** Listen to Rules For Success without leaving the homepage. */
defined( 'ABSPATH' ) || exit;
?>
<section id="podcast" class="sc-section" aria-label="<?php esc_attr_e( 'RulesForSuccess.com podcast', 'successcircles' ); ?>">
	<?php get_template_part( 'template-parts/podcast-player' ); ?>
</section>
