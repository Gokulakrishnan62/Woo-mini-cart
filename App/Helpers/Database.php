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
     * if we get the styles from the table the $format format the styles.
     *
     * @param string $key
     * @param mixed $default
     * @param bool $format
     *
     * @return mixed
     */
    public static function get($key, $default = '', $format = false)
    {
        $key = sanitize_key($key);
        if (empty($key)) {
            return false;
        }

        $key = 'mcw_' . $key;
        if ($format) {
            return Template::prepareInlineStyles(get_option($key, $default));
        }
        return get_option($key, $default);
    }
}