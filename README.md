# php-osrm
PHP client for Project-OSRM.

| Build | Stable | License |
|---|---|---|
| [![Build Status](https://api.travis-ci.org/riverside/php-osrm.svg)](https://travis-ci.org/riverside/php-osrm) | [![Latest Stable Version](https://poser.pugx.org/riverside/php-osrm/v/stable)](https://packagist.org/packages/riverside/php-osrm) | [![License](https://poser.pugx.org/riverside/php-osrm/license)](https://packagist.org/packages/riverside/php-osrm) |

## Installation
- If Composer is already installed
```
composer require riverside/php-osrm
```
- If Composer is not installed on your system yet, you may go ahead and install it using this command line:
```
$ curl -sS https://getcomposer.org/installer | php
```
Next, add the following require entry to the `composer.json` file in the root of your project.
```json
{
    "require" : {
        "riverside/php-osrm" : "*"
    }
}
```
Finally, use Composer to install **php-osrm** and its dependencies:
```
$ php composer.phar install
```

## Loading
```php
require __DIR__ . '/vendor/autoload.php';
```

## API
- [Nearest](./tree/master/examples/nearest.php) - Snaps a coordinate to the street network and returns the nearest `n` matches.
- [Route](./tree/master/examples/route.php) - Finds the fastest route between coordinates in the supplied order.
- [Table](./tree/master/examples/table.php) - Computes the duration of the fastest route between all pairs of supplied coordinates. Returns the durations or distances or both between the coordinate pairs.
- [Match](./tree/master/examples/match.php) - Map matching matches/snaps given GPS points to the road network in the most plausible way.
- [Trip](./tree/master/examples/trip.php) - Solves the Traveling Salesman Problem using a greedy heuristic (farthest-insertion algorithm) for 10 or more waypoints and uses brute force for less than 10 waypoints.
- [Tile](./tree/master/examples/tile.php) - Generates [Mapbox Vector Tiles](https://www.mapbox.com/developers/vector-tiles/) that can be viewed with a vector-tile capable slippy-map viewer.

## Links
- http://project-osrm.org/
- https://github.com/Project-OSRM
- https://wiki.openstreetmap.org/wiki/Open_Source_Routing_Machine