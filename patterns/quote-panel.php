<?php
/**
 * Title: Quote Panel
 * Slug: afrikangoods/quote-panel
 * Categories: afrikangoods, text
 */
declare( strict_types = 1 );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"secondary","textColor":"contrast"} -->
<div class="wp-block-group alignfull has-contrast-color has-secondary-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:pullquote {"textAlign":"center","className":"afrikangoods-quote-panel"} -->
		<figure class="wp-block-pullquote has-text-align-center afrikangoods-quote-panel">
			<blockquote>
				<p><?php echo esc_html__( '"Every product tells a story of heritage, craftsmanship, and the rich cultural tapestry of Africa. We bring these stories to your doorstep."', 'afrikangoods' ); ?></p>
				<cite><?php echo esc_html__( '— Afrikangoods Team', 'afrikangoods' ); ?></cite>
			</blockquote>
		</figure>
		<!-- /wp:pullquote -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
