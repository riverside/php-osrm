<?php
declare(strict_types=1);

namespace Riverside\Osrm;

use Riverside\Osrm\Response\Service as ServiceResponse;

/**
 * Class AbstractService
 * @package Riverside\Osrm
 */
abstract class AbstractService
{
    /**
     * @var string
     */
    protected $coordinates = '';

    /**
     * @var string
     */
    protected $format = 'json';

    /**
     * @var array
     */
    protected $options = array();

    /**
     * @var string
     */
    protected $profile = 'driving'; // driving, car, bike, foot

    /**
     * @var string
     */
    protected $service = ''; //route, nearest, table, match, trip, tile

    /**
     * @var string
     */
    protected $version = 'v1';

    /**
     * @param string $coordinates
     * @return ServiceResponse
     * @throws Exception
     */
    public function fetch(string $coordinates): ServiceResponse
    {
        $this->coordinates = $coordinates;

        $transport = new Transport();
        $transport->request($this->getUri());

        return new ServiceResponse($transport->getResponse(), $this->service);
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        $uri = "http://router.project-osrm.org/{$this->service}/{$this->version}/{$this->profile}/{$this->coordinates}.{$this->format}";
        if ($this->options)
        {
            $uri .= "?" . http_build_query($this->options, "", '&');
        }

        return $uri;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return AbstractService
     */
    public function setOption(string $key, $value): AbstractService
    {
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return AbstractService
     */
    public function setProfile(string $value): AbstractService
    {
        $this->profile = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return AbstractService
     */
    public function setVersion(string $value): AbstractService
    {
        $this->version = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return AbstractService
     */
    public function setBearings(string $value): AbstractService
    {
        return $this->setOption('bearings', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     */
    public function setRadiuses(string $value): AbstractService
    {
        return $this->setOption('radiuses', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setGenerateHints(string $value): AbstractService
    {
        if (!in_array($value, array('true', 'false')))
        {
            throw new Exception('Invalid value for $generate_hints.');
        }

        return $this->setOption('generate_hints', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     */
    public function setHints(string $value): AbstractService
    {
        return $this->setOption('hints', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    public function setApproaches(string $value): AbstractService
    {
        if (!preg_match('/^(?:curb|unrestricted)(?:;(?:curb|unrestricted))*$/', $value))
        {
            throw new Exception('Invalid value for $approaches.');
        }

        return $this->setOption('approaches', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     */
    public function setExclude(string $value): AbstractService
    {
        return $this->setOption('exclude', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    protected function _setGeometries(string $value): AbstractService
    {
        if (!in_array($value, array('polyline', 'polyline6', 'geojson')))
        {
            throw new Exception('Invalid value for $geometries.');
        }

        return $this->setOption('geometries', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    protected function _setSteps(string $value): AbstractService
    {
        if (!in_array($value, array('true', 'false')))
        {
            throw new Exception('Invalid value for $steps.');
        }

        return $this->setOption('steps', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    protected function _setAnnotations(string $value): AbstractService
    {
        if (!in_array($value, array('true', 'false', 'nodes', 'distance', 'duration', 'datasources', 'weight', 'speed')))
        {
            throw new Exception('Invalid value for $annotations.');
        }

        return $this->setOption('annotations', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    protected function _setOverview(string $value): AbstractService
    {
        if (!in_array($value, array('simplified', 'full', 'false')))
        {
            throw new Exception('Invalid value for $overview.');
        }

        return $this->setOption('overview', $value);
    }

    /**
     * @param string $value
     * @return AbstractService
     * @throws Exception
     */
    protected function _setWaypoints(string $value): AbstractService
    {
        if (!preg_match('/^\d+(?:(?:;\d+)?)+$/', $value))
        {
            throw new Exception('Invalid value for $waypoints.');
        }

        return $this->setOption('waypoints', $value);
    }
}
