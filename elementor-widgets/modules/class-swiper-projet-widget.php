<?php
/**
 * Widget Elementor : galerie projet en slider avec lightbox.
 *
 * @package Inhuman_Species
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Inhuman_Swiper_Projet_Widget extends Widget_Base {

    public function get_name() {
        return 'swiper_projet';
    }

    public function get_title() {
        return __( 'Slider Projet', 'inhuman-species' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'inhuman-species' ];
    }

    public function get_keywords() {
        return [ 'slider', 'swiper', 'galerie', 'gallery', 'lightbox', 'projet' ];
    }

    public function get_script_depends() {
        return [ 'inhuman-swiper' ];
    }

    public function get_style_depends() {
        return [ 'swiper' ];
    }

    protected function is_dynamic_content(): bool {
        return false;
    }

    protected function register_controls() {
        $this->start_controls_section( 'content_section', [
            'label' => __( 'Contenu', 'inhuman-species' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'img_slider', [
            'label'   => __( 'Galerie', 'inhuman-species' ),
            'type'    => Controls_Manager::GALLERY,
            'dynamic' => [ 'active' => true ],
        ] );

        $this->add_control( 'image_size', [
            'label'   => __( 'Taille des images', 'inhuman-species' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'large',
            'options' => [
                'medium_large' => __( 'Moyenne', 'inhuman-species' ),
                'large'        => __( 'Grande', 'inhuman-species' ),
                'full'         => __( 'Originale', 'inhuman-species' ),
            ],
        ] );

        $this->end_controls_section();

        $this->start_controls_section( 'options_section', [
            'label' => __( 'Options du slider', 'inhuman-species' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'direction', [
            'label'   => __( 'Direction', 'inhuman-species' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'vertical',
            'options' => [
                'vertical'   => __( 'Verticale', 'inhuman-species' ),
                'horizontal' => __( 'Horizontale', 'inhuman-species' ),
            ],
        ] );

        $this->add_control( 'slides_per_view', [
            'label'   => __( 'Images visibles', 'inhuman-species' ),
            'type'    => Controls_Manager::NUMBER,
            'min'     => 1,
            'max'     => 8,
            'step'    => 0.5,
            'default' => 3.5,
        ] );

        $this->add_control( 'loop', [
            'label'        => __( 'Boucle infinie', 'inhuman-species' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->add_control( 'autoplay', [
            'label'        => __( 'Lecture automatique', 'inhuman-species' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => '',
        ] );

        $this->add_control( 'autoplay_delay', [
            'label'     => __( 'Délai entre les slides (ms)', 'inhuman-species' ),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 1000,
            'step'      => 500,
            'default'   => 4000,
            'condition' => [ 'autoplay' => 'yes' ],
        ] );

        $this->add_control( 'speed', [
            'label'   => __( 'Vitesse de transition (ms)', 'inhuman-species' ),
            'type'    => Controls_Manager::NUMBER,
            'min'     => 100,
            'step'    => 100,
            'default' => 800,
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $images   = [];

        foreach ( (array) $settings['img_slider'] as $image ) {
            $images[] = [
                'id'  => (int) ( $image['id'] ?? 0 ),
                'url' => $image['url'] ?? '',
            ];
        }

        get_template_part( 'template-parts/slider-gallery', null, [
            'images'  => $images,
            'group'   => 'gallery-' . $this->get_id(),
            'size'    => $settings['image_size'] ?: 'large',
            'options' => [
                'direction'     => 'horizontal' === $settings['direction'] ? 'horizontal' : 'vertical',
                'slidesPerView' => max( 1, (float) $settings['slides_per_view'] ),
                'loop'          => 'yes' === $settings['loop'],
                'speed'         => max( 100, (int) $settings['speed'] ),
                'autoplay'      => 'yes' === $settings['autoplay'] ? max( 1000, (int) $settings['autoplay_delay'] ) : 0,
            ],
        ] );
    }
}
