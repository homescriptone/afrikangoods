<?php

define( 'AFRIKANGOODS_THEME_VERSION', '1.0.0' );

if ( ! function_exists( 'afrikangoods_setup' ) ) {
	function afrikangoods_setup() {
		load_theme_textdomain( 'afrikangoods' );
	}
}
add_action( 'after_setup_theme', 'afrikangoods_setup' );

if ( ! function_exists( 'afrikangoods_enqueue_styles' ) ) {
	function afrikangoods_enqueue_styles() {
		$parent_style = 'kiosko-style';

		wp_enqueue_style(
			$parent_style,
			get_template_directory_uri() . '/style.css',
			array(),
			wp_get_theme( 'kiosko' )->get( 'Version' )
		);

		wp_enqueue_style(
			'afrikangoods-style',
			get_stylesheet_directory_uri() . '/style.css',
			array( $parent_style ),
			AFRIKANGOODS_THEME_VERSION
		);
	}
}
add_action( 'wp_enqueue_scripts', 'afrikangoods_enqueue_styles' );

require_once get_stylesheet_directory() . '/includes/required-plugins.php';
require_once get_stylesheet_directory() . '/includes/class-github-updater.php';

add_action( 'after_setup_theme', function () {
	$updater = new Afrikangoods_GitHub_Updater();
	$updater->init();
} );

function afrikangoods_register_menus() {
	register_nav_menus( array(
		'primary' => __( 'Navigation principale', 'afrikangoods' ),
	) );
}
add_action( 'after_setup_theme', 'afrikangoods_register_menus' );

function afrikangoods_limit_categories_block( $content ) {
	if ( ! preg_match_all( '/<li[^>]*class="[^"]*wc-block-product-categories-list-item[^"]*"[^>]*>.*?<\/li>/s', $content, $items ) ) {
		return $content;
	}
	if ( count( $items[0] ) <= 6 ) {
		return $content;
	}
	$extra = array_slice( $items[0], 6 );
	return str_replace( $extra, '', $content );
}

function afrikangoods_limit_categories_render( $block_content, $block ) {
	if ( $block['blockName'] === 'woocommerce/product-categories' ) {
		return afrikangoods_limit_categories_block( $block_content );
	}
	return $block_content;
}
add_filter( 'render_block', 'afrikangoods_limit_categories_render', 10, 2 );

function afrikangoods_event_fallback_image( $html, $post_id, $post_thumbnail_id ) {
	if ( empty( $html ) && has_term( 'events', 'category', $post_id ) ) {
		return '<img src="https://media.tiyalo.com/logo.png" class="wp-post-image" alt="' . esc_attr__( 'Événement', 'afrikangoods' ) . '" style="object-fit:contain;padding:2rem;background:var(--wp--preset--color--deep,#264653)"/>';
	}
	return $html;
}
add_filter( 'post_thumbnail_html', 'afrikangoods_event_fallback_image', 10, 3 );

function afrikangoods_register_block_pattern_categories() {
	register_block_pattern_category(
		'afrikangoods',
		array( 'label' => __( 'Afrikangoods', 'afrikangoods' ) )
	);
}
add_action( 'init', 'afrikangoods_register_block_pattern_categories' );

function afrikangoods_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'afrikangoods_woocommerce_support' );

function afrikangoods_scf_json() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	if ( file_exists( get_stylesheet_directory() . '/acf-fields.json' ) ) {
		$fields = json_decode( file_get_contents( get_stylesheet_directory() . '/acf-fields.json' ), true );
		if ( is_array( $fields ) ) {
			foreach ( $fields as $field_group ) {
				acf_add_local_field_group( $field_group );
			}
		}
	}
}
add_action( 'acf/init', 'afrikangoods_scf_json' );
