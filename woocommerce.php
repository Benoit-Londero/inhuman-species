<?php
/**
 * Gabarit principal WooCommerce (boutique, catégories, fiche produit).
 *
 * Prioritaire sur woocommerce/archive-product.php et woocommerce/single-product.php.
 *
 * @package Inhuman_Species
 */

get_header();
?>

<div id="content-shop">
    <div class="container">
        <?php woocommerce_content(); ?>
    </div>
</div>

<?php
get_footer();
