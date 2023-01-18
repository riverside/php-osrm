<?php
namespace OSRM;

abstract class AbstractService
{
    protected $coordinates = null;

    protected $format = 'json';

    protected $options = array();

    protected $profile = 'driving'; // driving, car, bike, foot

    protected $service = null; //route, nearest, table, match, trip, tile

    protected $version = 'v1';

    public function fetch($coordinates)
    {
        $this->coordinates = $coordinates;

        $transport = new Transport();
        $transport->request($this->getUri());

        return new Response($transport->getResponse());
    }

    public function getUri()
    {
        $uri = "$this->service/$this->version/$this->profile/$this->coordinates.$this->format";
        if ($this->options)
        {
            $uri .= "?" . http_build_query($this->options, "", '&');
        }

        return $uri;
    }

    public function setOption($key, $value)
    {
        $this->options[$key] = $value;

        return $this;
    }

    public function setProfile($value)
    {
        $this->profile = $value;

        return $this;
    }

    public function setVersion($value)
    {
        $this->version = $value;

        return $this;
    }

    public function setBearings($value)
    {
        return $this->setOption('bearings', $value);
    }

    public function setRadiuses($value)
    {
        return $this->setOption('radiuses', $value);
    }

    public function setGenerateHints($value)
    {
        if (!in_array($value, array('true', 'false')))
        {
            throw new Exception('Invalid value for $generate_hints.');
        }

        return $this->setOption('generate_hints', $value);
    }

    public function setHints($value)
    {
        return $this->setOption('hints', $value);
    }

    public function setApproaches($value)
    {
        if (!preg_match('/^(?:curb|unrestricted)(?:;(?:curb|unrestricted))*$/', $value))
        {
            throw new Exception('Invalid value for $approaches.');
        }

        return $this->setOption('approaches', $value);
    }

    public function setExclude($value)
    {
        return $this->setOption('exclude', $value);
    }

    protected function _setGeometries($value)
    {
        if (!in_array($value, array('polyline', 'polyline6', 'geojson')))
        {
            throw new Exception('Invalid value for $geometries.');
        }

        return $this->setOption('geometries', $value);
    }

    protected function _setSteps($value)
    {
        if (!in_array($value, array('true', 'false')))
        {
            throw new Exception('Invalid value for $steps.');
        }

        return $this->setOption('steps', $value);
    }

    protected function _setAnnotations($value)
    {
        if (!in_array($value, array('true', 'false', 'nodes', 'distance', 'duration', 'datasources', 'weight', 'speed')))
        {
            throw new Exception('Invalid value for $annotations.');
        }

        return $this->setOption('annotations', $value);
    }

    protected function _setOverview($value)
    {
        if (!in_array($value, array('simplified', 'full', 'false')))
        {
            throw new Exception('Invalid value for $overview.');
        }

        return $this->setOption('overview', $value);
    }

    protected function _setWaypoints($value)
    {
        if (!preg_match('/^\d+(?:(?:;\d+)?)+$/', $value))
        {
            throw new Exception('Invalid value for $waypoints.');
        }

        return $this->setOption('waypoints', $value);
    }
}
