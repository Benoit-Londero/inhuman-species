<?php
/**
 * Enregistrement de la catégorie et des widgets Elementor du thème.
 *
 * @package Inhuman_Species
 */

defined( 'ABSPATH' ) || exit;

add_action( 'elementor/elements/categories_registered', function( $elements_manager ) {
    $elements_manager->add_category(
        'inhuman-species',
        [
            'title' => __( 'Modules Inhuman Species', 'inhuman-species' ),
            'icon'  => 'fa fa-cube',
        ]
    );
} );

add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    $modules = __DIR__ . '/modules/';

    require_once $modules . 'class-before-after-widget.php';
    require_once $modules . 'class-swiper-fullwidth-widget.php';
    require_once $modules . 'class-swiper-projet-widget.php';

    $widgets_manager->register( new \Inhuman_Before_After_Widget() );
    $widgets_manager->register( new \Inhuman_Swiper_Fullscreen_Widget() );
    $widgets_manager->register( new \Inhuman_Swiper_Projet_Widget() );
} );
