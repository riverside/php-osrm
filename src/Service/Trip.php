<?php
namespace OSRM\Service;

use OSRM\AbstractService;
use OSRM\Exception;

class Trip extends AbstractService
{
    protected $service = 'trip';

    public function setOverview($value)
    {
        return $this->_setOverview($value);
    }

    public function setSteps($value)
    {
        return $this->_setSteps($value);
    }

    public function setGeometries($value)
    {
        return $this->_setGeometries($value);
    }

    public function setAnnotations($value)
    {
        return $this->_setAnnotations($value);
    }

    public function setSource($value)
    {
        if (!in_array($value, array('any', 'first')))
        {
            throw new Exception('Invalid value for $source.');
        }

        return $this->setOption('source', $value);
    }

    public function setDestination($value)
    {
        if (!in_array($value, array('any', 'last')))
        {
            throw new Exception('Invalid value for $destination.');
        }

        return $this->setOption('destination', $value);
    }

    public function setRoundtrip($value)
    {
        if (!in_array($value, array('true', 'false')))
        {
            throw new Exception('Invalid value for $roundtrip.');
        }

        return $this->setOption('roundtrip', $value);
    }
}