# KNVB Wordpress plugin
A Wordpress that shows the status off a Dutch football club using the official KNVB api.

## Ranking
Show the current rank of a team.
```
[knvb name="team-rank" team-id="162813" showlogo="yes" ]
```

## Schedule
Show the schedule of the club.

###This week
```
[knvb name="club-schedule" weeknummer="C" ]
```

###Previous week
```
[knvb name="club-schedule" weeknummer="P" ]
```

###Next week
```
[knvb name="club-schedule" weeknummer="N" ]
```

###Specific week
```
[knvb name="club-schedule" weeknummer="42" ]
```

###All weeks
```
[knvb name="club-schedule" weeknummer="A" ]
```

## Customisation
The plugin makes use of [raintpl](https://github.com/feulf/raintpl/) templates making it relatively easy to change to templates to your liking.
Located in: `./wp-content/plugins/knvb/components/` each html can be changed accordingly/

## Thanks to
* [fruitcake](https://github.com/fruitcake/php-knvb-dataservice-api) For such an excellent api wrapper