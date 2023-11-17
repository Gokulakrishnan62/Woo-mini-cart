<?php

namespace MCW\App\Helpers;

defined('ABSPATH') || exit;

class Page
{
    /***
     * To add Admin menu.
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
     * @return void
     */
    public static function adminPage()
    {
        if (file_exists(MCW_PLUGIN_PATH . '/App/Views/Admin.php')) {
            include (MCW_PLUGIN_PATH . '/App/Views/Admin.php');
        }
    }

    /***
     * To get the View HTML or to print.
     * @param $file
     * @param $params
     * @param $print
     * @return false|string
     */
    public static function getViewHTML($file, $params = [], $print = false)
    {
        ob_start();
        extract($params);
        include MCW_PLUGIN_PATH . 'App/Views/' . $file;

        if ($print) {
            echo ob_get_clean();
        }
        return ob_get_clean();
    }

    /***
     * To get the Template HTML or to print.
     * @param $file
     * @param $params
     * @param $print
     * @return false|string
     */
    public static function getTemplateHTML($file, $params = [], $print = false)
    {
        ob_start();
        extract($params);
        include MCW_PLUGIN_PATH . 'Template/' . $file;

        if ($print) {
            echo ob_get_clean();
        }
        return ob_get_clean();
    }
}
