<?php
/**
 * Title: Contact Panel
 * Slug: afrikangoods/contact-panel
 * Categories: afrikangoods
 */
declare( strict_types = 1 );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"primary","textColor":"base"} -->
<div class="wp-block-group alignfull has-base-color has-primary-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:columns {"align":"wide"} -->
		<div class="wp-block-columns alignwide">
			<!-- wp:column {"width":"40%"} -->
			<div class="wp-block-column" style="flex-basis:40%">
				<!-- wp:heading {"level":2,"style":{"typography":{"textTransform":"uppercase"}}} -->
				<h2 class="wp-block-heading" style="text-transform:uppercase"><?php echo esc_html__( 'Prêt à Travailler Avec Nous ?', 'afrikangoods' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p><?php echo esc_html__( 'Que vous soyez un importateur, un distributeur ou une entreprise cherchant à sourcer des produits africains de qualité, nous sommes là pour vous accompagner.', 'afrikangoods' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:list -->
				<ul class="wp-block-list">
					<li><?php echo esc_html__( '📍 Basé en Afrique, livraison dans le monde entier', 'afrikangoods' ); ?></li>
					<li><?php echo esc_html__( '📧 hello@afrikangoods.com', 'afrikangoods' ); ?></li>
					<li><?php echo esc_html__( '📞 +234 800 AFRICAN', 'afrikangoods' ); ?></li>
					<li><?php echo esc_html__( '⏱ Devis sous 48h', 'afrikangoods' ); ?></li>
				</ul>
				<!-- /wp:list -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"60%"} -->
			<div class="wp-block-column afrikangoods-contact-panel">
				<!-- wp:heading {"level":3,"style":{"typography":{"textTransform":"uppercase"}}} -->
				<h3 class="wp-block-heading" style="text-transform:uppercase"><?php echo esc_html__( 'Demander un Devis', 'afrikangoods' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p><?php echo esc_html__( 'Remplissez le formulaire ci-dessous. Notre équipe commerciale vous répondra sous 24 à 48 heures.', 'afrikangoods' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:jetpack/contact-form {"subject":"Nouvelle demande de devis - Afrikangoods","to":"","className":"afrikangoods-contact-form"} -->
				<div class="wp-block-jetpack-contact-form afrikangoods-contact-form">
					<!-- wp:jetpack/field-name {"required":true,"label":"Nom de l'entreprise"} /-->
					<!-- wp:jetpack/field-email {"required":true,"label":"Email professionnel"} /-->
					<!-- wp:jetpack/field-textarea {"required":true,"label":"Votre message (produits recherchés, quantités, destination)"} /-->
					<!-- wp:jetpack/button {"element":"button","text":"Demander un Devis"} /-->
				</div>
				<!-- /wp:jetpack/contact-form -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
