<?php
/**
 * Plugin Name: KNVB Wordpress plugin
 * Plugin URI: http://www.iMunro.nl
 * Description: A Wordpress plugin for https://github.com/fruitcake/php-knvb-dataservice-api
 * Version: 1.03
 * Author: Iain Munro
 * Author URI: http://www.iMunro.nl
 * */

$cache = true;

if($_SERVER['REMOTE_ADDR'] == '-') {
//    $cache = false;
//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);
}

require_once  'vendor/autoload.php';
use KNVB\Dataservice\Api;
use Rain\Tpl;
use phpFastCache\CacheManager;

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

// Setup File Path on your config files
CacheManager::setup(array(
    "path" =>  RL."cache/",
));

//Helpers
include_once(RL . 'helpers/debug.php');
include_once(RL . 'helpers/sortByTime.php');

//Plugin
include_once(RL . 'components/wp-admin/short-codes.php');
include_once(RL . 'components/wp-admin/main.php');

//Shortcodes
include_once(RL . 'components/ranking/team_rank.php');
include_once(RL . 'components/schedule/club_schedule.php');
include_once(RL . 'components/schedule/team_schedule.php');
include_once(RL . 'components/results/club_result.php');
include_once(RL . 'components/results/team_result.php');


/**
 * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
 */
add_action( 'wp_enqueue_scripts', 'prefix_add_my_stylesheet' );

/**
 * Enqueue plugin style-file
 */
function prefix_add_my_stylesheet() {
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'prefix-style', plugins_url('style.css', __FILE__) );
    wp_enqueue_style( 'prefix-style' );
}

?>
