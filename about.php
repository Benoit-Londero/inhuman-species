<?php
/**
 * Template Name: A propos
 *
 * @package Inhuman_Species
 */

get_header();

$descr = inhuman_species_field( 'description' );
$photo = inhuman_species_acf_image( inhuman_species_field( 'photo_about' ) );
?>

<div id="content-contact">
    <div class="container columns">
        <div class="col-g">
            <?php if ( $photo['id'] || $photo['url'] ) : ?>
                <div class="block-img from-bottom">
                    <?php inhuman_species_image( $photo['id'], $photo['url'] ); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-d from-bottom">
            <?php echo wp_kses_post( (string) $descr ); ?>
        </div>
    </div>
</div>

<?php
get_footer();
