<?php
/**
 * Navigation principale (logo + menu + réseaux sociaux).
 *
 * Deux variantes partagent ce gabarit :
 * - "sidebar"  : colonne fixe sur desktop ;
 * - "megamenu" : panneau plein écran ouvert par le bouton burger (tablette / mobile).
 *
 * @package Inhuman_Species
 */

defined( 'ABSPATH' ) || exit;

$variant     = ( isset( $args['variant'] ) && 'megamenu' === $args['variant'] ) ? 'megamenu' : 'sidebar';
$is_megamenu = 'megamenu' === $variant;
$logo        = inhuman_species_field( 'logo', 'options' );
?>

<?php if ( $is_megamenu ) : ?>
    <button type="button" class="menu-toggle" aria-controls="megamenu" aria-expanded="false">
        <span class="menu-toggle__bar" aria-hidden="true"></span>
        <span class="screen-reader-text"><?php esc_html_e( 'Ouvrir le menu', 'inhuman-species' ); ?></span>
    </button>
<?php endif; ?>

<div
    class="menu-<?php echo esc_attr( $variant ); ?> site-navigation"
    <?php if ( $is_megamenu ) : ?>id="megamenu" aria-hidden="true"<?php endif; ?>
>
    <div class="logo">
        <?php if ( ! empty( $logo['url'] ) ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <img
                    src="<?php echo esc_url( $logo['url'] ); ?>"
                    alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                />
            </a>
        <?php endif; ?>

        <?php if ( $is_megamenu ) : ?>
            <button type="button" class="menu-close" aria-controls="megamenu">
                <span aria-hidden="true">&times;</span>
                <span class="screen-reader-text"><?php esc_html_e( 'Fermer le menu', 'inhuman-species' ); ?></span>
            </button>
        <?php endif; ?>
    </div>

    <?php
    wp_nav_menu( array(
        'theme_location'       => 'main',
        'menu'                 => 'Menu Principal',
        'container'            => 'nav',
        'container_class'      => 'nav-container',
        'container_aria_label' => __( 'Navigation principale', 'inhuman-species' ),
        'menu_class'           => 'nav-menu',
        'menu_id'              => 'menu-' . $variant,
        'fallback_cb'          => false,
    ) );
    ?>

    <?php if ( function_exists( 'have_rows' ) && have_rows( 'reseaux_sociaux', 'options' ) ) : ?>
        <div class="social_network">
            <?php while ( have_rows( 'reseaux_sociaux', 'options' ) ) : the_row();
                $icon = get_sub_field( 'icone' );
                $lien = get_sub_field( 'lien' );

                if ( ! $lien || empty( $icon['url'] ) ) {
                    continue;
                }

                $label = ! empty( $icon['alt'] ) ? $icon['alt'] : ( $icon['title'] ?? '' );
                ?>
                <a href="<?php echo esc_url( $lien ); ?>" target="_blank" rel="noopener noreferrer">
                    <img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $label ); ?>" />
                </a>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>
