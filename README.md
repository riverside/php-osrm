# php-osrm
PHP client for Project-OSRM.

| Build | Stable | License |
|---|---|---|
| [![Build Status](https://api.travis-ci.org/riverside/php-osrm.svg)](https://travis-ci.org/riverside/php-osrm) | [![Latest Stable Version](https://poser.pugx.org/riverside/php-osrm/v/stable)](https://packagist.org/packages/riverside/php-osrm) | [![License](https://poser.pugx.org/riverside/php-osrm/license)](https://packagist.org/packages/riverside/php-osrm) |

#### Installation
- If Composer is already installed
```
composer require riverside/php-osrm
```
- If Composer is not installed on your system yet, you may go ahead and install it using this command line:
```
$ curl -sS https://getcomposer.org/installer | php
```
Next, add the following require entry to the composer.json file in the root of your project.
```json
{
    "require" : {
        "riverside/php-osrm" : "*"
    }
}
```
Finally, use Composer to install php-osrm and its dependencies:
```
$ php composer.phar install
```

#### Loading
```php
require __DIR__ . '/vendor/autoload.php';
```

#### API
- Nearest
- Route
- Table
- Match
- Trip
- Tile

#### Links
- http://project-osrm.org/
- https://github.com/Project-OSRM
- https://wiki.openstreetmap.org/wiki/Open_Source_Routing_Machine