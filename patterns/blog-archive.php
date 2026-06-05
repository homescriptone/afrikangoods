<?php
/**
 * Title: Blog Archive
 * Slug: afrikangoods/blog-archive
 * Categories: afrikangoods, posts
 */
declare( strict_types = 1 );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"base"} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:group {"style":{"spacing":{"padding":{"left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group" style="padding-left:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40)">
		<!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)">
			<!-- wp:query-title {"type":"archive","textAlign":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.1em"}},"fontFamily":"heading"} /-->
			<!-- wp:term-description {"textAlign":"center"} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:query {"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide"} -->
		<div class="wp-block-query alignwide">
			<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"className":"afrikangoods-loop-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30"}},"border":{"radius":"12px"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group afrikangoods-loop-card has-background" style="border-radius:12px;background-color:#ffffff;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","style":{"border":{"radius":"8px"}}} /-->
				<!-- wp:post-title {"textAlign":"center","level":3,"isLink":true,"style":{"spacing":{"margin":{"bottom":"0.5rem","top":"var:preset|spacing|30"}}},"fontSize":"medium","fontFamily":"heading"} /-->
				<!-- wp:post-excerpt {"textAlign":"center","style":{"typography":{"fontSize":"0.875rem"}},"textColor":"contrast"} /-->
				<!-- wp:post-date {"textAlign":"center","fontSize":"x-small","textColor":"warm"} /-->
			</div>
			<!-- /wp:group -->
			<!-- /wp:post-template -->

			<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--60)">
				<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"center"}} -->
				<!-- wp:query-pagination-previous /-->
				<!-- wp:query-pagination-numbers /-->
				<!-- wp:query-pagination-next /-->
				<!-- /wp:query-pagination -->
			</div>
			<!-- /wp:group -->

			<!-- wp:query-no-results -->
			<!-- wp:paragraph {"textAlign":"center"} -->
			<p class="has-text-align-center"><?php echo esc_html__( 'Aucun article trouvé.', 'afrikangoods' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- /wp:query-no-results -->
		</div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
