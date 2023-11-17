<?php

namespace MCW\App\Controllers;

use MCW\App\Helpers\Database;
use MCW\App\Helpers\Page;
use MCW\App\Helpers\WC;
use MCW\App\Route;

defined('ABSPATH') || exit;

class Ajax
{

    /***
     * Get authenticated user request handlers.
     * @return array
     */
    private static function getAuthRequestHandlers()
    {
        return (array) apply_filters('mcw_ajax_auth_request_handlers',[
            'save_option' => [__CLASS__, 'saveOption'],
            'remove_item_from_cart' => [__CLASS__, 'removeItemFromCart'],
            'update_quantity' => [__CLASS__, 'updateQuantity'],
            'refresh_mini_cart_body' => [__CLASS__, 'refreshMiniCartBody'],
            'is_cart_empty' => [__CLASS__, 'IsCartEmpty'],
            'get_cart_empty_html' => [__CLASS__, 'getCartEmptyHTML'],
        ]);
    }

    /**
     * Get non-authenticated (guest) user request handlers.
     *
     * @return array
     */
    private static function getGuestRequestHandlers()
    {
        return (array) apply_filters('mcw_ajax_guest_request_handlers', [
            'remove_item_from_cart' => [__CLASS__, 'removeItemFromCart'],
            'update_quantity' => [__CLASS__, 'updateQuantity'],
            'refresh_mini_cart_body' => [__CLASS__, 'refreshMiniCartBody'],
            'check_is_cart_empty_or_not' => [__CLASS__, 'IsCartEmpty'],
            'get_cart_empty_html' => [__CLASS__, 'getCartEmptyHTML'],
        ]);
    }

    /**
     * To handle authenticated user requests.
     * @return void
     */
    public static function handleAuthRequests()
    {
        $method = self::get('method', '', 'post');
        $handlers = self::getAuthRequestHandlers();
        if (!empty($method) && isset($handlers[$method]) && is_callable($handlers[$method])) {
            wp_send_json_success(call_user_func($handlers[$method]));
        }
        wp_send_json_error(['message' => __("Method not exists.", 'mini-cart-woocommerce')]);
    }

    /**
     * To handle non-authenticated (guest) user requests.
     *
     * @return void
     */
    public static function handleGuestRequests()
    {
        $method = self::get('method', '', 'post');
        $handlers = self::getGuestRequestHandlers();
        if (!empty($method) && isset($handlers[$method]) && is_callable($handlers[$method])) {
            wp_send_json_success(call_user_func($handlers[$method]));
        }
        wp_send_json_error(['message' => __("Method not exists.", 'mini-cart-woocommerce')]);
    }

    private static function saveOption()
    {
        $option = self::get('option', 0, 'post');
        $key = self::get('key', '', 'post');

        if (!empty($key)) {
            return Database::set($key, $option);
        }
        return false;
    }

    /**
     * Remove item from cart
     *
     * @return array
     */
    public static function removeItemFromCart()
    {
        $cart_item_key = self::get('cart_item_key', '', 'post');
        if (!empty($cart_item_key)) {
            return [
                'cart_item_removed' => WC::removeCartItem($cart_item_key),
            ];
        }
        return ['status' => "error"];
    }

    /***
     * To Update Quantity.
     *
     * @return array
     */
    public static function updateQuantity()
    {
        $cart_item_key = self::get('cart_item_key', '', 'post');
        $current_quantity = self::get('current_quantity', '', 'post');
        $quantity_action = self::get('quantity_action', '', 'post');

        if (!empty($cart_item_key) && !empty($current_quantity) && !empty($quantity_action)) {
            if ($quantity_action == 'plus') {
                $current_quantity += 1;
            } elseif ($quantity_action == 'minus') {
                $current_quantity -= 1;
            }
            WC::setCartItemQty($cart_item_key, $current_quantity);
            $cart_item = WC::getCartItem($cart_item_key);
            if (!empty($cart_item)) {
                return [
                    'quantity' => (int) $cart_item['quantity'],
                    'line_total' => WC::formatPrice($cart_item['line_total']),
                ];
            }
        }
        return [];
    }

    /**
     * To check weather cart is Empty.
     *
     * @return bool
     */
    public static function IsCartEmpty()
    {
        $cart = WC::getCartItems();
        if (empty($cart)) {
            return true;
        }
        return false;
    }

    /***
     * To get fresh Cart Body Html.
     *
     * @return false|string
     */
    public static function getCartEmptyHTML() {
        if (file_exists(MCW_PLUGIN_PATH . 'Template/wmc-CartEmpty.php')) {
            return Page::getTemplateHTML('wmc-CartEmpty.php');
        }
        return false;
    }

    /***
     * To get fresh Cart Body Html.
     *
     * @return false|string
     */
    public static function refreshMiniCartBody() {
        if (file_exists(MCW_PLUGIN_PATH . 'Template/wmc-Body.php')) {
            return Page::getTemplateHTML('wmc-Body.php', [
                'cart_items' => WC::getCartItems(),
            ]);
        }
        return false;
    }

    /**
     * Get sanitized input form request.
     *
     * @param string $var
     * @param mixed $default
     * @param string $type
     * @param string|false $sanitize
     * @return mixed
     */
    public static function get($var, $default = '', $type = 'params', $sanitize = 'text')
    {
        // phpcs:disable
        if ($type == 'params' && isset($_REQUEST[$var])) {
            return $_REQUEST[$var];
        } elseif ($type == 'query' && isset($_GET[$var])) {
            return $_GET[$var];
        } elseif ($type == 'post' && isset($_POST[$var])) {
            return $_POST[$var];
        } elseif ($type == 'cookie' && isset($_COOKIE[$var])) {
            return $_COOKIE[$var];
        }
        // phpcs:enable

        return $default;
    }
}