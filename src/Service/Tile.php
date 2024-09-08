<?php
declare(strict_types=1);

namespace Riverside\Osrm\Service;

use Riverside\Osrm\AbstractService;

/**
 * Class Tile
 * @package Riverside\Osrm\Service
 */
class Tile extends AbstractService
{
    /**
     * @var string
     */
    protected $service = 'tile';

    /**
     * @var string
     */
    protected $profile = 'car';

    /**
     * @var string
     */
    protected $format = 'mvt';
}