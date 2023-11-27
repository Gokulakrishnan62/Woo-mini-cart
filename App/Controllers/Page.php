<?php

namespace MCW\App\Controllers;

use MCW\App\Helpers\Database;
use MCW\App\Helpers\Template;

defined('ABSPATH') || exit;

class Page
{
    /***
     * To add Admin menu.
     *
     * @return void
     */
    public static function addMenu()
    {
        $page_title = esc_html__('Mini-cart', 'mini-cart-woocommerce');
        add_menu_page(
            $page_title,
            $page_title,
            'manage_woocommerce',
            'mini-cart',
            [__CLASS__, 'adminPage'],
            'dashicons-cart',
            60
        );
    }

    /***
     * To load Admin menu page.
     *
     * @return void
     */
    public static function adminPage()
    {
        if (file_exists(MCW_PLUGIN_PATH . '/App/Views/Admin.php')) {
            include MCW_PLUGIN_PATH . '/App/Views/Admin.php';
        }
    }

    /***
     * To load Widget and mini cart.
     *
     * @return void
     */
     public static function loadWidgetAndSidebar() {
        echo Template::getHTML('Widget.php', [
            'data' => Database::get('settings', '' , true),
         ]);
    }
}