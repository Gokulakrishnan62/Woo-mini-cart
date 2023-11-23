<?php
defined('ABSPATH') || exit;

isset($data) || exit;
$cart = WC()->cart;
$applied_coupons = $cart->get_applied_coupons();
?>

<div class="mcw-header" style="height: 8%; color: #ffffff;">
    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="currentColor" >
        <path d="M200-80q-33 0-56.5-23.5T120-160v-480q0-33 23.5-56.5T200-720h80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720h80q33 0 56.5 23.5T840-640v480q0 33-23.5 56.5T760-80H200Zm0-80h560v-480H200v480Zm280-240q83 0 141.5-58.5T680-600h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85h-80q0 83 58.5 141.5T480-400ZM360-720h240q0-50-35-85t-85-35q-50 0-85 35t-35 85ZM200-160v-480 480Z"/>
    </svg>
    <h2 style="color: currentColor"><?php esc_html_e($data['header_title'], 'mini-cart-woocommerce'); ?></h2>
    <span style="position: absolute; right: 10px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" viewBox="0 0 32 32" fill="currentColor">
            <line stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" x1="7" x2="25" y1="7" y2="25"/>
            <line stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" x1="7" x2="25" y1="25" y2="7"/>
        </svg>
    </span>
</div>

<div class="mcw-products" style="display: flex; flex-direction: column; gap: 4px; height: 65%; overflow: auto; color: white; background-color: inherit;">
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
                <div class="mcw-remove-product" style="display: flex; align-items: center; justify-content: center; cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 32 32" fill="currentColor" stroke="currentColor">
                        <line stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" x1="7" x2="25" y1="7" y2="25"/>
                        <line stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" x1="7" x2="25" y1="25" y2="7"/>
                    </svg>
                </div>
                <div class="mcw-product-image" style="width: 64px;">
                    <?php echo $product_thumbnail; ?>
                </div>
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: start; gap: 4px; width: 160px;">
                    <div class="mcw-product-title" style="color: currentColor;">
                        <?php echo $product_name; ?>
                    </div>
                    <div class="mcw-product-price" style="color: currentColor;">
                        <?php echo $product_price; ?>
                    </div>
                </div>
                <div class="mcw-quantity-container" style="display: flex; align-items: center;">
                    <button class="mcw-quantity-minus">-</button>
                    <input type="text" class="mcw-quantity-input" value=" <?php echo $cart_item['quantity']; ?>">
                    <button class="mcw-quantity-plus">+</button>
                </div>
                <div class="mcw-product-total-price" style="display: flex; justify-content: space-around; align-items: center;">
                    <?php echo $product_subtotal; ?>
                </div>
            </div>
        <?php endforeach; ?>

    <?php } else { ?>
        <h1>i am empty</h1>
    <?php } ?>
</div>

<div class="mcw-footer" style="height: 24%;">
    <div>
        <?php echo $cart->get_cart_total(); ?>
    </div>
    <div>
        <input id="mcw-coupon-text" type="text" placeholder="coupon code">
        <input type="submit" id="mcw-apply-coupon" value="apply coupon">
    </div>
    <?php if (!empty($applied_coupons)) { ?>
        <div style="display: flex; flex-wrap: wrap;">
            <?php foreach ($applied_coupons as $applied_coupon) : ?>
                <div style="display: flex; margin: 5px; justify-content: space-between; width: 40%; border: 1px solid beige; border-radius: 32px; background-color: #f0f0f0; height: 26px;">
                    <input type="text" id="mcw-coupon" value="<?php echo esc_attr($applied_coupon); ?>" readonly style="width: 80%; background: none; border: none;">
                    <button id="mcw-remove-coupon" data-coupon="<?php echo esc_attr($applied_coupon); ?>" style="border: none; border-radius: 32px; width: 20%; background-color: #e74c3c; color: #fff; padding: 0; line-height: 1;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 32 32" fill="currentColor">
                            <line stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" x1="7" x2="25" y1="7" y2="25"/>
                            <line stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" x1="7" x2="25" y1="25" y2="7"/>
                        </svg>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    <?php } ?>
    <div class="mcw-actions">
        <button>Checkout</button>
        <button>Continue Shopping</button>
        <button>View Cart</button>

    </div>

</div>