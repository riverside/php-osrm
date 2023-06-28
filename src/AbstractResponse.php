<?php
namespace OSRM;

abstract class AbstractResponse
{
    /**
     * Response data
     *
     * @var mixed
     */
    protected $data;

    /**
     * Gets the response data as a JSON string
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * Gets the response data as an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return is_array($this->data) ? $this->data : array($this->data);
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    abstract public function isOK(): bool;
}
