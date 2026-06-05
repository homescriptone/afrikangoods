<?php
/**
 * Title: Contact Panel
 * Slug: afrikangoods/contact-panel
 * Categories: afrikangoods
 */
declare( strict_types = 1 );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"primary","textColor":"base"} -->
<div class="wp-block-group alignfull has-base-color has-primary-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:columns {"align":"wide"} -->
		<div class="wp-block-columns alignwide">
			<!-- wp:column {"width":"40%"} -->
			<div class="wp-block-column" style="flex-basis:40%">
				<!-- wp:heading {"level":2,"style":{"typography":{"lineHeight":"1.2","fontWeight":"700"},"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}},"fontSize":"xx-large","fontFamily":"heading"} -->
				<h2 class="wp-block-heading has-xx-large-font-size" style="margin-bottom:var(--wp--preset--spacing--40);font-weight:700;line-height:1.2"><?php echo esc_html__( 'Parlons de Votre Projet', 'afrikangoods' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.7","fontSize":"1.063rem"}}} -->
				<p style="font-size:1.063rem;line-height:1.7"><?php echo esc_html__( 'Que vous soyez importateur, distributeur ou entrepreneur, notre équipe est prête à vous accompagner dans votre projet d\'approvisionnement en produits africains.', 'afrikangoods' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:spacer {"height":"var:preset|spacing|40"} -->
				<div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
				<!-- /wp:spacer -->

				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
				<div class="wp-block-group">
					<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","fontSize":"1rem"}}} -->
					<p style="font-size:1rem;font-weight:600">📍 <?php echo esc_html__( 'Basé au Bénin — Expédition mondiale', 'afrikangoods' ); ?></p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","fontSize":"1rem"}}} -->
					<p style="font-size:1rem;font-weight:600">📧 <a href="mailto:afrikangoods1@gmail.com" style="color:inherit">afrikangoods1@gmail.com</a></p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","fontSize":"1rem"}}} -->
					<p style="font-size:1rem;font-weight:600">📞 <a href="tel:+2290191720582" style="color:inherit">+229 01 91 72 05 82</a></p>
					<!-- /wp:paragraph -->
					<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","fontSize":"1rem"}}} -->
					<p style="font-size:1rem;font-weight:600">⏱ <?php echo esc_html__( 'Réponse sous 24–48h', 'afrikangoods' ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"60%"} -->
			<div class="wp-block-column" style="flex-basis:60%">
				<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"radius":"16px"},"color":{"background":"rgba(255,255,255,0.1)"}},"className":"afrikangoods-contact-form-wrapper"} -->
				<div class="wp-block-group afrikangoods-contact-form-wrapper has-background" style="border-radius:16px;background-color:rgba(255,255,255,0.1);padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
					<!-- wp:heading {"level":3,"style":{"typography":{"fontWeight":"600"}},"fontSize":"large"} -->
					<h3 class="wp-block-heading has-large-font-size" style="font-weight:600"><?php echo esc_html__( 'Envoyez-nous un message', 'afrikangoods' ); ?></h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph {"fontSize":"small"} -->
					<p class="has-small-font-size"><?php echo esc_html__( 'Remplissez le formulaire ci-dessous et notre équipe commerciale vous recontactera dans les plus brefs délais.', 'afrikangoods' ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:shortcode -->
					[ninja_form id="1"]
					<!-- /wp:shortcode -->

					<!-- wp:html -->
					<div class="afrikangoods-turnstile-info">
						<p style="font-size:0.813rem;opacity:0.7;margin-top:1rem">
							<?php echo esc_html__( 'Protégé par Cloudflare Turnstile — Vos données sont sécurisées.', 'afrikangoods' ); ?>
						</p>
					</div>
					<!-- /wp:html -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
