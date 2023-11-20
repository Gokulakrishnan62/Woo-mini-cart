<?php

namespace MCW\App\Controllers;

defined('ABSPATH') || exit;

class Assets
{
    /***
     * To load Admin Assets.
     */
    public static function loadAdminAssets()
    {
        if (file_exists(MCW_PLUGIN_PATH . 'Assets/js/admin.js') && file_exists(MCW_PLUGIN_PATH . 'Assets/css/admin.css')) {
            wp_enqueue_style('mcw_admin_css', plugin_dir_url(MCW_PLUGIN_FILE) . 'Assets/css/admin.css');

            wp_enqueue_script('mcw_admin_script', plugin_dir_url(MCW_PLUGIN_FILE) . 'Assets/js/admin.js', ['jquery'], null, true);
            wp_localize_script('mcw_admin_script', 'mcw_admin_script_data', self::getScriptData());
        }
    }

    /***
     * To load Frontend Assets.
     */
    public static function loadFrontendAssets()
    {
        if (file_exists(MCW_PLUGIN_PATH . 'Assets/js/frontend.js') && file_exists(MCW_PLUGIN_PATH . 'Assets/css/frontend.css')) {
            wp_enqueue_style('mcw_frontend_css', plugin_dir_url(MCW_PLUGIN_FILE) . 'Assets/css/frontend.css');

            wp_enqueue_script('mcw_frontend_script', plugin_dir_url(MCW_PLUGIN_FILE) . 'Assets/js/frontend.js', ['jquery'], null, true);
            wp_localize_script('mcw_frontend_script', 'mcw_frontend_script_data', self::getScriptData());
        }
    }


    /***
     * To get Script Data.
     *
     * @return array
     */
    public static function getScriptData()
    {
        return [
            'ajax_url' => admin_url('admin-ajax.php'),
            'is_cart' => function_exists('is_cart') && is_cart(),
            'is_checkout' => function_exists('is_checkout') && is_checkout(),
            'has_cart_block' => function_exists('has_block') && has_block('woocommerce/cart'),
            'has_checkout_block' => function_exists('has_block') && has_block('woocommerce/checkout'),
        ];
    }
}