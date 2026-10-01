<?php
/**
 * Template Name: Simple
 *
 * @package Inhuman_Species
 */

$descr      = inhuman_species_field( 'description' );
$photo      = inhuman_species_field( 'photo_about' );
$is_gallery = (bool) inhuman_species_field( 'isGalerie' );
$gallery    = $is_gallery ? (array) inhuman_species_field( 'galerie' ) : array();

if ( $gallery ) {
    inhuman_species_enqueue_swiper();
}

get_header();
?>

<div id="content-contact">
    <div class="container columns">
        <div class="col-g">
            <?php echo wp_kses_post( (string) $descr ); ?>
        </div>

        <div class="col-d from-bottom">
            <?php if ( $gallery ) :
                get_template_part( 'template-parts/slider-gallery', null, array(
                    'images'  => array_map( 'inhuman_species_acf_image', $gallery ),
                    'group'   => 'gallery-' . get_the_ID(),
                    'options' => array(
                        'speed'         => 800,
                        'loop'          => true,
                        'direction'     => 'vertical',
                        'slidesPerView' => 3.5,
                    ),
                ) );
            elseif ( $photo ) :
                $photo = inhuman_species_acf_image( $photo ); ?>
                <div class="block-img from-bottom">
                    <?php inhuman_species_image( $photo['id'], $photo['url'] ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
get_footer();
