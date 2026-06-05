<?php
/**
 * Title: Hero section
 * Slug: afrikangoods/hero
 * Categories: afrikangoods, posts
 */
declare( strict_types = 1 );

$hero_image = get_stylesheet_directory_uri() . '/assets/homepage.jpg';
?>

<!-- wp:cover {"url":"<?php echo esc_url( $hero_image ); ?>","dimRatio":50,"overlayColor":"deep","minHeight":90,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"className":"afrikangoods-hero"} -->

	<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained","contentSize":"780px"}} -->

		<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.15em","fontWeight":"600"}},"textColor":"accent","fontSize":"small"} -->
		<p class="has-text-align-center has-accent-color has-text-color has-small-font-size" style="letter-spacing:0.15em;text-transform:uppercase;font-weight:600">Du terroir africain à votre table</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontWeight":"700","fontSize":"clamp(2.25rem, 5vw, 4.5rem)","lineHeight":"1.1"}},"textColor":"base"} -->
		<h1 class="wp-block-heading has-text-align-center has-base-color has-text-color" style="font-size:clamp(2.25rem, 5vw, 4.5rem);font-weight:700;line-height:1.1">Les Richesses de la Terre Africaine</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.125rem","lineHeight":"1.6"}},"textColor":"tertiary"} -->
		<p class="has-text-align-center has-tertiary-color has-text-color" style="font-size:1.125rem;line-height:1.6">Nous sélectionnons et exportons les meilleurs produits bruts du continent — huiles précieuses, beurres végétaux, épices rares et céréales ancestrales, directement des coopératives locales jusqu'à vous.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->

			<!-- wp:button {"backgroundColor":"primary","className":"is-style-fill","style":{"border":{"radius":"8px"},"spacing":{"padding":{"left":"2rem","right":"2rem","top":"1rem","bottom":"1rem"}},"typography":{"fontWeight":"600"}},"fontSize":"medium"} -->
			<div class="wp-block-button is-style-fill has-custom-font-size has-medium-font-size"><a class="wp-block-button__link has-primary-background-color has-base-color has-text-color has-background wp-element-button" href="/boutique" style="border-radius:8px;padding-top:1rem;padding-right:2rem;padding-bottom:1rem;padding-left:2rem;font-weight:600">Découvrir Nos Produits</a></div>
			<!-- /wp:button -->

			<!-- wp:button {"textColor":"base","className":"is-style-outline","style":{"border":{"radius":"8px","width":"1px"},"spacing":{"padding":{"left":"2rem","right":"2rem","top":"1rem","bottom":"1rem"}},"typography":{"fontWeight":"600"}},"fontSize":"medium"} -->
			<div class="wp-block-button is-style-outline has-custom-font-size has-medium-font-size"><a class="wp-block-button__link has-base-color has-text-color wp-element-button" href="/contact" style="border-radius:8px;border-width:1px;padding-top:1rem;padding-right:2rem;padding-bottom:1rem;padding-left:2rem;font-weight:600">Nous Contacter</a></div>
			<!-- /wp:button -->

		<!-- /wp:buttons -->

	<!-- /wp:group -->

<!-- /wp:cover -->