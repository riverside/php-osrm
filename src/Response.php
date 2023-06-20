<?php
namespace OSRM;

class Response
{
    protected $data;

    protected $service;

    public function __construct($data, $service)
    {
        $this->data = $service != 'tile' ? json_decode($data, true) : $data;
        $this->service = $service;
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public function toArray()
    {
        return is_array($this->data) ? $this->data : array($this->data);
    }

    public function getError()
    {
        return !$this->isOK() ? $this->data['code'] : null;
    }

    public function getResponse()
    {
        return $this->data;
    }

    public function isOK(): bool
    {
        return $this->service != 'tile'
            ? (isset($this->data['code']) && $this->data['code'] == 'Ok')
            : true;
    }
}
