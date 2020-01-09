<?php
namespace OSRM\Service;

use OSRM\AbstractService;
use OSRM\Exception;

class Table extends AbstractService
{
    protected $service = 'table';

    public function setSources($value)
    {
        if (!($value == 'all' || preg_match('/^\d+(?:;\d+)*$/', $value)))
        {
            throw new Exception('Invalid value for $sources.');
        }

        return $this->setOption('sources', $value);
    }

    public function setDestinations($value)
    {
        if (!($value == 'all' || preg_match('/^\d+(?:;\d+)*$/', $value)))
        {
            throw new Exception('Invalid value for $destinations.');
        }

        return $this->setOption('destinations', $value);
    }

    public function setAnnotations($value)
    {
        if (!in_array($value, array('duration', 'distance', 'duration,distance')))
        {
            throw new Exception('Invalid value for $annotations.');
        }

        return $this->setOption('annotations', $value);
    }

    public function setFallbackSpeed($value)
    {
        if (!is_float($value))
        {
            throw new Exception('Invalid value for $fallback_speed.');
        }

        return $this->setOption('fallback_speed', $value);
    }

    public function setFallbackCoordinate($value)
    {
        if (!in_array($value, array('input', 'snapped')))
        {
            throw new Exception('Invalid value for $fallback_coordinate.');
        }

        return $this->setOption('fallback_coordinate', $value);
    }

    public function setScaleFactor($value)
    {
        if (!is_float($value))
        {
            throw new Exception('Invalid value for $scale_factor.');
        }

        return $this->setOption('scale_factor', $value);
    }
}