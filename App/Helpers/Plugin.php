<?php

namespace MCW\App\Helpers;

defined('ABSPATH') || exit;

class Plugin
{
    /***
     * To check plugin Dependencies.
     * @param $die
     * @return bool
     */
    public static function checkDependencies($die = false)
    {
        global $wp_version;
        if (class_exists('WooCommerce')
                && version_compare(PHP_VERSION, '5.6', '>=')
                && version_compare($wp_version, '5.3', '>=')) {
            return true;
        }
        if (!empty($die)) {
            wp_die('Dependencies missing');
        }
        return false;
    }
}