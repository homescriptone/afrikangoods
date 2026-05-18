<?php

require_once get_stylesheet_directory() . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'afrikangoods_register_required_plugins' );

function afrikangoods_register_required_plugins() {
	$plugins = array(
		array(
			'name'     => 'WooCommerce',
			'slug'     => 'woocommerce',
			'required' => true,
		),
		array(
			'name'     => 'Secure Custom Fields',
			'slug'     => 'secure-custom-fields',
			'required' => true,
		),
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false,
		),
	);

	$config = array(
		'id'           => 'afrikangoods',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
