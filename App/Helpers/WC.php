<?php

namespace MCW\App\Helpers;

defined('ABSPATH') || exit;

class WC
{
    /**
     * Get cart items
     *
     * @return array
     */
    public static function getCartItems()
    {
        $cart = self::getCart();
        if (is_object($cart) && method_exists($cart, 'get_cart_contents')) {
            return $cart->get_cart_contents();
        }
        return [];
    }

    /**
     * Get cart object
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
     * To check weather cart is Empty.
     *
     * @return bool
     */
    public static function checkCartIsEmpty()
    {
        $cart = self::getCart();
        if (empty($cart)) {
            return false;
        }
        return true;
    }


    /**
     * Get cart item
     *
     * @param string $key
     * @return array
     */
    public static function getCartItem($key)
    {
        $cart = self::getCart();
        if (is_object($cart) && method_exists($cart, 'get_cart_item')) {
            return $cart->get_cart_item($key);
        }
        return [];
    }

    /**
     * Remove cart item
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
     * Set cart item quantity
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

    /**
     * Get formatted price html
     *
     * @param int $price
     * @param array $args
     * @return string
     */
    public static function formatPrice($price, $args = [])
    {
        if (function_exists('wc_price')) {
            return wc_price($price, $args);
        }
        return (string) $price;
    }
}