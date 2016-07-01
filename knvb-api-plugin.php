<?php
/**
 * Plugin Name: KNVB Wordprss plugin
 * Plugin URI: http://www.iMunro.nl
 * Description: A Wordpress plugin for https://github.com/fruitcake/php-knvb-dataservice-api
 * Version: 1.00
 * Author: Iain Munro
 * Author URI: http://www.iMunro.nl
 * */

require_once  'vendor/autoload.php';

use KNVB\Dataservice\Api;
use Rain\Tpl;

define('DS', '/');
define('RL', dirname(__FILE__) . DS);

//Quick helper that initiates fruitcakes project
$club = null;
function getClub() {
    global $club;
    if($club == null) {
        $api = new Api(get_option('knvb_api_pathname'), get_option('knvb_api_key'));
        $club = $api->getClub();
    }
    return $club;
}

//Config the libraries:
Tpl::configure(array(
    "tpl_dir"       => RL."components/",
    "cache_dir"     => RL."cache/"
));

## Require all needed files ##
$directories = array('helpers');

foreach ($directories as $dir) {
    if ($handle = opendir(RL . $dir)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $ext = pathinfo($entry, PATHINFO_EXTENSION);

                if($ext == 'php') {
                    //echo RL . $dir . DS . $entry.'<br>';
                    require_once(RL . $dir . DS . $entry);
                }
            }
        }

        closedir($handle);
    }
}

//Include the plugins features:
include_once(RL.'components/wp-admin/main.php');
include_once(RL.'components/ranking/main.php');
?>
