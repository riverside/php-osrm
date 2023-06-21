<?php
namespace OSRM\Service;

use OSRM\AbstractService;

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