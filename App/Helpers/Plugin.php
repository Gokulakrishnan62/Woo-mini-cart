<?php

namespace MCW\App\Helpers;

defined('ABSPATH') || exit;

class Plugin
{
    /***
     * To check plugin Dependencies.
     *
     * @return bool
     */
    public static function checkDependencies()
    {
        global $wp_version;
        // check whether Woocommerce is installed and activated.
        if (!class_exists('WooCommerce')) {
            $message = 'Mini-cart for woocommerce needs Woocommerce is installed and activated.';
            self::dependenciesMissingMessage($message);
            return false;
        }

        // check whether PHP version is meet our concern.
        if (!version_compare(PHP_VERSION, '5.6', '>=')) {
            $message = 'Mini-cart for woocommerce needs PHP version "5.6" or from above.';
            self::dependenciesMissingMessage($message);
            return false;
        }

        // check whether WordPress version is meet our concern.
        if (!version_compare($wp_version, '5.3', '>=')) {
            $message = 'Mini-cart for woocommerce needs WordPress version "5.3" or from above.';
            self::dependenciesMissingMessage($message);
            return false;
        }

        return true;
    }

    /***
     * To print Dependencies missing message.
     *
     * @param string $message
     * @return void
     */
    public static function dependenciesMissingMessage($message)
    {
        add_action('admin_notices', function () use ($message)  {
            ?>
            <div class="notice notice-error">
                <p><?php esc_html_e($message, 'mini-cart-woocommerce'); ?></p>
            </div>
            <?php
        }, 1);
    }
}