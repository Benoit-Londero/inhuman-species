<?php
/**
 * Template Name: Portfolio
 *
 * @package Inhuman_Species
 */

inhuman_species_enqueue_swiper();

$background = inhuman_species_field( 'background-slider' );
$slides     = array();

if ( function_exists( 'have_rows' ) && have_rows( 'work' ) ) {
    while ( have_rows( 'work' ) ) {
        the_row();

        $image = inhuman_species_acf_image( get_sub_field( 'image' ) );
        $cta   = get_sub_field( 'cta' );

        if ( ! $image['id'] && ! $image['url'] ) {
            continue;
        }

        $slides[] = array(
            'image'       => $image,
            'description' => get_sub_field( 'description' ),
            'cta'         => array(
                'url'         => $cta['url'] ?? '',
                'label'       => $cta['title'] ?? '',
                'is_external' => '_blank' === ( $cta['target'] ?? '' ),
            ),
        );
    }
}

get_header();

get_template_part( 'template-parts/slider-fullscreen', null, array(
    'slides'     => $slides,
    'background' => $background['url'] ?? '',
    'options'    => array(
        'speed' => 800,
        'loop'  => true,
    ),
) );

get_footer();
