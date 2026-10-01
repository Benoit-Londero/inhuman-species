<?php
/**
 * Slider galerie avec lightbox (widget "Slider Projet" et template Simple).
 *
 * @param array $args {
 *     @type array  $images  Liste d'images { id, url }.
 *     @type array  $options Options Swiper (speed, loop, direction, slidesPerView…).
 *     @type string $group   Identifiant de la galerie lightbox.
 *     @type string $size    Taille d'image WordPress des vignettes.
 * }
 *
 * @package Inhuman_Species
 */

defined( 'ABSPATH' ) || exit;

$images  = array_filter( $args['images'] ?? array(), function( $image ) {
    return ! empty( $image['url'] ) || ! empty( $image['id'] );
} );
$options = $args['options'] ?? array();
$group   = $args['group'] ?? 'gallery';
$size    = $args['size'] ?? 'large';

if ( empty( $images ) ) {
    return;
}
?>

<div class="swiper swiper-project" data-swiper-options="<?php echo esc_attr( wp_json_encode( $options ) ); ?>">
    <div class="swiper-wrapper">
        <?php foreach ( $images as $image ) :
            $full = $image['id'] ? wp_get_attachment_image_url( $image['id'], 'full' ) : $image['url'];
            ?>
            <div class="swiper-slide">
                <a data-fslightbox="<?php echo esc_attr( $group ); ?>" href="<?php echo esc_url( $full ?: $image['url'] ); ?>">
                    <div class="block-ig from-bottom">
                        <?php inhuman_species_image( $image['id'], $image['url'], $size ); ?>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
