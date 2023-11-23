<?php

namespace MCW\App\Helpers;

defined('ABSPATH') || exit;

class Database
{
    /**
     * Set config to options table.
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public static function set($key, $value)
    {
        $key = sanitize_key($key);
        if (empty($key)) {
            return false;
        }

        $key = 'mcw_' . $key;
        return update_option($key, $value);
    }

    /**
     * Get config from options table.
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public static function get($key, $default = '')
    {
        $key = sanitize_key($key);
        if (empty($key)) {
            return false;
        }

        $key = 'mcw_' . $key;
        return get_option($key, $default);
    }
}
