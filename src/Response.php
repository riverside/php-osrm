<?php
namespace OSRM;

class Response
{
    protected $data;

    public function __construct($data)
    {
        $this->data = json_decode($data, true);
    }

    public function toJson()
    {
        return json_encode($this->data);
    }

    public function toArray()
    {
        return $this->data;
    }

    public function getError()
    {
        return !$this->isOK() ? $this->data['code'] : null;
    }

    public function isOK()
    {
        return isset($this->data['code']) && $this->data['code'] == 'Ok';
    }
}
