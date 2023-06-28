<?php
namespace OSRM\Response;

use OSRM\AbstractResponse;

class Isochrones extends AbstractResponse
{
    /**
     * Isochrones provider
     *
     * @var string
     */
    protected $provider;

    /**
     * Isochrones constructor.
     *
     * @param string $data
     * @param string $provider
     */
    public function __construct(string $data, string $provider)
    {
        $this->data = json_decode($data, true);
        $this->provider = $provider;
    }

    /**
     * Checks if response data is correct
     *
     * @return bool
     */
    public function isOK(): bool
    {
        return isset($this->data['features']) && !empty($this->data['features']);
    }

    /**
     * Get metadata
     *
     * @return array
     */
    public function getMetadata(): array
    {
        return $this->data['metadata'];
    }

    /**
     * Get bbox
     *
     * @return array
     */
    public function getBbox(): array
    {
        return $this->data['bbox'];
    }

    /**
     * Get features
     *
     * @return array
     */
    public function getFeatures(): array
    {
        return $this->data['features'];
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->data['type'];
    }
}