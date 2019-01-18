<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if (! defined('ABSPATH')) {
    exit;
}
?>

<table class="shop_table woocommerce-checkout-review-order-table shop_table_responsive">
	<tbody>
		<?php
            do_action('woocommerce_review_order_before_cart_contents');

            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
                    ?>
					<tr class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
            <td class="product-thumbnail">
    						<?php
                                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                    echo $thumbnail; // PHPCS: XSS ok.
                            ?>
                <div class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                  <?php echo apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;'; ?>
                  <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                </div>
						</td>
            <td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
              <div class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.?>
              </div>
    						Quantité : <?php echo $cart_item['quantity'] ?>
						</td>
						<td class="product-total">
							<?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
						</td>
					</tr>
					<?php
                }
            }

            do_action('woocommerce_review_order_after_cart_contents');
        ?>
	</tbody>
</table>
