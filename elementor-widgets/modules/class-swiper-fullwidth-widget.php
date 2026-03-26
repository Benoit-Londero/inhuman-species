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
        return __( 'Swiper Fullscreen', 'ba-theme' );
    }

    public function get_icon() {
        return 'eicon-image-slider';
    }

    public function get_categories() {
        return [ 'Inhumans Species' ]; // Ou ta catégorie custom Elementor
    }

    public function _register_controls() {
        $this->start_controls_section('content_section', [
            'label' => __('Contenu', 'textdomain'),
        ]);

        

        $repeater = new Repeater();

        $repeater->add_control('img_slider', [
            'label' => __('Arrière-plan', 'textdomain'),
            'type' => Controls_Manager::MEDIA,
        ]);

        $repeater->add_control('description', [
            'label' => __('Texte', 'textdomain'),
            'type' => Controls_Manager::WYSIWYG,
        ]);

        $repeater->add_control('cta', [
            'label' => __('CTA', 'textdomain'),
            'type' => Controls_Manager::URL,
        ]);

        $repeater->add_control('libelle_cta', [
            'label' => __('Libellé CTA', 'textdomain'),
            'type' => Controls_Manager::TEXT,
        ]);

        $this->add_control('list_slider', [
            'label' => __('Slider', 'textdomain'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [],
        ]);

        $this->end_controls_section();
    }

    public function render(): void {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="portfolio">
            <div class="swiper">
                <div class="swiper-portfolio">
                    <div class="swiper-wrapper">
                        <?php
                        
                        if (!empty($settings['list_slider'])) : ?>
                            <?php foreach ($settings['list_slider'] as $slide):
                                $img = $slide['img_slider'];
                                $desc = $slide['description'] ?? '';
                                $cta = $slide['cta'];
                                $ctaLibelle = $slide['libelle_cta'] ?? '';

                                if($img):?>
                                    <div class="swiper-slide">
                                        <div class="description from-left" data-swiper-parallax="-300" data-swiper-parallax-duration="300" style="z-index:1000;">
                                            <?= $desc;?>
                                            <?php if($cta): echo '<a href="'.$cta['url'].'" class="cta from-left">'.$ctaLibelle.'</a>'; endif;?>
                                        </div>

                                        <div class="block-img" data-swiper-parallax="0">
                                            <img src="<?= $img['url'];?>" alt="<?php echo $img['name'];?>" class="slide"/>
                                        </div>
                                    </div>
                                <?php endif;
                             endforeach;
                        endif;?>
                    </div>

                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
        <?php
    }
}