<?php
declare(strict_types=1);

namespace Riverside\Osrm;

use Riverside\Osrm\Response\Isochrones as IsochronesResponse;
/**
 * Class AbstractIsochrones
 * @package Riverside\Osrm
 */
abstract class AbstractIsochrones
{
    /**
     * @return IsochronesResponse
     */
    abstract public function fetch(): IsochronesResponse;

    /**
     * @return string
     */
    abstract public function getUri(): string;
}
