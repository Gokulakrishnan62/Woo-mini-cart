<?php

namespace MCW\App\Controllers;

use MCW\App\Helpers\WC;

defined('ABSPATH') || exit;

class Ajax
{

    /***
     * Get authenticated user request handlers.
     *
     * @return array
     */
    private static function getAuthRequestHandlers()
    {
        return (array) apply_filters('mcw_ajax_auth_request_handlers',[
            'save_option' => [__CLASS__, 'saveOption'],
            'remove_item_from_cart' => [__CLASS__, 'removeItemFromCart'],
            'update_quantity' => [__CLASS__, 'updateQuantity'],
            'refresh_mini_cart' => [__CLASS__, 'refreshMiniCart'],
            'apply_coupon' => [__CLASS__, 'applyCoupon'],
            'remove_coupon' => [__CLASS__, 'removeCoupon'],
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
            'refresh_mini_cart' => [__CLASS__, 'refreshMiniCart'],
            'apply_coupon' => [__CLASS__, 'applyCoupon'],
            'remove_coupon' => [__CLASS__, 'removeCoupon'],
        ]);
    }

    /**
     * To handle authenticated user requests.
     *
     * @return void
     */
    public static function handleAuthRequests()
    {
        self::verifyNonce();
        $method = self::request('method', '', 'post');
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
        self::verifyNonce();
        $method = self::request('method', '', 'post');
        $handlers = self::getGuestRequestHandlers();
        if (!empty($method) && isset($handlers[$method]) && is_callable($handlers[$method])) {
            wp_send_json_success(call_user_func($handlers[$method]));
        }
        wp_send_json_error(['message' => __("Method not exists.", 'mini-cart-woocommerce')]);
    }

    /***
     * To verify nonce.
     *
     * @return void
     */
    private static function verifyNonce()
    {
        $nonce = self::request('nonce', '', 'post');
        if (!wp_verify_nonce($nonce, 'mcw_nonce')) {
            wp_send_json_error(['message' => __("Security check failed!", 'mini-cart-woocommerce')]);
        }
    }

    /***
     * To save Settings.
     *
     * @return bool
     */
    private static function saveOption()
    {
        $option = self::request('option', '', 'post');
        $key = self::request('key', '', 'post');
        parse_str($option, $data);

        if (!empty($key) && function_exists('update_option')) {
            return update_option(sanitize_key($key), $data);
        }
        return false;
    }

    /**
     * Remove item from cart.
     *
     * @return array
     */
    private static function removeItemFromCart()
    {
        $cart_item_key = self::request('cart_item_key', '', 'post');
        if (!empty($cart_item_key)) {
            return [
                'cart_item_removed' => WC::removeCartItem($cart_item_key),
                'sidebar_content' => Minicart::getTemplate(),
            ];
        }
        return ['status' => "error"];
    }

    /***
     * To Update Quantity.
     *
     * @return array
     */
    private static function updateQuantity()
    {
        $cart_item_key = self::request('cart_item_key', '', 'post');
        $current_quantity = self::request('current_quantity', '', 'post');
        $quantity_action = self::request('quantity_action', '', 'post');

        if (!empty($cart_item_key) && !empty($quantity_action)) {
            if (empty($current_quantity)) {
                $is_quantity_set = WC::removeCartItem($cart_item_key);
            } else {
                if ($quantity_action == 'plus') {
                    $current_quantity += 1;
                } elseif ($quantity_action == 'minus') {
                    $current_quantity -= 1;
                }
                $is_quantity_set = WC::setCartItemQty($cart_item_key, $current_quantity);
            }
            return [
                'is_quantity_set' => $is_quantity_set,
                'sidebar_content' => Minicart::getTemplate(),
            ];
        }
        return ['status' => "error"];
    }

    /***
     * To get fresh Cart Body Html.
     *
     * @return false|string
     */
    private static function refreshMiniCart() {
        if (file_exists(MCW_PLUGIN_PATH . 'Template/Contents.php')) {
            return Minicart::getTemplate();
        }
        return false;
    }

    /***
     * To apply coupon.
     *
     * @return array
     */
    private static function applyCoupon()
    {
        $coupon_code = sanitize_text_field(self::request('coupon_code', '', 'post'));
        if (!empty($coupon_code)) {
            $is_coupon_applied = WC::getCart()->apply_coupon($coupon_code);
            WC::refreshCartTotal();
            return [
                'is_coupon_applied' => $is_coupon_applied,
                'sidebar_content' => Minicart::getTemplate(),
            ];
        }
        return ['status' => "error"];
    }

    /***
     * To remove coupon.
     *
     * @return array
     */
    private static function removeCoupon()
    {
        $coupon_code = sanitize_text_field(self::request('coupon_code', '', 'post'));
        if (!empty($coupon_code)) {
            $is_coupon_removed = WC::getCart()->remove_coupon($coupon_code);
            WC::refreshCartTotal();
            return [
                'is_coupon_removed' => $is_coupon_removed,
                'sidebar_content' => Minicart::getTemplate(),
            ];
        }
        return ['status' => "error"];
    }

    /**
     * Get sanitized input form request.
     *
     * @param string $var
     * @param mixed $default
     * @param string $type
     * @return mixed
     */
    public static function request($var, $default = '', $type = 'params')
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