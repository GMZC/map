<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Les_Autres_Possibles
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function map_woocommerce_setup()
{
    add_theme_support('woocommerce');
    // add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'map_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function map_woocommerce_scripts()
{
    wp_enqueue_style('map-woocommerce-style', get_template_directory_uri() . '/woocommerce.css');

    $font_path   = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

    wp_add_inline_style('map-woocommerce-style', $inline_font);
}
add_action('wp_enqueue_scripts', 'map_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function map_woocommerce_active_body_class($classes)
{
    $classes[] = 'woocommerce-active';

    return $classes;
}
add_filter('body_class', 'map_woocommerce_active_body_class');

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function map_woocommerce_products_per_page()
{
    return 12;
}
add_filter('loop_shop_per_page', 'map_woocommerce_products_per_page');

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function map_woocommerce_thumbnail_columns()
{
    return 4;
}
add_filter('woocommerce_product_thumbnails_columns', 'map_woocommerce_thumbnail_columns');

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function map_woocommerce_loop_columns()
{
    return 3;
}
add_filter('loop_shop_columns', 'map_woocommerce_loop_columns');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function map_woocommerce_related_products_args($args)
{
    $defaults = array(
                'posts_per_page' => 3,
                'columns'        => 3,
        );

    $args = wp_parse_args($defaults, $args);

    return $args;
}
add_filter('woocommerce_output_related_products_args', 'map_woocommerce_related_products_args');

if (! function_exists('map_woocommerce_product_columns_wrapper')) {
    /**
     * Product columns wrapper.
     *
     * @return  void
     */
    function map_woocommerce_product_columns_wrapper()
    {
        $columns = map_woocommerce_loop_columns();
        echo '<div class="columns-' . absint($columns) . '">';
    }
}
add_action('woocommerce_before_shop_loop', 'map_woocommerce_product_columns_wrapper', 40);

if (! function_exists('map_woocommerce_product_columns_wrapper_close')) {
    /**
     * Product columns wrapper close.
     *
     * @return  void
     */
    function map_woocommerce_product_columns_wrapper_close()
    {
        echo '</div>';
    }
}
add_action('woocommerce_after_shop_loop', 'map_woocommerce_product_columns_wrapper_close', 40);

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (! function_exists('map_woocommerce_wrapper_before')) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function map_woocommerce_wrapper_before()
    {
        ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
    }
}
add_action('woocommerce_before_main_content', 'map_woocommerce_wrapper_before');

if (! function_exists('map_woocommerce_wrapper_after')) {
    /**
     * After Content.
     *
     * Closes the wrapping divs.
     *
     * @return void
     */
    function map_woocommerce_wrapper_after()
    {
        ?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
    }
}
add_action('woocommerce_after_main_content', 'map_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
*	<?php
*		if ( function_exists( 'map_woocommerce_header_cart' ) ) {
*			map_woocommerce_header_cart();
*		}
*	?>
 */

if (! function_exists('map_woocommerce_cart_link_fragment')) {
    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    function map_woocommerce_cart_link_fragment($fragments)
    {
        ob_start();
        map_woocommerce_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'map_woocommerce_cart_link_fragment');

if (! function_exists('map_woocommerce_cart_link')) {
    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * echo wp_kses_data(WC()->cart->get_cart_subtotal());
     *
     *
     * @return void
     */
    function map_woocommerce_cart_link()
    {
        ?>
		<a class="cart-contents" href="#" title="<?php esc_attr_e('View your shopping cart', 'map'); ?>">
			<?php
                        $item_count_text = sprintf(
                                /* translators: number of items in the mini cart. */
                                // _n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'map'),
                                WC()->cart->get_cart_contents_count()
                        ); ?>
      <svg class="icon">
        <use xlink:href="#panier"></use>
      </svg>
      <span class="count"><?php echo esc_html($item_count_text); ?></span>
		</a>
		<?php
    }
}

if (! function_exists('map_woocommerce_header_cart')) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function map_woocommerce_header_cart()
    {
        if (is_cart()) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        } ?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr($class); ?>">
				<?php map_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
                                $instance = array(
                                        'title' => '',
                                );

        the_widget('WC_Widget_Cart', $instance); ?>
			</li>
		</ul>
		<?php
    }
}



function variation_radio_buttons($html, $args)
{
    $args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), array(
        'options'          => false,
        'attribute'        => false,
        'product'          => false,
        'selected'         => false,
        'name'             => '',
        'id'               => '',
        'class'            => '',
        'show_option_none' => __('Choose an option', 'woocommerce'),
 ));

    if (false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product) {
        $selected_key     = 'attribute_'.sanitize_title($args['attribute']);
        $args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key])) : $args['product']->get_variation_default_attribute($args['attribute']);
    }

    $options               = $args['options'];
    $product               = $args['product'];
    $attribute             = $args['attribute'];
    $name                  = $args['name'] ? $args['name'] : 'attribute_'.sanitize_title($attribute);
    $id                    = $args['id'] ? $args['id'] : sanitize_title($attribute);
    $class                 = $args['class'];
    $show_option_none      = (bool)$args['show_option_none'];
    $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce');

    if (empty($options) && !empty($product) && !empty($attribute)) {
        $attributes = $product->get_variation_attributes();
        $options    = $attributes[$attribute];
    }

    $radios = '<div class="variation-radios">';
    if (!empty($options)) {
        if ($product && taxonomy_exists($attribute)) {
            $terms = wc_get_product_terms($product->get_id(), $attribute, array('fields' => 'all'));

            foreach ($terms as $term) {
                if (in_array($term->slug, $options, true)) {
                    $radios .= '<label for="'.esc_attr($term->slug).'"'.checked(sanitize_title($args['selected']), $term->slug, false).'><input type="radio" name="'.esc_attr($name).'" value="'.esc_attr($term->slug).'" id="'.esc_attr($term->slug).'" '.checked(sanitize_title($args['selected']), $term->slug, false).'>'.esc_html(apply_filters('woocommerce_variation_option_name', $term->name)).'</label>';
                }
            }
        } else {
            foreach ($options as $option) {
                $checked    = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'], sanitize_title($option), false) : checked($args['selected'], $option, false);
                $radios    .= '<label for="'.sanitize_title($option).'"'.$checked.'><input type="radio" name="'.esc_attr($name).'" value="'.esc_attr($option).'"'.$checked.'>'.esc_html(apply_filters('woocommerce_variation_option_name', $option)).'</label>';
            }
        }
    }

    $radios .= '</div>';

    return $html.$radios;
}
add_filter('woocommerce_dropdown_variation_attribute_options_html', 'variation_radio_buttons', 20, 2);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


