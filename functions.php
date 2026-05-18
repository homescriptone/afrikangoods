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
