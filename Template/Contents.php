<?php
defined('ABSPATH') || exit;

isset($data) || exit;
$cart = WC()->cart;
$applied_coupons = $cart->get_applied_coupons();
?>

<div class="mcw-header" style="height: 8vh; <?php echo esc_attr($data['style']['header']); ?>">
    <?php if (!empty($data['show_icon_in_header'])) { ?>
        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="currentColor" >
            <path d="M200-80q-33 0-56.5-23.5T120-160v-480q0-33 23.5-56.5T200-720h80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720h80q33 0 56.5 23.5T840-640v480q0 33-23.5 56.5T760-80H200Zm0-80h560v-480H200v480Zm280-240q83 0 141.5-58.5T680-600h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85h-80q0 83 58.5 141.5T480-400ZM360-720h240q0-50-35-85t-85-35q-50 0-85 35t-35 85ZM200-160v-480 480Z"/>
        </svg>
    <?php } ?>
    <h2 style="color: currentColor; font-size: inherit;"><?php esc_html_e($data['header_title'], 'mini-cart-woocommerce'); ?></h2>
    <span id="mcw-close-cart" class="mcw-action" style="position: absolute; right: 10px; top: 0;">
        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 32 32" fill="currentColor">
            <line stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" x1="7" x2="25" y1="7" y2="25"/>
            <line stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" x1="7" x2="25" y1="25" y2="7"/>
        </svg>
    </span>
</div>

<div class="mcw-products" style="<?php echo esc_attr($data['style']['body']); ?>">
    <?php if (!$cart->is_empty()) { ?>
        <?php foreach ($cart->get_cart() as $cart_item_key => $cart_item) :
            $product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $product_name = apply_filters('woocommerce_cart_item_name', $product->get_name(), $cart_item, $cart_item_key);
            $product_thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $product->get_image(), $cart_item, $cart_item_key);
            $product_price = apply_filters('woocommerce_get_price', function_exists('wc_price') ? wc_price($product->get_price()) : '', $cart_item);
            $product_subtotal = apply_filters('woocommerce_cart_item_subtotal', function_exists('wc_price') ? wc_price($cart_item['line_subtotal']) : '', $cart_item, $cart_item_key);
            ?>

            <div class="mcw-product" style="color: currentColor;"
                 data-cart_item_key="<?php echo esc_attr($cart_item_key); ?>">

                <div class="mcw-product-image" style="width: 64px;">
                    <?php echo $product_thumbnail; ?>
                </div>
                <div style="display: flex; flex-direction: column; width: 75%; gap: 6px;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; flex-direction: column; justify-content: center; align-items: start; gap: 4px;">
                            <div class="mcw-product-title" style="color: currentColor; font-size: inherit">
                                <?php echo $product_name; ?>
                            </div>
                            <div class="mcw-product-price" style="color: currentColor;">
                                <?php echo $product_price; ?>
                            </div>
                        </div>
                        <?php if (!empty($data['show_remove_item_option'])) { ?>
                            <div class="mcw-remove-product mcw-action" style="display: flex; align-items: center; justify-content: center; cursor: pointer;">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.17065 4C9.58249 2.83481 10.6937 2 11.9999 2C13.3062 2 14.4174 2.83481 14.8292 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M20.5 6H3.49988" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5M18.8334 8.5L18.6334 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </div>
                        <?php } ?>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <div class="mcw-quantity-container" style="display: flex; align-items: center; margin-top: 6px; <?php echo esc_attr($data['style']['action']); ?>">
                            <button class="mcw-quantity-minus">-</button>
                            <input type="text" class="mcw-quantity-input" value=" <?php echo $cart_item['quantity']; ?>">
                            <button class="mcw-quantity-plus">+</button>
                        </div>
                        <div class="mcw-product-total-price" style="display: flex; flex-wrap: wrap justify-content: space-around; align-items: center;">
                            <?php echo $product_subtotal; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    <?php } else { ?>
        <div style="display: flex; justify-content: center; align-items: center;">
            <?php esc_html_e('Your Cart is Empty', 'min-cart-woocommerce'); ?>
        </div>
        <div class="mcw-actions">
            <a class="mcw-action" href="<?php echo get_permalink(wc_get_page_id( 'shop' )); ?>" style="text-decoration: none; <?php echo esc_attr($data['style']['action']); ?>">
                <button style="width: 100%; background-color: inherit; color: currentColor;"> <?php esc_html_e('Return to Shop', 'mini-cart-woocommerce');?> </button>
            </a>
        </div>
    <?php } ?>
