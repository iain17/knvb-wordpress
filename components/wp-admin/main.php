<?php
//Admin panel. For setting up the api key and such.
function knvb_api_menu() {
    add_options_page('KNVB',
        'KNVB',
        'manage_options',
        'knvb-api-menu',
        'knvb_api_options');
}

function knvb_api_options() {
    include('content.php');
}

function knvb_api_register_settings() { // whitelist options
    register_setting('knvb-api-settings-group', 'knvb_api_key');
    register_setting('knvb-api-settings-group', 'knvb_api_pathname');
    register_setting('knvb-api-settings-group', 'knvb_api_clubname');
}

if(is_admin()) {
    add_action('admin_menu', 'knvb_api_menu');
    add_action('admin_init', 'knvb_api_register_settings');
}

?>