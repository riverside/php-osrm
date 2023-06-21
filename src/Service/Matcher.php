<?php
namespace OSRM\Service;

use OSRM\AbstractService;
use OSRM\Exception;

class Matcher extends AbstractService
{
    /**
     * @var string
     */
    protected $service = 'match';

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setSteps(string $value)
    {
        return $this->_setSteps($value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setGeometries(string $value)
    {
        return $this->_setGeometries($value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setAnnotations(string $value)
    {
        return $this->_setAnnotations($value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setOverview(string $value)
    {
        return $this->_setOverview($value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setTimestamps(string $value)
    {
        if (!preg_match('/^\d{10}(?:;\d{10})*$/', $value))
        {
            throw new Exception('Invalid value for $timestamps.');
        }

        return $this->setOption('timestamps', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setGaps(string $value)
    {
        if (!in_array($value, array('split', 'ignore')))
        {
            throw new Exception('Invalid value for $gaps.');
        }

        return $this->setOption('gaps', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setTidy(string $value)
    {
        if (!in_array($value, array('true', 'false')))
        {
            throw new Exception('Invalid value for $tidy.');
        }

        return $this->setOption('tidy', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setWaypoints(string $value)
    {
        return $this->_setWaypoints($value);
    }
}