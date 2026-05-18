<?php
/**
 * Title: Hero
 * Slug: afrikangoods/hero-carousel
 * Categories: afrikangoods, featured
 */
declare( strict_types = 1 );
?>
<!-- wp:cover {"url":"https://media.tiyalo.com/wp-content/uploads/2025/01/african-market-hero.jpg","id":1,"dimRatio":50,"overlayColor":"deep","minHeight":75,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}}} -->
<div class="wp-block-cover alignfull" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:75vh">
	<span aria-hidden="true" class="wp-block-cover__background has-deep-background-color has-background-dim-50 has-background-dim"></span>
	<img class="wp-block-cover__image-background wp-image-1" alt="" src="https://media.tiyalo.com/wp-content/uploads/2025/01/african-market-hero.jpg" data-object-fit="cover"/>
	<div class="wp-block-cover__inner-container">
		<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
			<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"textTransform":"uppercase","fontWeight":"700","fontSize":"clamp(2.5rem, 6vw, 5rem)"}},"textColor":"base"} -->
			<h1 class="wp-block-heading has-text-align-center has-base-color has-text-color" style="font-size:clamp(2.5rem, 6vw, 5rem);font-weight:700;text-transform:uppercase"><?php echo esc_html__( 'Votre Porte d\'Entrée vers l\'Afrique', 'afrikangoods' ); ?></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","fontSize":"large","textColor":"tertiary"} -->
			<p class="has-text-align-center has-tertiary-color has-text-color has-large-font-size"><?php echo esc_html__( 'Nous sourçons et fournissons les meilleurs produits bruts africains pour les entreprises du monde entier. Qualité, authenticité, fiabilité.', 'afrikangoods' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
			<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--60)">
				<!-- wp:button {"backgroundColor":"warm","className":"is-style-fill"} -->
				<div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-warm-background-color has-base-color has-text-color has-background wp-element-button" href="/contact"><?php echo esc_html__( 'Devenir Partenaire', 'afrikangoods' ); ?></a></div>
				<!-- /wp:button -->
				<!-- wp:button {"backgroundColor":"base","className":"is-style-outline","textColor":"base"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-base-color has-text-color wp-element-button" href="/boutique"><?php echo esc_html__( 'Voir Nos Produits', 'afrikangoods' ); ?></a></div>
				<!-- /wp:button -->
			</div>
		</div>
		<!-- /wp:group -->
	</div>
</div>
<!-- /wp:cover -->
