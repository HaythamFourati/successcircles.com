<?php
/** Rules For Success destinations, shared by all single blog posts. */
defined( 'ABSPATH' ) || exit;
$sc_article_links = (array) successcircles_content( 'article_links', array() );
?>
<aside class="rf-article__sidebar" aria-labelledby="rf-sidebar-title">
	<h2 id="rf-sidebar-title"><?php esc_html_e( 'RulesForSuccess.com', 'successcircles' ); ?></h2>
	<p><?php esc_html_e( 'Listen, connect, or join the conversation.', 'successcircles' ); ?></p>
	<nav aria-label="<?php esc_attr_e( 'Rules For Success podcast links', 'successcircles' ); ?>">
		<ul class="rf-article__links">
			<?php foreach ( (array) $sc_article_links['links'] as $sc_link ) : ?>
				<li><a href="<?php echo successcircles_url( $sc_link['url'] ); ?>" target="_blank" rel="noopener noreferrer"><span><?php echo esc_html( $sc_link['label'] ); ?></span><span aria-hidden="true">↗</span></a></li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<h3><?php esc_html_e( 'Follow along', 'successcircles' ); ?></h3>
	<ul class="rf-article__social">
		<?php foreach ( (array) $sc_article_links['social'] as $sc_link ) : ?>
			<li>
				<a href="<?php echo successcircles_url( $sc_link['url'] ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $sc_link['label'] ); ?>" title="<?php echo esc_attr( $sc_link['label'] ); ?>">
					<?php echo successcircles_social_icon( $sc_link['label'], 20 ); // Trusted theme SVG. ?>
					<span class="screen-reader-text"><?php echo esc_html( $sc_link['label'] ); ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</aside>
