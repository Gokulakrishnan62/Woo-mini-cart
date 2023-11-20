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
}
