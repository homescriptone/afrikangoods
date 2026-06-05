<?php
/**
 * Title: FAQ Section
 * Slug: afrikangoods/faq-section
 * Categories: afrikangoods
 */
declare( strict_types = 1 );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"base"} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"textAlign":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.02em"}},"fontFamily":"heading"} -->
		<h2 class="wp-block-heading has-text-align-center" style="text-transform:uppercase;letter-spacing:0.02em"><?php echo esc_html__( 'Questions Fréquentes', 'afrikangoods' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"small","textColor":"warm"} -->
		<p class="has-text-align-center has-warm-color has-text-color has-small-font-size"><?php echo esc_html__( 'Tout ce que vous devez savoir sur notre service d\'approvisionnement', 'afrikangoods' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)">
			<!-- wp:details {"className":"afrikangoods-faq-item"} -->
			<details class="wp-block-details afrikangoods-faq-item">
				<summary><?php echo esc_html__( 'Quels types de produits proposez-vous ?', 'afrikangoods' ); ?></summary>
				<p class="has-small-font-size"><?php echo esc_html__( 'Nous proposons une large gamme de produits bruts africains : huiles naturelles, beurres végétaux, épices, céréales, fruits séchés, artisanat et bien plus. Chaque produit est soigneusement sélectionné auprès de producteurs locaux de confiance.', 'afrikangoods' ); ?></p>
			</details>
			<!-- /wp:details -->

			<!-- wp:details {"className":"afrikangoods-faq-item"} -->
			<details class="wp-block-details afrikangoods-faq-item">
				<summary><?php echo esc_html__( 'Quels sont vos délais de livraison ?', 'afrikangoods' ); ?></summary>
				<p class="has-small-font-size"><?php echo esc_html__( 'Les délais varient selon la destination et le type de produit. En moyenne, comptez 7 à 15 jours ouvrés pour l\'Afrique de l\'Ouest et 10 à 21 jours pour le reste du monde. Un devis personnalisé vous sera communiqué avec les délais précis.', 'afrikangoods' ); ?></p>
			</details>
			<!-- /wp:details -->

			<!-- wp:details {"className":"afrikangoods-faq-item"} -->
			<details class="wp-block-details afrikangoods-faq-item">
				<summary><?php echo esc_html__( 'Puis-je commander un produit spécifique qui n\'est pas sur le site ?', 'afrikangoods' ); ?></summary>
				<p class="has-small-font-size"><?php echo esc_html__( 'Oui, absolument ! Nous travaillons avec un vaste réseau de producteurs et coopératives à travers l\'Afrique. Contactez-nous via le formulaire de requête avec vos besoins précis, et nous trouverons la meilleure source pour vous.', 'afrikangoods' ); ?></p>
			</details>
			<!-- /wp:details -->

			<!-- wp:details {"className":"afrikangoods-faq-item"} -->
			<details class="wp-block-details afrikangoods-faq-item">
				<summary><?php echo esc_html__( 'Quels sont vos modes de paiement ?', 'afrikangoods' ); ?></summary>
				<p class="has-small-font-size"><?php echo esc_html__( 'Nous acceptons les virements bancaires internationaux, les paiements mobiles (Orange Money, MTN MoMo), et les cartes bancaires. Pour les commandes professionnelles, des facilités de paiement peuvent être discutées.', 'afrikangoods' ); ?></p>
			</details>
			<!-- /wp:details -->

			<!-- wp:details {"className":"afrikangoods-faq-item"} -->
			<details class="wp-block-details afrikangoods-faq-item">
				<summary><?php echo esc_html__( 'Proposez-vous des remises pour les commandes en gros ?', 'afrikangoods' ); ?></summary>
				<p class="has-small-font-size"><?php echo esc_html__( 'Oui, nous offrons des tarifs dégressifs pour les commandes en volume. Contactez notre équipe commerciale avec vos quantités estimées pour obtenir un devis personnalisé avantageux.', 'afrikangoods' ); ?></p>
			</details>
			<!-- /wp:details -->

			<!-- wp:details {"className":"afrikangoods-faq-item"} -->
			<details class="wp-block-details afrikangoods-faq-item">
				<summary><?php echo esc_html__( 'Comment puis-je suivre ma commande ?', 'afrikangoods' ); ?></summary>
				<p class="has-small-font-size"><?php echo esc_html__( 'Une fois votre commande expédiée, vous recevrez un numéro de suivi par email. Vous pourrez suivre votre colis en temps réel jusqu\'à la livraison finale.', 'afrikangoods' ); ?></p>
			</details>
			<!-- /wp:details -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->