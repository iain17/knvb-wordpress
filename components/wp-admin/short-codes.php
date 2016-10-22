<?php
use phpFastCache\CacheManager;
$short_codes = array();

function plugin_register_short_code($name, $description, $callback, $parameters) {
    global $short_codes;
    if(strlen($name) < 3) {
        die("plugin_register_short_code: $name is too short");
    }

    if(isset($short_codes[$name])) {
        die("plugin_register_short_code: $name already exists");
    }

    $short_codes[$name] = array(
        'parameters' => $parameters,
        'callback' => $callback,
        'description' => $description
    );
}

function plugin_get_registered_short_codes() {
    global $short_codes;
    return $short_codes;
}

function knvb($parameters) {
    $short_codes = plugin_get_registered_short_codes();
    global $cache;

    if(!isset($parameters['name']) || !isset($short_codes[$parameters['name']])) {
        return "ERROR: Invalid or undefined knvb plugin name action";
    }
    $short_code = $short_codes[$parameters['name']];

    //Set parameters to default value if not set
    foreach($short_code['parameters'] as $key => $default_value) {
        if (!isset($parameters[$key])) {
            $parameters[$key] = $default_value;
        }
    }

    //Check cache
    $InstanceCache = CacheManager::getInstance('files');
    $key = $parameters['name'].'_'.json_encode($parameters);
    $CachedString = $InstanceCache->getItem($key);


    if (is_null($CachedString->get()) || !$cache) {
        $result = "";
        try {
            $result = $short_code['callback']($parameters);
            $CachedString->set($result)->expiresAfter(900);
            $InstanceCache->save($CachedString);
        }catch (Exception $e) {
            $result = $e->getMessage();
        }

        return $result;
    }
    return $CachedString->get();
}

add_shortcode('knvb', 'knvb');

?>