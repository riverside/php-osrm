<?php
namespace OSRM;

class Response
{
    protected $data;

    public function __construct($data)
    {
        $this->data = json_decode($data, true);
    }

    public function toJson(): string
    {
        return json_encode($this->data);
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getError()
    {
        return !$this->isOK() ? $this->data['code'] : null;
    }

    public function isOK(): bool
    {
        return isset($this->data['code']) && $this->data['code'] == 'Ok';
    }
}
