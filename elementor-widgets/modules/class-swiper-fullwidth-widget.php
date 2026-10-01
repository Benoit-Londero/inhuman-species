<?php
/**
 * Widget Elementor : slider plein écran (image + texte + CTA).
 *
 * @package Inhuman_Species
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Inhuman_Swiper_Fullscreen_Widget extends Widget_Base {

    public function get_name() {
        return 'swiper_fullscreen';
    }

    public function get_title() {
        return __( 'Swiper Fullscreen', 'inhuman-species' );
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return [ 'inhuman-species' ];
    }

    public function get_keywords() {
        return [ 'slider', 'swiper', 'portfolio', 'fullscreen', 'carousel' ];
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

        $repeater = new Repeater();

        $repeater->add_control( 'img_slider', [
            'label'   => __( 'Arrière-plan', 'inhuman-species' ),
            'type'    => Controls_Manager::MEDIA,
            'dynamic' => [ 'active' => true ],
        ] );

        $repeater->add_control( 'description', [
            'label' => __( 'Texte', 'inhuman-species' ),
            'type'  => Controls_Manager::WYSIWYG,
        ] );

        $repeater->add_control( 'cta', [
            'label'   => __( 'CTA', 'inhuman-species' ),
            'type'    => Controls_Manager::URL,
            'dynamic' => [ 'active' => true ],
        ] );

        $repeater->add_control( 'libelle_cta', [
            'label'   => __( 'Libellé CTA', 'inhuman-species' ),
            'type'    => Controls_Manager::TEXT,
            'dynamic' => [ 'active' => true ],
        ] );

        $this->add_control( 'list_slider', [
            'label'       => __( 'Slides', 'inhuman-species' ),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [],
            'title_field' => '{{{ libelle_cta || "' . esc_js( __( 'Slide', 'inhuman-species' ) ) . '" }}}',
        ] );

        $this->end_controls_section();

        $this->start_controls_section( 'options_section', [
            'label' => __( 'Options du slider', 'inhuman-species' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
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
            'default'   => 5000,
            'condition' => [ 'autoplay' => 'yes' ],
        ] );

        $this->add_control( 'speed', [
            'label'   => __( 'Vitesse de transition (ms)', 'inhuman-species' ),
            'type'    => Controls_Manager::NUMBER,
            'min'     => 100,
            'step'    => 100,
            'default' => 800,
        ] );

        $this->add_control( 'navigation', [
            'label'        => __( 'Flèches de navigation', 'inhuman-species' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->add_control( 'pagination', [
            'label'        => __( 'Pagination', 'inhuman-species' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $slides   = [];

        foreach ( (array) $settings['list_slider'] as $slide ) {
            $image = $slide['img_slider'] ?? [];

            if ( empty( $image['url'] ) && empty( $image['id'] ) ) {
                continue;
            }

            $cta = $slide['cta'] ?? [];

            $slides[] = [
                'image'       => [
                    'id'  => (int) ( $image['id'] ?? 0 ),
                    'url' => $image['url'] ?? '',
                ],
                'description' => $slide['description'] ?? '',
                'cta'         => [
                    'url'         => $cta['url'] ?? '',
                    'label'       => $slide['libelle_cta'] ?? '',
                    'is_external' => ! empty( $cta['is_external'] ),
                    'nofollow'    => ! empty( $cta['nofollow'] ),
                ],
            ];
        }

        get_template_part( 'template-parts/slider-fullscreen', null, [
            'slides'  => $slides,
            'options' => [
                'loop'       => 'yes' === $settings['loop'],
                'speed'      => max( 100, (int) $settings['speed'] ),
                'autoplay'   => 'yes' === $settings['autoplay'] ? max( 1000, (int) $settings['autoplay_delay'] ) : 0,
                'navigation' => 'yes' === $settings['navigation'],
                'pagination' => 'yes' === $settings['pagination'],
            ],
        ] );
    }
}
