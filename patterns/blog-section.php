<?php
/**
 * Title: Blog Section
 * Slug: afrikangoods/blog-section
 * Categories: afrikangoods, posts
 */
declare( strict_types = 1 );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"base"} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:group {"style":{"spacing":{"padding":{"left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group" style="padding-left:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40)">
		<!-- wp:heading {"textAlign":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"fontFamily":"heading"} -->
		<h2 class="wp-block-heading has-text-align-center" style="text-transform:uppercase;letter-spacing:0.1em;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><?php echo esc_html__( 'Blog & Recettes', 'afrikangoods' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"small","textColor":"warm","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}}} -->
		<p class="has-text-align-center has-warm-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)"><?php echo esc_html__( 'Conseils, recettes et guides autour des produits du terroir africain', 'afrikangoods' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:query {"queryId":4,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide"} -->
		<div class="wp-block-query alignwide">
			<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"className":"afrikangoods-loop-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30"}},"border":{"radius":"12px"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group afrikangoods-loop-card has-background" style="border-radius:12px;background-color:#ffffff;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","style":{"border":{"radius":"8px"}}} /-->
				<!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"bottom":"0.5rem","top":"var:preset|spacing|30"}}},"fontSize":"medium","fontFamily":"heading"} /-->
				<!-- wp:post-excerpt {"style":{"typography":{"fontSize":"0.875rem"}},"textColor":"contrast"} /-->
				<!-- wp:post-date {"fontSize":"x-small","textColor":"warm"} /-->
			</div>
			<!-- /wp:group -->
			<!-- /wp:post-template -->
		</div>
		<!-- /wp:query -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
		<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--60)">
			<!-- wp:button {"backgroundColor":"primary"} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-primary-background-color has-base-color has-text-color has-background wp-element-button" href="/blog"><?php echo esc_html__( 'Lire Tous Nos Articles', 'afrikangoods' ); ?></a></div>
			<!-- /wp:button -->
		</div>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
