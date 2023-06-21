<?php
namespace OSRM\Service;

use OSRM\AbstractService;
use OSRM\Exception;

class Table extends AbstractService
{
    /**
     * @var string
     */
    protected $service = 'table';

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setSources(string $value): AbstractService
    {
        if (!($value == 'all' || preg_match('/^\d+(?:;\d+)*$/', $value)))
        {
            throw new Exception('Invalid value for $sources.');
        }

        return $this->setOption('sources', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setDestinations(string $value): AbstractService
    {
        if (!($value == 'all' || preg_match('/^\d+(?:;\d+)*$/', $value)))
        {
            throw new Exception('Invalid value for $destinations.');
        }

        return $this->setOption('destinations', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setAnnotations(string $value): AbstractService
    {
        if (!in_array($value, array('duration', 'distance', 'duration,distance')))
        {
            throw new Exception('Invalid value for $annotations.');
        }

        return $this->setOption('annotations', $value);
    }

    /**
     * @param float $value
     * @return AbstractService
     * @throws Exception
     */
    public function setFallbackSpeed(float $value): AbstractService
    {
        if (!is_float($value))
        {
            throw new Exception('Invalid value for $fallback_speed.');
        }

        return $this->setOption('fallback_speed', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setFallbackCoordinate(string $value): AbstractService
    {
        if (!in_array($value, array('input', 'snapped')))
        {
            throw new Exception('Invalid value for $fallback_coordinate.');
        }

        return $this->setOption('fallback_coordinate', $value);
    }

    /**
     * @param float $value
     * @return AbstractService
     * @throws Exception
     */
    public function setScaleFactor(float $value): AbstractService
    {
        if (!is_float($value))
        {
            throw new Exception('Invalid value for $scale_factor.');
        }

        return $this->setOption('scale_factor', $value);
    }
}