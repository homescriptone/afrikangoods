<?php
/**
 * Title: Blog Section
 * Slug: afrikangoods/blog-section
 * Categories: afrikangoods, posts
 */
declare( strict_types = 1 );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"deep","textColor":"base"} -->
<div class="wp-block-group alignfull has-base-color has-deep-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"textAlign":"center","style":{"typography":{"textTransform":"uppercase"}}} -->
		<h2 class="wp-block-heading has-text-align-center" style="text-transform:uppercase"><?php echo esc_html__( 'Actualités & Ressources', 'afrikangoods' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
		<p class="has-text-align-center has-small-font-size"><?php echo esc_html__( 'Conseils, analyses et guides sur l\'approvisionnement en produits africains', 'afrikangoods' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:query {"queryId":4,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-query alignwide" style="margin-top:var(--wp--preset--spacing--50)">
			<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|40"}}}} -->
			<div class="wp-block-group" style="padding-bottom:var(--wp--preset--spacing--40)">
				<!-- wp:post-featured-image {"isLink":true,"style":{"spacing":{"margin":{"bottom":"1rem"}}},"aspectRatio":"4/3"} /-->
				<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"large"} /-->
				<!-- wp:post-excerpt {"fontSize":"small"} /-->
				<!-- wp:post-date {"fontSize":"x-small","textColor":"tertiary"} /-->
			</div>
			<!-- /wp:group -->
			<!-- /wp:post-template -->
		</div>
		<!-- /wp:query -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)">
			<!-- wp:button {"backgroundColor":"base","className":"is-style-outline","textColor":"base"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-base-color has-text-color wp-element-button" href="/actualites"><?php echo esc_html__( 'Lire Tous Nos Articles', 'afrikangoods' ); ?></a></div>
			<!-- /wp:button -->
		</div>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
