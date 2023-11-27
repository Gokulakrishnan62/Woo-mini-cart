<?php

namespace MCW\App;

use MCW\App\Controllers\Ajax;
use MCW\App\Controllers\Assets;
use MCW\App\Controllers\Page;

defined('ABSPATH') || exit;

class Route
{
    /**
     * To add hooks.
     */
    public static function init()
    {
        self::addGeneralHooks();

        if (is_admin()) {
            self::addAdminHooks();
        } else {
            self::addStoreHooks();
        }
    }

    /***
     * To load admin hooks.
     */
    public static function addAdminHooks()
    {
        add_action('admin_enqueue_scripts', [Assets::class,'loadAdminAssets']);
        add_action('admin_menu', [Page::class, 'addMenu']);
    }

    /***
     * To load store hooks.
     */
    public static function addStoreHooks()
    {
        add_action('wp_enqueue_scripts', [Assets::class, 'loadFrontendAssets']);
        add_action('wp_footer',[Page::class, 'loadWidgetAndSidebar']);
    }

    /***
     * To load general hooks.
     */
    public static function addGeneralHooks()
    {
        add_action('wp_ajax_mcw_ajax', [Ajax::class, 'handleAuthRequests']);
        add_action('wp_ajax_nopriv_mcw_ajax', [Ajax::class, 'handleGuestRequests']);
    }
}