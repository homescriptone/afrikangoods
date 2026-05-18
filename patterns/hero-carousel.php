<?php
/**
 * Title: Hero Carousel
 * Slug: afrikangoods/hero-carousel
 * Categories: afrikangoods, featured
 */
declare( strict_types = 1 );
?>
<!-- wp:cover {"overlayColor":"deep","minHeight":60,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}}} -->
<div class="wp-block-cover alignfull" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:60vh">
	<span aria-hidden="true" class="wp-block-cover__background has-deep-background-color has-background-dim-100 has-background-dim"></span>
	<div class="wp-block-cover__inner-container">
		<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
			<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"textTransform":"uppercase","fontWeight":"700"}},"textColor":"base"} -->
			<h1 class="wp-block-heading has-text-align-center has-base-color has-text-color" style="font-weight:700;text-transform:uppercase"><?php echo esc_html__( 'Authentic African Treasures', 'afrikangoods' ); ?></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","fontSize":"large","textColor":"tertiary"} -->
			<p class="has-text-align-center has-tertiary-color has-text-color has-large-font-size"><?php echo esc_html__( 'Discover the finest raw products sourced directly from African communities', 'afrikangoods' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
			<div class="wp-block-buttons">
				<!-- wp:button {"backgroundColor":"warm","className":"is-style-fill"} -->
				<div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-warm-background-color has-background wp-element-button" href="/shop"><?php echo esc_html__( 'Shop Now', 'afrikangoods' ); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
	</div>
</div>
<!-- /wp:cover -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"base"} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
	<!-- wp:gallery {"columns":4,"imageCrop":true,"linkTo":"none","align":"wide","className":"afrikangoods-carousel"} -->
	<figure class="wp-block-gallery alignwide has-nested-images columns-4 is-cropped afrikangoods-carousel">
		<!-- wp:image {"sizeSlug":"large"} -->
		<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/screenshot.png' ); ?>" alt="<?php echo esc_attr__( 'African product', 'afrikangoods' ); ?>"/></figure>
		<!-- /wp:image -->
		<!-- wp:image {"sizeSlug":"large"} -->
		<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/screenshot.png' ); ?>" alt="<?php echo esc_attr__( 'African product', 'afrikangoods' ); ?>"/></figure>
		<!-- /wp:image -->
		<!-- wp:image {"sizeSlug":"large"} -->
		<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/screenshot.png' ); ?>" alt="<?php echo esc_attr__( 'African product', 'afrikangoods' ); ?>"/></figure>
		<!-- /wp:image -->
		<!-- wp:image {"sizeSlug":"large"} -->
		<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/screenshot.png' ); ?>" alt="<?php echo esc_attr__( 'African product', 'afrikangoods' ); ?>"/></figure>
		<!-- /wp:image -->
	</figure>
	<!-- /wp:gallery -->
</div>
<!-- /wp:group -->
