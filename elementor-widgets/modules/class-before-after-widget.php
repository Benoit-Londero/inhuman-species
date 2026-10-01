<?php
/**
 * Widget Elementor : comparaison avant / après.
 *
 * @package Inhuman_Species
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Inhuman_Before_After_Widget extends Widget_Base {

    public function get_name() {
        return 'ba_before_after';
    }

    public function get_title() {
        return __( 'Before / After', 'inhuman-species' );
    }

    public function get_icon() {
        return 'eicon-image-before-after';
    }

    public function get_categories() {
        return [ 'inhuman-species' ];
    }

    public function get_keywords() {
        return [ 'before', 'after', 'avant', 'après', 'comparaison', 'image' ];
    }

    public function get_script_depends() {
        return [ 'ba-before-after' ];
    }

    protected function is_dynamic_content(): bool {
        return false;
    }

    protected function register_controls() {

        $this->start_controls_section( 'section_images', [
            'label' => __( 'Images', 'inhuman-species' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'before_image', [
            'label'   => __( 'Image avant', 'inhuman-species' ),
            'type'    => Controls_Manager::MEDIA,
            'dynamic' => [ 'active' => true ],
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
        ] );

        $this->add_control( 'after_image', [
            'label'   => __( 'Image après', 'inhuman-species' ),
            'type'    => Controls_Manager::MEDIA,
            'dynamic' => [ 'active' => true ],
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
        ] );

        $this->add_control( 'initial_position', [
            'label'      => __( 'Position initiale (%)', 'inhuman-species' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ '%' ],
            'range'      => [
                '%' => [ 'min' => 0, 'max' => 100 ],
            ],
            'default'    => [
                'unit' => '%',
                'size' => 50,
            ],
        ] );

        $this->add_control( 'reset_on_leave', [
            'label'        => __( 'Revenir à la position initiale', 'inhuman-species' ),
            'description'  => __( 'Quand la souris quitte l’image.', 'inhuman-species' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->add_control( 'show_divider', [
            'label'        => __( 'Ligne de séparation', 'inhuman-species' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => '',
        ] );

        $this->end_controls_section();

        $this->start_controls_section( 'section_style', [
            'label' => __( 'Dimensions', 'inhuman-species' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_responsive_control( 'height', [
            'label'      => __( 'Hauteur', 'inhuman-species' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'vh', 'px' ],
            'range'      => [
                'vh' => [ 'min' => 20, 'max' => 100 ],
                'px' => [ 'min' => 200, 'max' => 1400 ],
            ],
            'default'    => [
                'unit' => 'vh',
                'size' => 100,
            ],
            'selectors'  => [
                '{{WRAPPER}} .ba-slider' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ] );

        $this->add_control( 'divider_color', [
            'label'     => __( 'Couleur de la ligne', 'inhuman-species' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'condition' => [ 'show_divider' => 'yes' ],
            'selectors' => [
                '{{WRAPPER}} .ba-slider' => '--ba-divider-color: {{VALUE}};',
            ],
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $before  = $settings['before_image'] ?? [];
        $after   = $settings['after_image'] ?? [];
        $initial = isset( $settings['initial_position']['size'] ) && '' !== $settings['initial_position']['size']
            ? (float) $settings['initial_position']['size']
            : 50;
        $initial = max( 0, min( 100, $initial ) );

        $classes = [ 'ba-slider' ];

        if ( 'yes' === $settings['show_divider'] ) {
            $classes[] = 'ba-slider--divider';
        }
        ?>

        <div
            id="ba-slider-<?php echo esc_attr( $this->get_id() ); ?>"
            class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
            style="--ba-position: <?php echo esc_attr( $initial ); ?>%;"
            data-initial="<?php echo esc_attr( $initial ); ?>"
            data-reset="<?php echo 'yes' === $settings['reset_on_leave'] ? 'yes' : 'no'; ?>"
            role="slider"
            tabindex="0"
            aria-label="<?php esc_attr_e( 'Comparaison avant / après', 'inhuman-species' ); ?>"
            aria-valuemin="0"
            aria-valuemax="100"
            aria-valuenow="<?php echo esc_attr( round( $initial ) ); ?>"
        >
            <?php
            inhuman_species_image( (int) ( $before['id'] ?? 0 ), $before['url'] ?? '', 'full', [
                'class'   => 'ba-image ba-before',
                'loading' => 'lazy',
            ] );

            inhuman_species_image( (int) ( $after['id'] ?? 0 ), $after['url'] ?? '', 'full', [
                'class'   => 'ba-image ba-after',
                'loading' => 'lazy',
                'style'   => 'clip-path: inset(0 ' . ( 100 - $initial ) . '% 0 0);',
            ] );
            ?>
        </div>

        <?php
    }
}
