<?php

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

// Menu 
register_nav_menus( array(
    'megamenu' => 'Mega Menu',
	  'main' => 'Menu Principal',
	  'footer' => 'Bas de page',
    'topheader' => 'Top menu'
) );

add_theme_support( 'post-thumbnails' ); 

//SVG Files
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
       return $data;
    }
  
    $filetype = wp_check_filetype( $filename, $mimes );
  
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4 );
  
function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
  
function fix_svg() {
    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}

add_filter( 'upload_mimes', 'cc_mime_types' );
add_action( 'admin_head', 'fix_svg' );

  function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/**
 * Enregistrer les assets et widgets Elementor du thème.
 */
function ba_theme_register_elementor_assets() {

    // JS
    wp_register_script(
        'ba-before-after',
        get_stylesheet_directory_uri() . '/elementor-widgets/js/before-after.js',
        [],
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'ba_theme_register_elementor_assets' );

add_filter('elementor/theme/register_locations', function ($locations) {
    return $locations;
}, 99);

require_once get_template_directory() . '/elementor-widgets/elementor-widgets.php';