<?php
/**
 * Title: Events Section
 * Slug: afrikangoods/events-section
 * Categories: afrikangoods
 */
declare( strict_types = 1 );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"deep","textColor":"base"} -->
<div class="wp-block-group alignfull has-base-color has-deep-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"textAlign":"center","style":{"typography":{"textTransform":"uppercase"}}} -->
		<h2 class="wp-block-heading has-text-align-center" style="text-transform:uppercase"><?php echo esc_html__( 'Events You Can\'t Miss', 'afrikangoods' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
		<p class="has-text-align-center has-small-font-size"><?php echo esc_html__( 'Stay connected with African culture, markets, and community gatherings', 'afrikangoods' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:query {"queryId":3,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":{"taxonomy":"category","terms":["events"],"field":"slug","operator":"IN"}},"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-query alignwide" style="margin-top:var(--wp--preset--spacing--50)">
			<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|40"}}},"backgroundColor":"deep"} -->
			<div class="wp-block-group has-deep-background-color has-background" style="padding-bottom:var(--wp--preset--spacing--40)">
				<!-- wp:post-featured-image {"isLink":true,"style":{"spacing":{"margin":{"bottom":"1rem"}}}} /-->
				<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"large"} /-->
				<!-- wp:post-date {"fontSize":"small","textColor":"tertiary"} /-->
				<!-- wp:post-excerpt {"fontSize":"small"} /-->
			</div>
			<!-- /wp:group -->
			<!-- /wp:post-template -->
		</div>
		<!-- /wp:query -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
