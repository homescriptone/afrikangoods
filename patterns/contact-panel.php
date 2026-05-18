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
			<!-- wp:column -->
			<div class="wp-block-column">
				<!-- wp:heading {"level":2,"style":{"typography":{"textTransform":"uppercase"}}} -->
				<h2 class="wp-block-heading" style="text-transform:uppercase"><?php echo esc_html__( 'Get in Touch', 'afrikangoods' ); ?></h2>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p><?php echo esc_html__( 'Have questions about our products or want to partner with us? We\'d love to hear from you.', 'afrikangoods' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:list -->
				<ul class="wp-block-list">
					<li><?php echo esc_html__( '📍 Based in Africa, shipping worldwide', 'afrikangoods' ); ?></li>
					<li><?php echo esc_html__( '📧 hello@afrikangoods.com', 'afrikangoods' ); ?></li>
					<li><?php echo esc_html__( '📞 +234 800 AFRICAN', 'afrikangoods' ); ?></li>
				</ul>
				<!-- /wp:list -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column afrikangoods-contact-panel">
				<!-- wp:heading {"level":3,"style":{"typography":{"textTransform":"uppercase"}}} -->
				<h3 class="wp-block-heading" style="text-transform:uppercase"><?php echo esc_html__( 'Send Us a Message', 'afrikangoods' ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p><?php echo esc_html__( 'Use the contact form below and we\'ll get back to you within 24 hours.', 'afrikangoods' ); ?></p>
				<!-- /wp:paragraph -->

				<!-- wp:jetpack/contact-form {"subject":"New message from Afrikangoods","to":"","className":"afrikangoods-contact-form"} -->
				<div class="wp-block-jetpack-contact-form afrikangoods-contact-form">
					<!-- wp:jetpack/field-name {"required":true} /-->
					<!-- wp:jetpack/field-email {"required":true} /-->
					<!-- wp:jetpack/field-textarea /-->
					<!-- wp:jetpack/button {"element":"button","text":"Send Message"} /-->
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
