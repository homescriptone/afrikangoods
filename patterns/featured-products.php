<?php
/**
 * Title: Featured Products
 * Slug: afrikangoods/featured-products
 * Categories: afrikangoods, woocommerce
 */
declare( strict_types = 1 );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"base"} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"textAlign":"center","style":{"typography":{"textTransform":"uppercase"}}} -->
		<h2 class="wp-block-heading has-text-align-center" style="text-transform:uppercase"><?php echo esc_html__( 'Produits Phares', 'afrikangoods' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
		<p class="has-text-align-center has-small-font-size"><?php echo esc_html__( 'Les produits les plus demandés par nos partenaires commerciaux', 'afrikangoods' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:query {"queryId":1,"query":{"perPage":4,"pages":0,"offset":0,"postType":"product","order":"desc","orderBy":"popularity","author":"","search":"","exclude":[],"sticky":"","inherit":false,"__woocommerceStockStatus":["instock","outofstock"]},"namespace":"woocommerce/product-query","align":"wide"} -->
		<div class="wp-block-query alignwide">
			<!-- wp:post-template {"layout":{"type":"grid","columnCount":4},"__woocommerceNamespace":"woocommerce/product-query/product-template","className":"afrikangoods-product-grid"} -->
			<!-- wp:group {"className":"afrikangoods-product-card","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"0"}},"border":{"radius":"8px"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group afrikangoods-product-card has-background" style="border-radius:8px;background-color:#ffffff;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;margin-top:0">
				<!-- wp:woocommerce/product-image {"imageSizing":"cropped","isDescendentOfQueryLoop":true,"style":{"border":{"radius":"8px 8px 0 0"}}} /-->
				<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)">
					<!-- wp:post-title {"textAlign":"center","level":3,"isLink":true,"style":{"spacing":{"margin":{"bottom":"0.5rem","top":"0"}}},"fontSize":"medium","__woocommerceNamespace":"woocommerce/product-query/product-title"} /-->
					<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"textAlign":"center","fontSize":"small","style":{"spacing":{"margin":{"bottom":"0.75rem"}}}} /-->
					<!-- wp:woocommerce/product-button {"textAlign":"center","isDescendentOfQueryLoop":true,"fontSize":"small"} /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
			<!-- /wp:post-template -->
		</div>
		<!-- /wp:query -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)">
			<!-- wp:button {"backgroundColor":"primary"} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-primary-background-color has-base-color has-text-color has-background wp-element-button" href="/boutique"><?php echo esc_html__( 'Demander un Devis', 'afrikangoods' ); ?></a></div>
			<!-- /wp:button -->
		</div>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
