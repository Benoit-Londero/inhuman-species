<?php

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
        return 'eicon-image-slider';
    }

    public function get_categories() {
        return [ 'inhuman-species' ];
    }

    protected function register_controls() {
        $this->start_controls_section( 'content_section', [
            'label' => __( 'Contenu', 'inhuman-species' ),
        ] );

        $repeater = new Repeater();

        $repeater->add_control( 'img_slider', [
            'label' => __( 'Arrière-plan', 'inhuman-species' ),
            'type'  => Controls_Manager::MEDIA,
        ] );

        $repeater->add_control( 'description', [
            'label' => __( 'Texte', 'inhuman-species' ),
            'type'  => Controls_Manager::WYSIWYG,
        ] );

        $repeater->add_control( 'cta', [
            'label' => __( 'CTA', 'inhuman-species' ),
            'type'  => Controls_Manager::URL,
        ] );

        $repeater->add_control( 'libelle_cta', [
            'label' => __( 'Libellé CTA', 'inhuman-species' ),
            'type'  => Controls_Manager::TEXT,
        ] );

        $this->add_control( 'list_slider', [
            'label'   => __( 'Slider', 'inhuman-species' ),
            'type'    => Controls_Manager::REPEATER,
            'fields'  => $repeater->get_controls(),
            'default' => [],
        ] );

        $this->end_controls_section();
    }

    public function render(): void {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="portfolio">
            <div class="swiper">
                <div class="swiper-portfolio">
                    <div class="swiper-wrapper">
                        <?php if ( ! empty( $settings['list_slider'] ) ) : ?>
                            <?php foreach ( $settings['list_slider'] as $slide ) :
                                $img        = $slide['img_slider'];
                                $desc       = $slide['description'] ?? '';
                                $cta        = $slide['cta'];
                                $cta_label  = $slide['libelle_cta'] ?? '';

                                if ( $img ) : ?>
                                    <div class="swiper-slide">
                                        <div class="description from-left" data-swiper-parallax="-300" data-swiper-parallax-duration="300" style="z-index:1000;">
                                            <?php echo wp_kses_post( $desc ); ?>
                                            <?php if ( $cta && ! empty( $cta['url'] ) ) : ?>
                                                <a href="<?php echo esc_url( $cta['url'] ); ?>" class="cta from-left">
                                                    <?php echo esc_html( $cta_label ); ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>

                                        <div class="block-img" data-swiper-parallax="0">
                                            <img
                                                src="<?php echo esc_url( $img['url'] ); ?>"
                                                alt="<?php echo esc_attr( $img['alt'] ?? $img['name'] ?? '' ); ?>"
                                                class="slide"
                                            />
                                        </div>
                                    </div>
                                <?php endif;
                            endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
        <?php
    }
}
