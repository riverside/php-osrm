<?php
namespace OSRM\Service;

use OSRM\AbstractService;
use OSRM\Exception;

class Nearest extends AbstractService
{
    protected $service = 'nearest';

    public function setNumber($value)
    {
        if (!(is_numeric($value) && (int) $value >= 1))
        {
            throw new Exception('Invalid value for $number');
        }

        return $this->setOption('number', $value);
    }
}