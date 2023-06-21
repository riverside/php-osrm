<?php
namespace OSRM\Service;

use OSRM\AbstractService;
use OSRM\Exception;

class Nearest extends AbstractService
{
    /**
     * @var string
     */
    protected $service = 'nearest';

    /**
     * @param int $value
     * @return AbstractService
     * @throws Exception
     */
    public function setNumber(int $value): AbstractService
    {
        if (!(is_numeric($value) && (int) $value >= 1))
        {
            throw new Exception('Invalid value for $number');
        }

        return $this->setOption('number', $value);
    }
}