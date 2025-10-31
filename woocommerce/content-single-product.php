<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

use Automattic\WooCommerce\Enums\ProductType;

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

		<?php include 'single-product/product-image.php';?>
		<div class="summary entry-summary">
			<?php 
				include 'single-product/title.php';
				include 'single-product/price.php';
				include 'single-product/short-description.php';
				include 'single-product/add-to-cart/simple.php'
			?>
		</div>
	</div>

	<div class="product-tabs-related">
		<?php include 'single-product/tabs/tabs.php';?>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
