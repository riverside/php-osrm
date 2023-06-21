<?php
namespace OSRM\Service;

use OSRM\AbstractService;
use OSRM\Exception;

class Route extends AbstractService
{
    /**
     * @var string
     */
    protected $service = 'route';

    /**
     * @param $value
     * @return AbstractService
     * @throws Exception
     */
    public function setAlternatives($value): AbstractService
    {
        if (!(in_array($value, array('true', 'false')) || is_numeric($value)))
        {
            throw new Exception('Invalid value for $alternatives.');
        }

        return $this->setOption('alternatives', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setSteps(string $value): AbstractService
    {
        return $this->_setSteps($value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setAnnotations(string $value): AbstractService
    {
        return $this->_setAnnotations($value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setGeometries(string $value): AbstractService
    {
        return $this->_setGeometries($value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setOverview(string $value): AbstractService
    {
        return $this->_setOverview($value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setContinueStraight(string $value): AbstractService
    {
        if (!in_array($value, array('default', 'true', 'false')))
        {
            throw new Exception('Invalid value for $continue_straight.');
        }

        return $this->setOption('continue_straight', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setWaypoints(string $value): AbstractService
    {
        return $this->_setWaypoints($value);
    }

}