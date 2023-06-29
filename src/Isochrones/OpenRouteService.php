<?php
namespace OSRM\Isochrones;

use OSRM\AbstractIsochrones;
use OSRM\Exception;
use OSRM\Response\Isochrones as IsochronesResponse;
use OSRM\Transport;

/**
 * Class OpenRouteService
 *
 * @see https://openrouteservice.org/dev/#/api-docs/v2/isochrones/{profile}/post
 * @package OSRM\Isochrones
 */
class OpenRouteService extends AbstractIsochrones
{
    const ATTRIBUTES = ['area', 'reachfactor', 'total_pop'];

    const LOCATION_TYPE = ['start', 'destination'];

    const OPTIONS = ['avoid_borders', 'avoid_countries', 'avoid_features', 'avoid_polygons', 'round_trip'];

    const RANGE_TYPE = ['time', 'distance'];

    const UNITS = ['km', 'm', 'mi'];

    /**
     * API key
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Holds the request's body data
     *
     * @var array
     */
    protected $body = [];

    /**
     * Currently selected profile
     *
     * @var string
     */
    protected $profile = 'driving-car';

    /**
     * Available profiles
     *
     * @var array
     */
    protected $profiles = [
        'cycling-electric',
        'cycling-mountain',
        'cycling-regular',
        'cycling-road',
        'driving-car',
        'driving-hgv',
        'foot-hiking',
        'foot-walking',
        'wheelchair',
    ];

    /**
     * Provider
     *
     * @var string
     */
    protected $provider = 'openrouteservice';

    /**
     * API endpoint
     *
     * @var string
     */
    protected $uri = 'https://api.openrouteservice.org/v2/isochrones/{profile}';

    /**
     * Make HTTP request
     *
     * @return IsochronesResponse
     * @throws Exception
     */
    public function fetch(): IsochronesResponse
    {
        $transport = new Transport();
        $transport
            ->setMethod('POST')
            ->setData(json_encode($this->body))
            ->addHeader("Authorization: {$this->apiKey}")
            ->addHeader('Content-Type: application/json; charset=utf-8')
            ->addHeader('Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8')
            ->request($this->getUri());

        return new IsochronesResponse($transport->getResponse(), $this->provider);
    }

    /**
     * Gets an API endpoint
     *
     * @return string
     */
    public function getUri(): string
    {
        return str_replace('{profile}', $this->profile, $this->uri);
    }

    /**
     * Sets an apiKey
     *
     * @param string $apiKey
     * @return OpenRouteService
     */
    public function setApiKey(string $apiKey): OpenRouteService
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Sets a profile
     *
     * @param string $profile
     * @return OpenRouteService
     * @throws Exception
     */
    public function setProfile(string $profile): OpenRouteService
    {
        if (!in_array($profile, $this->profiles))
        {
            throw new Exception("Invalid {$profile} profile");
        }

        $this->profile = $profile;

        return $this;
    }

    /**
     * Set locations
     *
     * @param array $locations
     * @return OpenRouteService
     */
    public function setLocations(array $locations): OpenRouteService
    {
        $this->body['locations'] = $locations;

        return $this;
    }

    /**
     * Set range
     *
     * @param array $range
     * @return OpenRouteService
     */
    public function setRange(array $range): OpenRouteService
    {
        $this->body['range'] = $range;

        return $this;
    }

    /**
     * Set attributes
     *
     * @param array $attributes
     * @return OpenRouteService
     * @throws Exception
     */
    public function setAttributes(array $attributes): OpenRouteService
    {
        $diff = array_diff($attributes, self::ATTRIBUTES);
        if ($diff)
        {
            throw new Exception("'" . join("', '", $diff) . "' are not valid attributes.");
        }
        $this->body['attributes'] = $attributes;

        return $this;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return OpenRouteService
     */
    public function setId(string $id): OpenRouteService
    {
        $this->body['id'] = $id;

        return $this;
    }

    /**
     * Set intersections
     *
     * @param bool $intersections
     * @return OpenRouteService
     */
    public function setIntersections(bool $intersections): OpenRouteService
    {
        $this->body['intersections'] = $intersections;

        return $this;
    }

    /**
     * Set interval
     *
     * @param float $interval
     * @return OpenRouteService
     */
    public function setInterval(float $interval): OpenRouteService
    {
        $this->body['interval'] = $interval;

        return $this;
    }

    /**
     * Set smoothing
     *
     * @param float $smoothing
     * @return OpenRouteService
     */
    public function setSmoothing(float $smoothing): OpenRouteService
    {
        $this->body['smoothing'] = $smoothing;

        return $this;
    }

    /**
     * Set area units
     *
     * @param string $area_units
     * @return OpenRouteService
     * @throws Exception
     */
    public function setAreaUnits(string $area_units): OpenRouteService
    {
        if (!in_array($area_units, self::UNITS))
        {
            throw new Exception("{$area_units} is not valid unit.");
        }
        $this->body['area_units'] = $area_units;

        return $this;
    }

    /**
     * Set location type
     *
     * @param string $location_type
     * @return OpenRouteService
     * @throws Exception
     */
    public function setLocationType(string $location_type): OpenRouteService
    {
        if (!in_array($location_type, self::LOCATION_TYPE))
        {
            throw new Exception("{$location_type} is not valid location type.");
        }
        $this->body['location_type'] = $location_type;

        return $this;
    }

    /**
     * Set options
     *
     * @param array $options
     * @return OpenRouteService
     * @throws Exception
     */
    public function setOptions(array $options): OpenRouteService
    {
        $diff = array_diff(array_keys($options), self::OPTIONS);
        if ($diff)
        {
            throw new Exception("'" . join("', '", $diff) . "' are not valid options.");
        }
        $this->body['options'] = $options;

        return $this;
    }

    /**
     * Set range type
     *
     * @param string $range_type
     * @return OpenRouteService
     * @throws Exception
     */
    public function setRangeType(string $range_type): OpenRouteService
    {
        if (!in_array($range_type, self::RANGE_TYPE))
        {
            throw new Exception("{$range_type} is not valid range type.");
        }
        $this->body['range_type'] = $range_type;

        return $this;
    }

    /**
     * Set units
     *
     * @param string $units
     * @return OpenRouteService
     * @throws Exception
     */
    public function setUnits(string $units): OpenRouteService
    {
        if (!in_array($units, self::UNITS))
        {
            throw new Exception("{$units} is not valid unit.");
        }
        $this->body['units'] = $units;

        return $this;
    }
}
