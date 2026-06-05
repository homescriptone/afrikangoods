<?php
/**
 * Title: Categories Showcase
 * Slug: afrikangoods/categories-showcase
 * Categories: afrikangoods, woocommerce
 */
declare( strict_types = 1 );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"tertiary"} -->
<div class="wp-block-group alignfull has-tertiary-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:group {"style":{"spacing":{"padding":{"left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group" style="padding-left:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40)">
		<!-- wp:heading {"textAlign":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"fontFamily":"heading"} -->
		<h2 class="wp-block-heading has-text-align-center" style="text-transform:uppercase;letter-spacing:0.1em;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><?php echo esc_html__( 'Ce Que Nous Proposons', 'afrikangoods' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"small","textColor":"warm","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}}} -->
		<p class="has-text-align-center has-warm-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)"><?php echo esc_html__( 'Une large gamme de produits bruts africains, triés sur le volet pour les professionnels', 'afrikangoods' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:woocommerce/product-categories {"hasCount":false,"hasImage":true,"isHierarchical":false,"showChildrenOnly":false,"align":"wide","className":"afrikangoods-category-cards"} /-->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
		<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--60)">
			<!-- wp:button {"backgroundColor":"primary","className":"is-style-fill"} -->
			<div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-primary-background-color has-base-color has-text-color has-background wp-element-button" href="/boutique"><?php echo esc_html__( 'Voir Tous Nos Produits', 'afrikangoods' ); ?></a></div>
			<!-- /wp:button -->
		</div>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
