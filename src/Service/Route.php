<?php
namespace OSRM\Service;

use OSRM\AbstractService;
use OSRM\Exception;

class Route extends AbstractService
{
    protected $service = 'route';

    public function setAlternatives($value)
    {
        if (!(in_array($value, array('true', 'false')) || is_numeric($value)))
        {
            throw new Exception('Invalid value for $alternatives.');
        }

        return $this->setOption('alternatives', $value);
    }

    public function setSteps($value)
    {
        return $this->_setSteps($value);
    }

    public function setAnnotations($value)
    {
        return $this->_setAnnotations($value);
    }

    public function setGeometries($value)
    {
        return $this->_setGeometries($value);
    }

    public function setOverview($value)
    {
        return $this->_setOverview($value);
    }

    public function setContinueStraight($value)
    {
        if (!in_array($value, array('default', 'true', 'false')))
        {
            throw new Exception('Invalid value for $continue_straight.');
        }

        return $this->setOption('continue_straight', $value);
    }

    public function setWaypoints($value)
    {
        return $this->_setWaypoints($value);
    }

}