add_filter('woocommerce_account_menu_items', 'misha_remove_my_account_links');
function misha_remove_my_account_links($menu_links)
{
    unset($menu_links['downloads']); // Addresses


    //unset( $menu_links['dashboard'] ); // Dashboard
    //unset( $menu_links['payment-methods'] ); // Payment Methods
    //unset( $menu_links['orders'] ); // Orders
    //unset( $menu_links['downloads'] ); // Downloads
    //unset( $menu_links['edit-account'] ); // Account details
    //unset( $menu_links['customer-logout'] ); // Logout

    return $menu_links;
}


remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10);
remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20);

function my_woocommerce_widget_shopping_cart_view_cart()
{
    echo '<a href="' . esc_url(wc_get_cart_url()) . '" class="wc-forward btn med" target="_blank"><span class="x-anchor-content" style="-webkit-justify-content: center; justify-content: center; -webkit-align-items: center; align-items: center;"><span class="x-anchor-text"><span class="x-anchor-text-primary">Commander</span></a>';
}
add_action('woocommerce_widget_shopping_cart_buttons', 'my_woocommerce_widget_shopping_cart_view_cart', 10);

/**
 * @snippet       Automatically Update Cart on Quantity Change - WooCommerce
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=73470
 * @author        Rodolfo Melogli
 * @compatible    Woo 3.5.1
 */

add_action('wp_footer', 'bbloomer_cart_refresh_update_qty');

function bbloomer_cart_refresh_update_qty()
{
    if (is_cart()) {
        ?>
        <script type="text/javascript">
            jQuery('div.woocommerce').on('click', 'input.qty', function(){
                jQuery("[name='update_cart']").trigger("click");
            });
        </script>
        <?php
    }
}

remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
add_action('woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20);
add_filter('woocommerce_create_account_default_checked', '__return_true');

// add_action('woocommerce_before_cart', 'checkout_walkthrough', 10);
function checkout_walkthrough()
{
    echo '<h2> Première étape </h2>';
}

// Hook in
add_filter('woocommerce_checkout_fields', 'custom_override_account_fields');

// Our hooked in function - $fields is passed via the filter!
function custom_override_account_fields($fields)
{
    $fields['account']['billing_email'] = $fields['billing']['billing_email'];
    unset($fields['billing']['billing_email']);
    unset($fields['account']['account_password_1']);

    return $fields;
}

add_action('woocommerce_before_checkout_registration_form', 'XYZ_checkout_custom_heading');

function XYZ_checkout_custom_heading()
{
    echo '<div id="add_custom_heading"><h3>2. Création de votre compte</h3></div>';
}

add_filter('woocommerce_billing_fields', 'remove_phone_form_fields');
function remove_phone_form_fields($fields)
{
    unset($fields ['billing_phone']);
    unset($fields ['billing_company']);
    return $fields;
}

// add_action('after_setup_theme', 'bbloomer_remove_zoom_lightbox_theme_support', 99);
// function bbloomer_remove_zoom_lightbox_theme_support()
// {
//     remove_theme_support('wc-product-gallery-zoom');
// }