</div>

<div style="width: 100%;">
    <?php if (!$cart->is_empty()) { ?>
        <div class="mcw-coupon" style="<?php echo esc_attr($data['style']['coupon']); ?>">
            <?php if (!empty($applied_coupons)) { ?>
                <div id="mcw-coupon-list" style="padding-left: 20px; width: 100%;">
                    <?php foreach ($applied_coupons as $applied_coupon) : ?>
                        <div style="display: flex; margin: 5px 0; gap: 4px; align-items: center;">
                            <div type="text" id="mcw-coupon"  style="color: currentColor; background-color: inherit;"><?php echo esc_attr($applied_coupon); ?></div>
                            <span id="mcw-remove-coupon" data-coupon="<?php echo esc_attr($applied_coupon); ?>" style="color: red; cursor: pointer;">
                        [<?php esc_html_e('remove', 'mini-cart-woocommerce'); ?>]
                    </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php } ?>
            <div style="display: flex; align-items: center; justify-content: center; line-height: 1;">
                <div id="mcw-add-coupon" style="cursor: pointer;">
                    <div class="mcw-coupon-option mcw-action" style="display: flex; align-items: center; gap: 4px; padding: 5px; width: 100px;">
                        <span><?php esc_html_e('Add Coupon', 'mini-cart-woocommerce'); ?></span>
                    </div>
                    <div class="mcw-coupon-option" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 32 32" fill="currentColor">
                            <line stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" x1="7" x2="25" y1="7" y2="25"/>
                            <line stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" x1="7" x2="25" y1="25" y2="7"/>
                        </svg>
                    </div>
                </div>
                <div id="mcw-add-coupon-field" style="display: none; padding: 5px; background-color: inherit; color: currentColor;">
                    <div>
                        <input id="mcw-coupon-text" type="text" style="width: 180px;" placeholder="coupon code">
                        <button  class="mcw-action" id="mcw-apply-coupon" style="font-size: 16px !important; <?php echo esc_attr($data['style']['action']); ?>">
                            <?php esc_html_e('apply coupon', 'mini-cart-woocommerce'); ?>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    <?php } ?>

    <div class="mcw-footer" style="<?php echo esc_attr($data['style']['footer']); ?>">
        <div>
            <span style="display: flex; gap: 6px; justify-content: space-between; padding: 0 10px;">
                <?php esc_html_e('Subtotal', 'mini-cart-woocommerce');?> :<?php echo $cart->get_cart_subtotal(); ?>
            </span>
            <?php if (!empty($applied_coupons)) { ?>
                <span style="display: flex; gap: 6px; justify-content: space-between; padding: 0 10px;">
                     <?php esc_html_e('Discount', 'mini-cart-woocommerce');?> :<?php echo wc_price($cart->get_cart_discount_total()); ?>
                </span>
           <?php } ?>
            <span style="display: flex; gap: 6px; justify-content: space-between; padding: 0 10px;">
                <?php esc_html_e('Total', 'mini-cart-woocommerce');?> :<?php echo $cart->get_cart_total(); ?>
            </span>
        </div>

        <div class="mcw-actions">
            <a class="mcw-action" href="<?php echo wc_get_checkout_url(); ?>" style="text-decoration: none; <?php echo esc_attr($data['style']['action']); ?>">
                <button style="width: 100%; background-color: inherit; color: currentColor;" <?php echo $cart->is_empty() ? 'disabled' : '' ; ?>>  <?php echo esc_html($data['checkout_cta_text']); ?> </button>
            </a>
            <a class="mcw-action" href="<?php echo get_permalink(wc_get_page_id( 'shop' )); ?>" style="text-decoration: none; <?php echo esc_attr($data['style']['action']); ?>">
                <button style="width: 100%; background-color: inherit; color: currentColor;"> <?php echo esc_html($data['continue_cta_text']); ?> </button>
            </a>
            <?php if (!empty($data['show_cart_button_in_footer'])) { ?>
                <a class="mcw-action" href="<?php echo wc_get_cart_url(); ?>" style="text-decoration: none; <?php echo esc_attr($data['style']['action']); ?>">
                    <button style="width: 100%; background-color: inherit; color: currentColor;" <?php echo $cart->is_empty() ? 'disabled' : '' ; ?>> <?php echo esc_html($data['cart_cta_text']); ?> </button>
                </a>
            <?php } ?>
        </div>

    </div>
</div>