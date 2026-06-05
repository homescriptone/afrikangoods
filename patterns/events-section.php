<?php
/**
 * Title: Events Section
 * Slug: afrikangoods/events-section
 * Categories: afrikangoods
 */
declare( strict_types = 1 );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"tertiary"} -->
<div class="wp-block-group alignfull has-tertiary-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"textAlign":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.02em"}},"fontFamily":"heading"} -->
		<h2 class="wp-block-heading has-text-align-center" style="text-transform:uppercase;letter-spacing:0.02em"><?php echo esc_html__( 'Salons & Événements', 'afrikangoods' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"small","textColor":"warm"} -->
		<p class="has-text-align-center has-warm-color has-text-color has-small-font-size"><?php echo esc_html__( 'Retrouvez-nous sur les principaux salons professionnels et événements du secteur', 'afrikangoods' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:query {"queryId":3,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":{"taxonomy":"category","terms":["events"],"field":"slug","operator":"IN"}},"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
		<div class="wp-block-query alignwide" style="margin-top:var(--wp--preset--spacing--50)">
			<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"className":"afrikangoods-event-card"} -->
			<div class="wp-block-group afrikangoods-event-card">
				<!-- wp:post-featured-image {"isLink":true,"style":{"spacing":{"margin":{"bottom":"1rem"}}},"className":"afrikangoods-event-thumb"} /-->
				<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"large","fontFamily":"heading"} /-->
				<!-- wp:post-date {"fontSize":"small","textColor":"primary"} /-->
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