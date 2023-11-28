<?php

namespace MCW\App\Helpers;

defined('ABSPATH') || exit;

class WC
{
    /**
     * Get cart object.
     *
     * @return \WC_Cart|null
     */
    public static function getCart()
    {
        if (function_exists('WC') && isset(WC()->cart)) {
            return WC()->cart;
        }
        return null;
    }

    /**
     * Remove cart item.
     *
     * @param string $key
     * @return bool
     */
    public static function removeCartItem($key)
    {
        $cart = self::getCart();
        if (is_object($cart) && method_exists($cart, 'remove_cart_item')) {
            return $cart->remove_cart_item($key);
        }
        return false;
    }

    /**
     * Set cart item quantity.
     *
     * @param string $key
     * @param int|float $quantity
     * @param bool $refresh_totals
     * @return bool
     */
    public static function setCartItemQty($key, $quantity = 1, $refresh_totals = true)
    {
        $cart = self::getCart();
        if (is_object($cart) && method_exists($cart, 'set_quantity')) {
            return $cart->set_quantity($key, $quantity, $refresh_totals);
        }
        return false;
    }

    /***
     * To refresh Cart total.
     *
     * @return void
     */
    public static function refreshCartTotal()
    {
        if (function_exists('calculate_totals')) {
           WC()->cart->calculate_totals();
        }
    }

    /***
     * To apply or remove coupon.
     *
     * @param string $coupon_code
     * @param string $action
     */
    public static function applyOrRemoveCoupon($coupon_code = '', $action = '')
    {
        if (!empty($coupon_code && !empty($action))) {
            if ($action === 'apply') {
                return self::getCart()->apply_coupon($coupon_code);
            } elseif ($action === 'remove') {
                return self::getCart()->remove_coupon($coupon_code);
            }
        }
       return false;
    }
}