<?php
/* Template Name: Page d'accueil */

get_header();

$background   = get_field( 'background' );
$background_2 = get_field( 'background_2' );
?>

<div id="main-content">
    <?php if ( $background ) : ?>
        <img
            src="<?php echo esc_url( $background['url'] ); ?>"
            alt="<?php echo esc_attr( $background['alt'] ?? $background['name'] ?? '' ); ?>"
            class="image-before"
        />
    <?php endif; ?>

    <?php if ( $background_2 ) : ?>
        <img
            src="<?php echo esc_url( $background_2['url'] ); ?>"
            alt="<?php echo esc_attr( $background_2['alt'] ?? $background_2['name'] ?? '' ); ?>"
            class="image-after"
        />
    <?php endif; ?>
</div>

<?php get_footer(); ?>
