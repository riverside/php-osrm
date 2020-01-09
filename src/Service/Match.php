<?php
namespace OSRM\Service;

use OSRM\AbstractService;
use OSRM\Exception;

class Match extends AbstractService
{
    protected $service = 'match';

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

    public function setOverview($value)
    {
        return $this->_setOverview($value);
    }

    public function setTimestamps($value)
    {
        if (!preg_match('/^\d{10}(?:;\d{10})*$/', $value))
        {
            throw new Exception('Invalid value for $timestamps.');
        }

        return $this->setOption('timestamps', $value);
    }

    public function setGaps($value)
    {
        if (!in_array($value, array('split', 'ignore')))
        {
            throw new Exception('Invalid value for $gaps.');
        }

        return $this->setOption('gaps', $value);
    }

    public function setTidy($value)
    {
        if (!in_array($value, array('true', 'false')))
        {
            throw new Exception('Invalid value for $tidy.');
        }

        return $this->setOption('tidy', $value);
    }

    public function setWaypoints($value)
    {
        return $this->_setWaypoints($value);
    }
}