<?php

namespace MCW\App;

use MCW\App\Helpers\Plugin;

defined('ABSPATH') || exit;

class Setup
{
    /**
     * Init setup
     */
    public static function init()
    {
        register_activation_hook(MCW_PLUGIN_FILE, [__CLASS__, 'activate']);
        register_deactivation_hook(MCW_PLUGIN_FILE, [__CLASS__, 'deactivate']);
        register_uninstall_hook(MCW_PLUGIN_FILE, [__CLASS__, 'uninstall']);
    }

    /**
     * Run plugin activation scripts
     */
    public static function activate()
    {
       Plugin::checkDependencies();
    }

    public static function deactivate()
    {
        // silence is golden
    }

    public static function uninstall()
    {
        // silence is golden
    }
}