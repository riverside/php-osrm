# php-osrm
PHP client for Project-OSRM.

| Build | Stable | License |
| ----- | ------ | ------- |
| [![CI][x1]][y1] | [![Latest Stable Version][x2]][y2] | [![License][x3]][y3] |

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
- [Nearest][1] - Snaps a coordinate to the street network and returns the nearest `n` matches.
- [Route][2] - Finds the fastest route between coordinates in the supplied order.
- [Table][3] - Computes the duration of the fastest route between all pairs of supplied coordinates. Returns the durations or distances or both between the coordinate pairs.
- [Match][4] - Map matching matches/snaps given GPS points to the road network in the most plausible way.
- [Trip][5] - Solves the Traveling Salesman Problem using a greedy heuristic (farthest-insertion algorithm) for 10 or more waypoints and uses brute force for less than 10 waypoints.
- [Tile][6] - Generates [Mapbox Vector Tiles][7] that can be viewed with a vector-tile capable slippy-map viewer.

## Links
- [Project-OSRM (official website)][8]
- [Project-OSRM (GitHub)][9]
- [OSRM (OpenStreetMap.org)][10]

[1]: https://github.com/riverside/php-osrm/tree/master/examples/nearest.php
[2]: https://github.com/riverside/php-osrm/tree/master/examples/route.php
[3]: https://github.com/riverside/php-osrm/tree/master/examples/table.php
[4]: https://github.com/riverside/php-osrm/tree/master/examples/matcher.php
[5]: https://github.com/riverside/php-osrm/tree/master/examples/trip.php
[6]: https://github.com/riverside/php-osrm/tree/master/examples/tile.php
[7]: https://docs.mapbox.com/api/maps/vector-tiles/
[8]: http://project-osrm.org/
[9]: https://github.com/Project-OSRM
[10]: https://wiki.openstreetmap.org/wiki/Open_Source_Routing_Machine
[x1]: https://github.com/riverside/php-osrm/actions/workflows/test.yml/badge.svg
[y1]: https://github.com/riverside/php-osrm/actions/workflows/test.yml
[x2]: https://poser.pugx.org/riverside/php-osrm/v/stable
[y2]: https://packagist.org/packages/riverside/php-osrm
[x3]: https://poser.pugx.org/riverside/php-osrm/license
[y3]: https://packagist.org/packages/riverside/php-osrm