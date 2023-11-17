
<?php

defined('ABSPATH') || exit;

isset($cart_items) || exit;
?>

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
            <div class="mcw-product-title" style="">
                <?php echo $product->get_title(); ?>
            </div>
            <div class="mcw-product-price" style="">
                <?php echo $product->get_price_html(); ?>
            </div>
        </div>
        <div class="mcw-quantity-container" style="display: flex; justify-content: space-around; align-items: center;">
            <button class="mcw-quantity-minus">-</button>
            <input type="text" class="mcw-quantity-input" value=" <?php echo $cart_item['quantity']; ?>">
            <button class="mcw-quantity-plus">+</button>
        </div>
        <div class="mcw-product-total-price" style="display: flex; justify-content: space-around; align-items: center;">
            <?php echo function_exists('wc_price') ? wc_price($cart_item['line_total']) : $cart_item['line_total']; ?>
        </div>
    </div>
<?php endforeach; ?>
