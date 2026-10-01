<?php
/**
 * En-tête du thème.
 *
 * @package Inhuman_Species
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Aller au contenu', 'inhuman-species' ); ?></a>

    <?php get_template_part( 'template-parts/navigation', null, array( 'variant' => 'sidebar' ) ); ?>
    <?php get_template_part( 'template-parts/navigation', null, array( 'variant' => 'megamenu' ) ); ?>

    <main id="content" class="site-main">
