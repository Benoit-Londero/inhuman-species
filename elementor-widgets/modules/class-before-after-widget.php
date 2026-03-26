<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

class BA_Theme_Before_After_Widget extends Widget_Base {

    public function get_name() {
        return 'ba_before_after';
    }

    public function get_title() {
        return __( 'Before / After', 'ba-theme' );
    }

    public function get_icon() {
        return 'eicon-image-before-after';
    }

    public function get_categories() {
        return [ 'Inhumans Species' ]; // Ou ta catégorie custom Elementor
    }

    public function get_style_depends() {
        return [ 'ba-before-after' ];
    }

    public function get_script_depends() {
        return [ 'ba-before-after' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_images',
            [
                'label' => __( 'Images', 'ba-theme' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'before_image',
            [
                'label'   => __( 'Image Before', 'ba-theme' ),
                'type'    => Controls_Manager::MEDIA,
                'dynamic' => [ 'active' => true ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'after_image',
            [
                'label'   => __( 'Image After', 'ba-theme' ),
                'type'    => Controls_Manager::MEDIA,
                'dynamic' => [ 'active' => true ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'initial_position',
            [
                'label'   => __( 'Position initiale (%)', 'ba-theme' ),
                'type'    => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range'   => [
                    '%' => [ 'min' => 0, 'max' => 100 ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $before = $settings['before_image'];
        $after  = $settings['after_image'];
        $initial = ! empty( $settings['initial_position']['size'] ) ? floatval( $settings['initial_position']['size'] ) : 50;

        $initial = max( 0, min( 100, $initial ) );

        $id = 'ba-slider-' . $this->get_id();
        ?>

        <div
            id="<?php echo esc_attr( $id ); ?>"
            class="ba-slider"
            data-initial="<?php echo esc_attr( $initial ); ?>"
        >
            <img
                src="<?php echo esc_url( $before['url'] ); ?>"
                alt="<?php echo esc_attr( $before['alt'] ?? '' ); ?>"
                class="ba-image ba-before"
                loading="lazy"
            />
            <img
                src="<?php echo esc_url( $after['url'] ); ?>"
                alt="<?php echo esc_attr( $after['alt'] ?? '' ); ?>"
                class="ba-image ba-after"
                loading="lazy"
            />
        </div>

        <?php
    }
}
