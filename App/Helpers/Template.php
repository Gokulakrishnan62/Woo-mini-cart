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
        include MCW_PLUGIN_PATH . 'template/' . $file;

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
            'data' => [
                'header' => [
                    'icon' => [
                        'show' => 1,
                    ],
                    'title' => 'Mini cart Woo',
                ],
                'items' => [
                    'item' => [
                        'show_remove_option' => 1,
                        'price_format' => 'actual_price',
                    ],
                ],
                'coupons' => [
                    'coupon' => [
                        'sub_title' => 'coupon :',
                    ]
                ],
                'actions' => [
                    'checkout' => [
                        'enabled' => 1,
                        'cta' => 'Checkout button',
                    ],
                    'cart' => [
                        'enabled' => 1,
                        'cta' => 'View Cart',
                    ],
                    'shop' => [
                        'enabled' => 1,
                        'cta' => 'Continue Shopping',
                    ],
                ],
                'footer' => [
                    'show' => [
                        'discount' => '',
                        'total' => '',
                    ],
                ],
            ],
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
                    'font-size' => '16px',
                    'background-color' => '#005c86',
                    'color' => '#effbff',
                ],
                'coupon' => [
                    'font-size' => '16px',
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
