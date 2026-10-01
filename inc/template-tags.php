<?php
/**
 * Helpers de templates.
 *
 * @package Inhuman_Species
 */

defined( 'ABSPATH' ) || exit;

/**
 * get_field() sans fatal error si ACF est désactivé.
 */
function inhuman_species_field( $selector, $post_id = false ) {
    return function_exists( 'get_field' ) ? get_field( $selector, $post_id ) : null;
}

/**
 * Affiche une image de la médiathèque (srcset, dimensions, lazy-loading natif),
 * avec repli sur une simple balise <img> si seule l'URL est connue.
 *
 * @param int    $id    ID de l'attachment (0 si inconnu).
 * @param string $url   URL de repli.
 * @param string $size  Taille d'image WordPress.
 * @param array  $attr  Attributs HTML supplémentaires (class, loading, alt…).
 */
function inhuman_species_image( $id, $url, $size = 'large', $attr = array() ) {
    if ( $id && wp_attachment_is_image( $id ) ) {
        echo wp_get_attachment_image( $id, $size, false, $attr );
        return;
    }

    if ( ! $url ) {
        return;
    }

    $attr = wp_parse_args( $attr, array( 'alt' => '', 'loading' => 'lazy' ) );
    $html = '';

    foreach ( $attr as $name => $value ) {
        $html .= sprintf( ' %s="%s"', esc_attr( $name ), esc_attr( $value ) );
    }

    printf( '<img src="%s"%s />', esc_url( $url ), $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- attributs échappés ci-dessus.
}

/**
 * Convertit un tableau d'image ACF (ou un ID) au format { id, url } utilisé par les sliders.
 */
function inhuman_species_acf_image( $image ) {
    if ( is_numeric( $image ) ) {
        return array( 'id' => (int) $image, 'url' => (string) wp_get_attachment_url( (int) $image ) );
    }

    if ( is_array( $image ) ) {
        return array( 'id' => (int) ( $image['ID'] ?? $image['id'] ?? 0 ), 'url' => (string) ( $image['url'] ?? '' ) );
    }

    return array( 'id' => 0, 'url' => (string) $image );
}
