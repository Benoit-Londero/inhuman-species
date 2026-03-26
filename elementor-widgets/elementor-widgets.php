<?php 

add_action('elementor/elements/categories_registered', function($elements_manager) {
    $elements_manager->add_category(
        'Inhumans Species',
        [
            'title' => 'Modules Inhumans Species',
            'icon'  => 'fa fa-cube',
        ]
    );
});

function register_theme_widgets( $widgets_manager ) {
   
    require_once get_template_directory() . '/elementor-widgets/modules/class-before-after-widget.php';
    require_once get_template_directory() . '/elementor-widgets/modules/class-swiper-fullwidth-widget.php';
    require_once get_template_directory() . '/elementor-widgets/modules/class-swiper-projet-widget.php';

    $widgets_manager->register( new \BA_Theme_Before_After_Widget() );
    $widgets_manager->register( new \Inhuman_Swiper_Fullscreen_Widget() );
    $widgets_manager->register( new \Inhuman_Swiper_Projet_Widget() );
}

add_action( 'elementor/widgets/register', 'register_theme_widgets' );
?>