<?php
/**
 * Page 404.
 *
 * @package Inhuman_Species
 */

get_header();
?>

<div id="content-contact">
    <div class="container">
        <h1 class="from-left"><?php esc_html_e( 'Page introuvable', 'inhuman-species' ); ?></h1>
        <a class="cta from-left" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php esc_html_e( "Retour à l'accueil", 'inhuman-species' ); ?>
        </a>
    </div>
</div>

<?php
get_footer();
