<?php
namespace OSRM\Service;

use OSRM\AbstractService;
use OSRM\Exception;

class Trip extends AbstractService
{
    /**
     * @var string
     */
    protected $service = 'trip';

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
    public function setSteps(string $value): AbstractService
    {
        return $this->_setSteps($value);
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
    public function setAnnotations(string $value): AbstractService
    {
        return $this->_setAnnotations($value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setSource(string $value): AbstractService
    {
        if (!in_array($value, array('any', 'first')))
        {
            throw new Exception('Invalid value for $source.');
        }

        return $this->setOption('source', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setDestination(string $value): AbstractService
    {
        if (!in_array($value, array('any', 'last')))
        {
            throw new Exception('Invalid value for $destination.');
        }

        return $this->setOption('destination', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setRoundtrip(string $value): AbstractService
    {
        if (!in_array($value, array('true', 'false')))
        {
            throw new Exception('Invalid value for $roundtrip.');
        }

        return $this->setOption('roundtrip', $value);
    }
}