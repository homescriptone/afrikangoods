<?php

define( 'AFRIKANGOODS_THEME_VERSION', '2.0.0' );

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

if ( ! function_exists( 'afrikangoods_enqueue_fonts' ) ) {
	function afrikangoods_enqueue_fonts() {
		wp_enqueue_style(
			'afrikangoods-fonts',
			'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap',
			array(),
			AFRIKANGOODS_THEME_VERSION
		);
	}
}
add_action( 'wp_enqueue_scripts', 'afrikangoods_enqueue_fonts' );

if ( ! function_exists( 'as_next_scheduled_action' ) ) {
	function as_next_scheduled_action( $hook, $args = array(), $group = '' ) {
		return false;
	}
}
if ( ! function_exists( 'as_has_scheduled_action' ) ) {
	function as_has_scheduled_action( $hook, $args = array(), $group = '' ) {
		return false;
	}
}

require_once get_stylesheet_directory() . '/includes/required-plugins.php';
require_once get_stylesheet_directory() . '/includes/class-github-updater.php';
require_once get_stylesheet_directory() . '/includes/class-requetes.php';

add_action( 'init', function () {
	$updater = new Afrikangoods_GitHub_Updater();
	$updater->init();
} );

add_action( 'init', function () {
	$requetes = new Afrikangoods_Requetes();
	$requetes->init();
} );

function afrikangoods_register_menus() {
	register_nav_menus( array(
		'primary' => __( 'Navigation principale', 'afrikangoods' ),
	) );
}
add_action( 'after_setup_theme', 'afrikangoods_register_menus' );

function afrikangoods_clean_stale_templates() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$stale = get_posts( array(
		'post_type'      => 'wp_template',
		'post_status'    => 'any',
		'posts_per_page' => -1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'wp_theme',
				'field'    => 'name',
				'terms'    => 'kiosko',
			),
		),
		'fields'         => 'ids',
	) );
	if ( ! empty( $stale ) ) {
		foreach ( $stale as $post_id ) {
			wp_delete_post( $post_id, true );
		}
	}
	if ( function_exists( 'wp_clean_theme_json_cache' ) ) {
		wp_clean_theme_json_cache();
	}
	delete_option( 'wp_template_freshness' );
}
add_action( 'init', 'afrikangoods_clean_stale_templates' );

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
// add_filter( 'render_block', 'afrikangoods_limit_categories_render', 10, 2 );

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

// ── Cloudflare Turnstile for Ninja Forms ──
function afrikangoods_enqueue_turnstile() {
	$site_key = defined( 'AFRIKANGOODS_TURNSTILE_SITE_KEY' ) ? AFRIKANGOODS_TURNSTILE_SITE_KEY : '';

	if ( empty( $site_key ) ) {
		$site_key = get_option( 'afrikangoods_turnstile_site_key', '' );
	}

	if ( empty( $site_key ) ) {
		return;
	}

	wp_enqueue_script(
		'cloudflare-turnstile',
		'https://challenges.cloudflare.com/turnstile/v0/api.js',
		array(),
		null,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);
}
add_action( 'wp_enqueue_scripts', 'afrikangoods_enqueue_turnstile' );

function afrikangoods_ninja_forms_turnstile_field( $form_id ) {
	$site_key = defined( 'AFRIKANGOODS_TURNSTILE_SITE_KEY' ) ? AFRIKANGOODS_TURNSTILE_SITE_KEY : '';
	if ( empty( $site_key ) ) {
		$site_key = get_option( 'afrikangoods_turnstile_site_key', '' );
	}
	if ( empty( $site_key ) ) {
		return;
	}
	?>
	<div class="afrikangoods-turnstile-wrapper">
		<div class="cf-turnstile" data-sitekey="<?php echo esc_attr( $site_key ); ?>" data-theme="light"></div>
	</div>
	<?php
}
add_action( 'ninja_forms_display_before_form', 'afrikangoods_ninja_forms_turnstile_field' );

function afrikangoods_turnstile_verify( $form_data ) {
	$secret_key = defined( 'AFRIKANGOODS_TURNSTILE_SECRET_KEY' ) ? AFRIKANGOODS_TURNSTILE_SECRET_KEY : '';
	if ( empty( $secret_key ) ) {
		$secret_key = get_option( 'afrikangoods_turnstile_secret_key', '' );
	}
	if ( empty( $secret_key ) ) {
		return $form_data;
	}

	$token = isset( $_POST['cf-turnstile-response'] ) ? sanitize_text_field( wp_unslash( $_POST['cf-turnstile-response'] ) ) : '';

	if ( empty( $token ) ) {
		$form_data['errors']['form'][] = __( 'Veuillez compléter la vérification de sécurité.', 'afrikangoods' );
		return $form_data;
	}

	$response = wp_remote_post( 'https://challenges.cloudflare.com/turnstile/v0/siteverify', array(
		'body' => array(
			'secret'   => $secret_key,
			'response' => $token,
		),
		'timeout' => 10,
	) );

	if ( is_wp_error( $response ) ) {
		$form_data['errors']['form'][] = __( 'Erreur de vérification. Veuillez réessayer.', 'afrikangoods' );
		return $form_data;
	}

	$body = json_decode( wp_remote_retrieve_body( $response ), true );

	if ( empty( $body['success'] ) ) {
		$form_data['errors']['form'][] = __( 'La vérification de sécurité a échoué. Veuillez réessayer.', 'afrikangoods' );
	}

	return $form_data;
}
add_filter( 'ninja_forms_submit_data', 'afrikangoods_turnstile_verify' );

