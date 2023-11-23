<?php

namespace MCW\App\Helpers;

defined('ABSPATH') || exit;

class Template
{

    /***
     * To get the Template HTML or to print.
     *
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

    /***
     * To get the default admin settings.
     *
     * @return array
     */
    public static function getDefaultData() {
        return (array) apply_filters('mcw_default_template_data', [
            'show_icon_in_header' => '1',
            'header_title' => 'Mini cart Woo',
            'show_remove_item_option' => '1',
            'product_price_format' => 'actual_price',
            'checkout_cta_text' => 'Checkout button',
            'continue_cta_text' => 'Continue shopping',
            'show_cart_button_in_footer' => '',
            'cart_cta_text' => 'View cart',
            'style' => [
                'header' => [
                    'font-size' => '',
                    'background-color' => '#000000',
                    'color' => '#000000',
                ],
                'body' => [
                    'font-size' => '',
                    'background-color' => '#000000',
                    'color' => '#000000',
                ],
                'footer' => [
                    'font-size' => '',
                    'background-color' => '#000000',
                    'color' => '#000000',
                ]
            ],
        ]);
    }
}
