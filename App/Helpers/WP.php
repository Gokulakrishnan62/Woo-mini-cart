<?php

namespace MCW\App\Helpers;

defined('ABSPATH') || exit;

class WP
{
    /**
     * Check is admin or not
     *
     * @return bool
     */
    public static function isAdmin() {
        return function_exists('is_admin') && is_admin();
    }
}