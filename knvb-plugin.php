<?php
/**
 * Plugin Name: KNVB Wordpress plugin
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
    try {
        if ($club == null) {
            $api = new Api(get_option('knvb_api_pathname'), get_option('knvb_api_key'));
            $club = $api->getClub();
        }
    }catch(Exception $e) {
        echo $e->getMessage(), "\n";
    }
    return $club;
}

//Config the libraries:
Tpl::configure(array(
    "tpl_dir"       => RL."components/",
    "cache_dir"     => RL."cache/"
));

//Helpers
include_once(RL . 'helpers/debug.php');

//Plugin
include_once(RL . 'components/short-codes/main.php');
include_once(RL . 'components/wp-admin/main.php');

//Shortcodes
include_once(RL . 'components/ranking/team-rank.php');
include_once(RL . 'components/schedule/club_schedule.php');


?>
