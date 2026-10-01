<?php
/**
 * Inhuman Species — fonctions du thème.
 *
 * @package Inhuman_Species
 */

defined( 'ABSPATH' ) || exit;

define( 'INHUMAN_SPECIES_VERSION', wp_get_theme( get_template() )->get( 'Version' ) );
define( 'INHUMAN_SPECIES_DIR', get_template_directory() );
define( 'INHUMAN_SPECIES_URI', get_template_directory_uri() );

/**
 * Version d'un asset du thème basée sur sa date de modification (cache-busting à chaque build).
 */
function inhuman_species_asset_version( $relative_path ) {
    $file = INHUMAN_SPECIES_DIR . '/' . ltrim( $relative_path, '/' );

    return file_exists( $file ) ? (string) filemtime( $file ) : INHUMAN_SPECIES_VERSION;
}

require_once INHUMAN_SPECIES_DIR . '/inc/template-tags.php';

// Évite la notice "failed to send buffer of zlib output compression" au shutdown.
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

// ── Theme setup ────────────────────────────────────────────────────────────────
add_action( 'after_setup_theme', function() {
    load_theme_textdomain( 'inhuman-species', INHUMAN_SPECIES_DIR . '/languages' );

    register_nav_menus( array(
        'megamenu'  => __( 'Mega Menu', 'inhuman-species' ),
        'main'      => __( 'Menu Principal', 'inhuman-species' ),
        'footer'    => __( 'Bas de page', 'inhuman-species' ),
        'topheader' => __( 'Top menu', 'inhuman-species' ),
    ) );

    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
    add_theme_support( 'responsive-embeds' );

    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
} );

add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// ── SVG upload support ─────────────────────────────────────────────────────────
// Un SVG peut embarquer du JavaScript : l'upload est réservé aux administrateurs.
add_filter( 'upload_mimes', function( $mimes ) {
    if ( current_user_can( 'manage_options' ) ) {
        $mimes['svg'] = 'image/svg+xml';
    }

    return $mimes;
} );

add_action( 'admin_enqueue_scripts', function() {
    wp_add_inline_style(
        'wp-admin',
        '.attachment-266x266, .thumbnail img { width: 100% !important; height: auto !important; }'
    );
} );

// ── Frontend assets ────────────────────────────────────────────────────────────
add_action( 'wp_enqueue_scripts', function() {
    // Swiper : on réutilise la version fournie par Elementor (handle "swiper", enregistré en priorité 5).
    // Repli CDN de la même version si Elementor est désactivé.
    if ( ! wp_script_is( 'swiper', 'registered' ) ) {
        wp_register_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@8.4.5/swiper-bundle.min.js', array(), '8.4.5', true );
    }

    if ( ! wp_style_is( 'swiper', 'registered' ) ) {
        wp_register_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@8.4.5/swiper-bundle.min.css', array(), '8.4.5' );
    }

    wp_register_script(
        'inhuman-swiper',
        INHUMAN_SPECIES_URI . '/elementor-widgets/js/swiper-init.js',
        array( 'swiper' ),
        inhuman_species_asset_version( 'elementor-widgets/js/swiper-init.js' ),
        true
    );

    wp_register_script(
        'ba-before-after',
        INHUMAN_SPECIES_URI . '/elementor-widgets/js/before-after.js',
        array(),
        inhuman_species_asset_version( 'elementor-widgets/js/before-after.js' ),
        true
    );

    wp_enqueue_style(
        'theme-main',
        INHUMAN_SPECIES_URI . '/dist/main.css',
        array(),
        inhuman_species_asset_version( 'dist/main.css' )
    );

    wp_enqueue_script(
        'theme-main',
        INHUMAN_SPECIES_URI . '/dist/main.js',
        array(),
        inhuman_species_asset_version( 'dist/main.js' ),
        true
    );
}, 20 );

/**
 * Charge Swiper + son initialisation (templates PHP hors Elementor).
 */
function inhuman_species_enqueue_swiper() {
    wp_enqueue_style( 'swiper' );
    wp_enqueue_script( 'inhuman-swiper' );
}

// ── Elementor widgets ──────────────────────────────────────────────────────────
require_once INHUMAN_SPECIES_DIR . '/elementor-widgets/elementor-widgets.php';
