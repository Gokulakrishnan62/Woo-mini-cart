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
    public static function getHTML($file, $params = [], $print = false)
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
                'widget' => [
                    'background-color' => '#005c86',
                    'color' => '#effbff',
                ],
                'header' => [
                    'font-size' => '32px',
                    'background-color' => '#005c86',
                    'color' => '#effbff',
                ],
                'body' => [
                    'font-size' => '',
                    'background-color' => '#005c86',
                    'color' => '#effbff',
                ],
                'coupon' => [
                    'font-size' => '',
                    'background-color' => '#005c86',
                    'color' => '#effbff',
                ],
                'footer' => [
                    'font-size' => '24px',
                    'background-color' => '#005c86',
                    'color' => '#effbff',
                ],
                'action' => [
                    'font-size' => '16px',
                    'background-color' => '#9dadbc',
                    'color' => '#3a4856',
                ]
            ],
        ]);
    }

    /***
     * To format the styles.
     *
     * @param array $data
     *
     * @return array
     */
    public static function prepareInlineStyles($data) {
        if (isset($data['style'])) {
            $section_styles = [];
            foreach ($data['style'] as $section => $style) {
                $styles = '';
                foreach ($style as $property_name => $value) {
                    if (!empty($value)) {
                        $styles = $styles . $property_name . ': ' . $value . ';';
                    }
                }
                $section_styles[$section] = $styles;
            }
            $data['style'] = $section_styles;
        }
        return $data;
    }
}
