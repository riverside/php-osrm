<?php
declare(strict_types=1);

namespace Riverside\Osrm\Response;

use Riverside\Osrm\AbstractResponse;

/**
 * Class Service
 * @package Riverside\Osrm\Response
 */
class Service extends AbstractResponse
{
    /**
     * OSRM service
     *
     * @var string
     */
    protected $service;

    /**
     * Service constructor.
     *
     * @param mixed $data
     * @param string $service
     */
    public function __construct($data, string $service)
    {
        $this->data = $service != 'tile' ? json_decode($data, true) : $data;
        $this->service = $service;
    }

    public function getError()
    {
        return !$this->isOK() ? $this->data['code'] : null;
    }

    /**
     * Checks if response data is correct
     *
     * @return bool
     */
    public function isOK(): bool
    {
        return $this->service != 'tile'
            ? (isset($this->data['code']) && $this->data['code'] == 'Ok')
            : true;
    }
}
