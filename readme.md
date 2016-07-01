# KNVB Wordpress plugin
A Wordpress that shows the status off a Dutch football club using the official KNVB api.

## Logo's
When you want to show the logo's of the teams, just add a extra attribute to the wordpress knvb shortcodes like so:
```
[knvb-ranking id="162813" showLogo="yes"]
```

## Customisation
The plugin makes use of [raintpl](https://github.com/feulf/raintpl/) templates making it relatively easy to change to templates to your liking.
Located in: `./wp-content/plugins/knvb/components/` each html can be changed accordingly/

## Thanks to
* [fruitcake](https://github.com/fruitcake/php-knvb-dataservice-api) For such an excellent api wrapper