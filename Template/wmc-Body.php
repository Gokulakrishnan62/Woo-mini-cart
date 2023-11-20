<?php
defined('ABSPATH') || exit;

isset($cart_items) || exit;

$applied_coupons = WC()->cart->get_applied_coupons();
?>

<h2 style="color: white;">Mini Cart</h2>
<div class="mcw-products" style="display: flex; flex-direction: column;">
    <?php if (!empty($cart_items)) { ?>
        <?php  foreach ($cart_items as $cart_item_key => $cart_item) :
            $product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key); ?>

            <div class="mcw-product" style="display: flex; flex-direction: row; margin-bottom: 10px; gap: 8px;"
                 data-cart_item_key="<?php echo esc_attr($cart_item_key); ?>">
                <div class="mcw-remove-product" style="display: flex; align-items: center; justify-content: center; cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 32 32" fill="#0000000" stroke="#0000000">
                        <line stroke="#868686" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" x1="7" x2="25" y1="7" y2="25"/>
                        <line stroke="#868686" stroke-linecap="round" stroke-linejoin="round" stroke-width="2px" x1="7" x2="25" y1="25" y2="7"/>
                    </svg>
                </div>
                <div class="mcw-product-image" style="width: 80px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <?php echo $product->get_image(); ?>
                </div>
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <div class="mcw-product-title">
                        <?php echo $product->get_title(); ?>
                    </div>
                    <div class="mcw-product-price">
                        <?php echo $product->get_price_html(); ?>
                    </div>
                </div>
                <div class="mcw-quantity-container" style="display: flex; justify-content: space-around; align-items: center;">
                    <button class="mcw-quantity-minus">-</button>
                    <input type="text" class="mcw-quantity-input" value=" <?php echo $cart_item['quantity']; ?>">
                    <button class="mcw-quantity-plus">+</button>
                </div>
                <div class="mcw-product-total-price" style="display: flex; justify-content: space-around; align-items: center;">
                    <?php echo function_exists('wc_price') ? wc_price($cart_item['line_total']) : '' ?>
                </div>
            </div>
        <?php endforeach; ?>
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

    <?php } else { ?>
        <h1>i am empty</h1>
    <?php } ?>
</div>
