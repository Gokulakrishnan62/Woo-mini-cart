<?php

namespace MCW\App;

use MCW\App\Helpers\Plugin;
use MCW\App\Route;
use MCW\App\Setup;

defined('ABSPATH') || exit;

class Core
{
    /***
     * Bootstrap plugin
     */
   public function bootstrap()
   {
       Setup::init();

       add_action('plugins_loaded', function (){
           if (Plugin::checkDependencies()) {
               Route::init();
           }
       });
   }
}
