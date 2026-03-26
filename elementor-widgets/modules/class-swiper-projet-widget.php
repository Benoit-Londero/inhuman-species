<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Inhuman_Swiper_Projet_Widget extends Widget_Base {

    public function get_name() {
        return 'swiper_projet';
    }

    public function get_title() {
        return __( 'Slider Projet', 'ba-theme' );
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

        $this->add_control('img_slider', [
            'label' => __('Galerie', 'textdomain'),
            'type' => Controls_Manager::GALLERY,
        ]);

        $this->end_controls_section();
    }

    public function render(): void {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="swiper swiper-project">
            <div class="swiper-wrapper">';
                <?php if (!empty($settings['list_slider'])) :
                    foreach ($settings['list_slider'] as $slide):
                        $img = $slide['img_slider'];

                        ?>
                        <div class="swiper-slide">
                            <a data-fslightbox href="<?= $img['url'];?>">
                                <div class="block-ig from-bottom">
                                    <img src="<?= $img['url'];?>" alt="<?= $img['name'];?>" />
                                </div>
                            </a>
                        </div>
                    <?php endforeach;
                endif;?>
            </div>
        </div>
    <?php
    }
}