<?php

namespace MCW\App\Controllers;

use MCW\App\Helpers\Template;

defined('ABSPATH') || exit;

class Assets
{
    /***
     * To load Admin Assets.
     */
    public static function loadAdminAssets()
    {
        $current_url = admin_url('admin.php?page=mini-cart');
        $current_page = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
        $admin_scripts = apply_filters('mcw_admin_scripts_data', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'template_data' => Template::getDefaultData(),
            ]
        );

        if (strpos($current_url, $current_page) !== false && file_exists(MCW_PLUGIN_PATH . 'Assets/js/admin.js') && file_exists(MCW_PLUGIN_PATH . 'Assets/css/admin.css')
            && file_exists(MCW_PLUGIN_PATH . 'Assets/js/bootstrap.js') && file_exists(MCW_PLUGIN_PATH . 'Assets/css/bootstrap.css')) {
            // load css and bootstrap
            wp_enqueue_style('mcw_admin_css', plugin_dir_url(MCW_PLUGIN_FILE) . 'Assets/css/admin.css');
            wp_enqueue_style('mcw_bootstrap_css', plugin_dir_url(MCW_PLUGIN_FILE) . 'Assets/css/bootstrap.css',);

            // load scripts and bootstrap
            wp_enqueue_script('mcw_bootstrap_script', plugin_dir_url(MCW_PLUGIN_FILE) . 'Assets/js/bootstrap.js', ['jquery'], null, true);
            wp_enqueue_script('mcw_admin_script', plugin_dir_url(MCW_PLUGIN_FILE) . 'Assets/js/admin.js', ['jquery'], null, true);
            wp_localize_script('mcw_admin_script', 'mcw_admin_script_data', $admin_scripts);
        }

    }

    /***
     * To load Frontend Assets.
     */
    public static function loadFrontendAssets()
    {
        $frontend_scripts = apply_filters('mcw_frontend_scripts_data', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'is_cart' => function_exists('is_cart') && is_cart(),
                'is_checkout' => function_exists('is_checkout') && is_checkout(),
                'has_cart_block' => function_exists('has_block') && has_block('woocommerce/cart'),
                'has_checkout_block' => function_exists('has_block') && has_block('woocommerce/checkout'),
            ]
        );
        if (file_exists(MCW_PLUGIN_PATH . 'Assets/js/frontend.js') && file_exists(MCW_PLUGIN_PATH . 'Assets/css/frontend.css')) {
            // load css
            wp_enqueue_style('mcw_frontend_css', plugin_dir_url(MCW_PLUGIN_FILE) . 'Assets/css/frontend.css');

            // load scripts
            wp_enqueue_script('mcw_frontend_script', plugin_dir_url(MCW_PLUGIN_FILE) . 'Assets/js/frontend.js', ['jquery'], null, true);
            wp_localize_script('mcw_frontend_script', 'mcw_frontend_script_data', $frontend_scripts);
        }
    }
}