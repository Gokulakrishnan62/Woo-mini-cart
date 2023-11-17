<?php

namespace MCW\App;

use MCW\App\Controllers\Ajax;
use MCW\App\Helpers\Assets;
use MCW\App\Helpers\Database;
use MCW\App\Helpers\Page;
use MCW\App\Helpers\WC;
use MCW\App\Helpers\WP;


defined('ABSPATH') || exit;

class Route
{
    /**
     * To add hooks
     */
    public static function  init()
    {
        self::addGeneralHooks();
        if (WP::isAdmin()) {
            self::addAdminHooks();
        } else {
            self::addStoreHooks();
        }
    }

    /***
     * To load admin hooks
     */
    public static function addAdminHooks()
    {
        add_action('admin_menu', [Page::class, 'addMenu']);
        add_action('admin_enqueue_scripts', [Assets::class,'loadAdminAssets']);
    }

    /***
     * To load store hooks
     */
    public static function addStoreHooks()
    {
        if (Database::get('enable_widgets')) {
            add_action('wp_footer', function (){
                Page::getTemplateHTML('wmc-Widget.php', [
                    'cart_items' => WC::getCartItems(),
                ], true);
            });
            add_action('wp_enqueue_scripts', [Assets::class,'loadFrontendAssets']);
        }
    }

    /***
     * To load general hooks
     */
    public static function addGeneralHooks()
    {
        add_action('wp_ajax_mcw_ajax', [Ajax::class, 'handleAuthRequests']);
        add_action('wp_ajax_nopriv_mcw_ajax', [Ajax::class, 'handleGuestRequests']);
    }

}



