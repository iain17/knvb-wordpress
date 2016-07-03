![alt tag](https://raw.githubusercontent.com/iain17/knvb-wordpress/master/knvb.png)
# KNVB Wordpress plugin
A Wordpress that shows the status off a Dutch football club using the official KNVB api.

## Short codes
Short codes are different per club. See wp-admin, settings -> KNVB. After submitting your API key and Pathname both received from KNVB, the short codes will get displayed below. 

## Customisation
The plugin makes use of [raintpl](https://github.com/feulf/raintpl/) templates making it relatively easy to change to templates to your liking.
Located in: `./wp-content/plugins/knvb/components/` each html can be changed accordingly/

## Thanks to
* [fruitcake](https://github.com/fruitcake/php-knvb-dataservice-api) For such an excellent api wrapper