<?php
/**
 * Template Name: Contact
 *
 * @package Inhuman_Species
 */

get_header();

$form = inhuman_species_field( 'formulaire', 'options' );
?>

<div id="content-contact">
    <div class="container">
        <h1 class="from-left"><?php the_title(); ?></h1>

        <?php if ( $form ) : ?>
            <div class="contact-form from-left"><?php echo do_shortcode( wp_kses_post( $form ) ); ?></div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
