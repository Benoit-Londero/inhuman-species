<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override Inhuman Species : mise en page épurée (image, titre, prix, extrait,
 * ajout au panier, onglets) sans notes, méta, partage ni produits liés.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div class="content-product">
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

		<?php woocommerce_show_product_images(); ?>

		<div class="summary entry-summary">
			<?php
			woocommerce_template_single_title();
			woocommerce_template_single_price();
			woocommerce_template_single_excerpt();
			woocommerce_template_single_add_to_cart(); // Formulaire adapté au type de produit (simple, variable…).

			if ( isset( WC()->structured_data ) ) {
				WC()->structured_data->generate_product_data(); // Données structurées produit (SEO).
			}
			?>
		</div>
	</div>

	<div class="product-tabs-related">
		<?php woocommerce_output_product_data_tabs(); ?>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
