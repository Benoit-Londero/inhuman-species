<?php

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

// ── Theme setup ────────────────────────────────────────────────────────────────
add_action( 'after_setup_theme', function() {
    load_theme_textdomain( 'inhuman-species', get_template_directory() . '/languages' );

    register_nav_menus( array(
        'megamenu'  => __( 'Mega Menu', 'inhuman-species' ),
        'main'      => __( 'Menu Principal', 'inhuman-species' ),
        'footer'    => __( 'Bas de page', 'inhuman-species' ),
        'topheader' => __( 'Top menu', 'inhuman-species' ),
    ) );

    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );

    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
} );

add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// ── SVG upload support ─────────────────────────────────────────────────────────
add_filter( 'upload_mimes', function( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
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
    wp_enqueue_style(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        [],
        '11'
    );

    wp_enqueue_script(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        [],
        '11',
        true
    );

    wp_enqueue_script(
        'theme-main',
        get_template_directory_uri() . '/dist/main.js',
        [ 'jquery', 'swiper' ],
        '1.0.0',
        true
    );

    wp_register_script(
        'ba-before-after',
        get_template_directory_uri() . '/elementor-widgets/js/before-after.js',
        [],
        '1.0.0',
        true
    );
} );

// ── Elementor widgets ──────────────────────────────────────────────────────────
require_once get_template_directory() . '/elementor-widgets/elementor-widgets.php';
