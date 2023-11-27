<?php

namespace MCW\App\Controllers;

use MCW\App\Helpers\Template;

defined('ABSPATH') || exit;

class Minicart
{
    /***
     * To get Content HTML.
     *
     * @param bool $format
     * @return false|string
     */
    public static function getTemplate($format = true)
    {
        $data = $format ? Template::prepareInlineStyles(get_option('mcw_settings')) : get_option('mcw_settings');
        if (!empty($data)) {
            return Template::getHTML('Contents.php', [
                'data' => $data,
            ]);
        }
        return false;
    }

    /***
     * To load Widget and mini cart.
     *
     * @return void
     */
    public static function loadWidgetAndSidebar() {
        echo Template::getHTML('Widget.php', [
            'data' => Template::prepareInlineStyles(get_option('mcw_settings')),
        ]);
    }
}