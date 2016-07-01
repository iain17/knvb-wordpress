<?php
// ==========================================================
// KNVB project
//
// Component: wp-admin
// Sub-component:
// Purpose: Admin panel. For setting up the api key and such.
//
// Initial author: Iain Munro
// Started: 1 july 2016
// ==========================================================
function knvb_api_menu() {
    add_options_page('KNVB',
        'KNVB',
        'manage_options',
        'knvb-api-menu',
        'knvb_api_options');
}

function knvb_api_options() {
    $club = getClub();
    $teams = array();
    if($club) {
        $teams = $club->getTeams();
    }
    $codes = plugin_get_registered_short_codes();
    include('content.php');
}

function knvb_api_register_settings() {
    register_setting('knvb-api-settings-group', 'knvb_api_key');
    register_setting('knvb-api-settings-group', 'knvb_api_pathname');
}

if(is_admin()) {
    add_action('admin_menu', 'knvb_api_menu');
    add_action('admin_init', 'knvb_api_register_settings');
}

?>