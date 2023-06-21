<?php
namespace OSRM;

class Response
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var string
     */
    protected $service;

    /**
     * Response constructor.
     *
     * @param mixed $data
     * @param string $service
     */
    public function __construct($data, string $service)
    {
        $this->data = $service != 'tile' ? json_decode($data, true) : $data;
        $this->service = $service;
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return is_array($this->data) ? $this->data : array($this->data);
    }

    public function getError()
    {
        return !$this->isOK() ? $this->data['code'] : null;
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
    public function isOK(): bool
    {
        return $this->service != 'tile'
            ? (isset($this->data['code']) && $this->data['code'] == 'Ok')
            : true;
    }
}
