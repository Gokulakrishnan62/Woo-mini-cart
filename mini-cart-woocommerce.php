<?php
/**
 * Plugin Name:          Mini-cart for Woocommerce
 * Plugin URI:           https://www.flycart.org
 * Description:          Mini-cart for woocommerce in all page
 * Version:              1.0.0
 * Requires at least:    5.3
 * Requires PHP:         5.6
 * Author:               Flycart
 * Author URI:           https://www.flycart.org
 * Text Domain:          mini-cart-woocommerce
 * Domain Path:          /i18n/languages
 * License:              GPL v3 or later
 * License URI:          https://www.gnu.org/licenses/gpl-3.0.html
 *
 * WC requires at least: 4.3
 * WC tested up to:      8.2
 */

use MCW\App\Helpers\Plugin;
use MCW\App\Route;
use MCW\App\Setup;

defined('ABSPATH') || exit;

// define basic plugin constants
defined('MCW_PLUGIN_FILE') || define('MCW_PLUGIN_FILE', __FILE__);
defined('MCW_PLUGIN_PATH') || define('MCW_PLUGIN_PATH', plugin_dir_path(__FILE__));
defined('MCW_PLUGIN_NAME') || define('MCW_PLUGIN_NAME', "Mini-cart Woocommerce");
defined('MCW_VERSION') || define('MCW_VERSION', "1.0.0");

// To load composer autoload (psr-4)
if (file_exists(MCW_PLUGIN_PATH . '/vendor/autoload.php')) {
    require MCW_PLUGIN_PATH . '/vendor/autoload.php';
} else {
    wp_die('Mini-cart for WooCommerce is unable to find the autoload file.');
}

// To bootstrap the plugin
if (class_exists('MCW\App\Route')) {
    // to check dependencies when plugin bootstrap.
    Setup::init();

    add_action('plugins_loaded', function (){
        if (Plugin::checkDependencies()) {
            Route::init();
        }
    });
} else {
    wp_die('Mini-cart for WooCommerce is unable to find its Route file.');
}

