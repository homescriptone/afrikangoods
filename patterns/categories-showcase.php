<?php
/**
 * Title: Categories Showcase
 * Slug: afrikangoods/categories-showcase
 * Categories: afrikangoods, woocommerce
 */
declare( strict_types = 1 );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"tertiary"} -->
<div class="wp-block-group alignfull has-tertiary-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:group {"style":{"spacing":{"padding":{"left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group" style="padding-left:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40)">
		<!-- wp:heading {"textAlign":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"fontFamily":"heading"} -->
		<h2 class="wp-block-heading has-text-align-center" style="text-transform:uppercase;letter-spacing:0.1em;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><?php echo esc_html__( 'Ce Que Nous Proposons', 'afrikangoods' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"small","textColor":"warm","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}}} -->
		<p class="has-text-align-center has-warm-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)"><?php echo esc_html__( 'Une large gamme de produits bruts africains, triés sur le volet pour les professionnels', 'afrikangoods' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:html -->
		<div class="wp-block-query alignwide">
			<?php
			$categories = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
				'parent'     => 0,
			) );
			if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
				<ul class="wp-block-post-template is-layout-grid wp-block-post-template-is-layout-grid" style="display:grid;grid-template-columns:repeat(3, minmax(0, 1fr));gap:1.5rem;width:100%;list-style:none;margin:0;padding:0;">
					<?php foreach ( $categories as $cat ) :
						$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
						$image        = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'medium' ) : wc_placeholder_img_src();
						$description  = $cat->description;
						?>
						<li class="afrikangoods-category-cards-item">
							<a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="afrikangoods-category-card-link" style="text-decoration:none;display:block;height:100%;">
								<div class="afrikangoods-category-card" style="border-radius:12px;background-color:#ffffff;overflow:hidden;box-shadow:0 2px 16px rgba(62,42,29,0.06);transition:transform 0.3s ease, box-shadow 0.3s ease;height:100%;">
									<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $cat->name ); ?>" class="afrikangoods-category-card-image" style="width:100%;object-fit:contain;display:block;" loading="lazy">
									<div class="afrikangoods-category-card-body" style="padding:var(--wp--preset--spacing--30);text-align:center;">
										<h3 class="afrikangoods-category-card-title" style="font-family:'Playfair Display',serif;font-size:var(--wp--preset--font-size--medium,1.063rem);font-weight:600;margin:0 0 0.5rem;color:var(--wp--preset--color--contrast,#3e2a1d);"><?php echo esc_html( $cat->name ); ?></h3>
										<?php if ( $description ) : ?>
											<p class="afrikangoods-category-card-description" style="font-size:0.875rem;color:var(--wp--preset--color--contrast,#3e2a1d);margin:0;opacity:0.8;line-height:1.5;"><?php echo esc_html( wp_trim_words( $description, 20, '...' ) ); ?></p>
										<?php endif; ?>
									</div>
								</div>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<!-- /wp:html -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
		<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--60)">
			<!-- wp:button {"backgroundColor":"primary","className":"is-style-fill"} -->
			<div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-primary-background-color has-base-color has-text-color has-background wp-element-button" href="/boutique"><?php echo esc_html__( 'Voir Tous Nos Produits', 'afrikangoods' ); ?></a></div>
			<!-- /wp:button -->
		</div>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->