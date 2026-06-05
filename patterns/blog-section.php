<?php
/**
 * Title: Blog Section
 * Slug: afrikangoods/blog-section
 * Categories: afrikangoods, posts
 */
declare( strict_types = 1 );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"base"} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">
	<!-- wp:group {"style":{"spacing":{"padding":{"left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group" style="padding-left:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40)">
		<!-- wp:heading {"textAlign":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"fontFamily":"heading"} -->
		<h2 class="wp-block-heading has-text-align-center" style="text-transform:uppercase;letter-spacing:0.1em;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><?php echo esc_html__( 'Blog & Recettes', 'afrikangoods' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"small","textColor":"warm","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}}} -->
		<p class="has-text-align-center has-warm-color has-text-color has-small-font-size" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)"><?php echo esc_html__( 'Conseils, recettes et guides autour des produits du terroir africain', 'afrikangoods' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:html -->
		<div class="wp-block-query alignwide">
			<?php
			$posts = get_posts( array(
				'posts_per_page' => 3,
				'post_type'      => 'post',
				'orderby'        => 'date',
				'order'          => 'DESC',
			) );

			if ( ! empty( $posts ) ) : ?>
				<div class="wp-block-post-template is-layout-grid wp-block-post-template-is-layout-grid" style="grid-template-columns:repeat(3, minmax(0, 1fr));gap:1.5rem;">
					<?php foreach ( $posts as $post ) :
						setup_postdata( $post );
						$thumbnail = get_the_post_thumbnail_url( $post, 'medium' ) ?: 'https://media.tiyalo.com/logo.png';
						$categories = get_the_category( $post->ID );
						$excerpt = wp_trim_words( get_the_excerpt( $post ), 15, '...' );
						if ( strlen( $excerpt ) > 90 ) {
							$excerpt = substr( $excerpt, 0, 90 ) . '...';
						}
						?>
						<div class="wp-block-group afrikangoods-loop-card has-background" style="border-radius:12px;background-color:#ffffff;padding:var(--wp--preset--spacing--30) var(--wp--preset--spacing--30) var(--wp--preset--spacing--40);box-shadow:0 2px 16px rgba(62,42,29,0.06);transition:transform 0.3s ease, box-shadow 0.3s ease;overflow:hidden;">
							<a href="<?php the_permalink(); ?>" style="text-decoration:none;color:inherit;display:flex;flex-direction:column;">
								<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php the_title(); ?>" style="width:100%;aspect-ratio:4/3;object-fit:cover;border-radius:8px;display:block;" loading="lazy">
								<h3 style="font-family:'Playfair Display',serif;font-size:var(--wp--preset--font-size--medium,1.063rem);font-weight:600;margin:var(--wp--preset--spacing--30,1rem) 0 0.5rem;text-align:center;color:var(--wp--preset--color--contrast,#3e2a1d);"><?php the_title(); ?></h3>
								<?php if ( $excerpt ) : ?>
									<p style="font-size:0.875rem;text-align:center;color:var(--wp--preset--color--contrast,#3e2a1d);margin:0 0 0.5rem;opacity:0.8;"><?php echo esc_html( $excerpt ); ?></p>
								<?php endif; ?>
								<div style="display:flex;justify-content:center;align-items:center;gap:0.75rem;font-size:var(--wp--preset--font-size--x-small,0.781rem);color:var(--wp--preset--color--warm,#b5623e);">
									<?php if ( ! empty( $categories ) ) : ?>
										<span><?php echo esc_html( $categories[0]->name ); ?></span>
									<?php endif; ?>
									<span><?php echo get_the_date( 'j F Y' ); ?></span>
								</div>
							</a>
						</div>
					<?php endforeach;
					wp_reset_postdata(); ?>
				</div>
			<?php endif; ?>
		</div>
		<!-- /wp:html -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
		<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--60)">
			<!-- wp:button {"backgroundColor":"primary"} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-primary-background-color has-base-color has-text-color has-background wp-element-button" href="/blog"><?php echo esc_html__( 'Lire Tous Nos Articles', 'afrikangoods' ); ?></a></div>
			<!-- /wp:button -->
		</div>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
