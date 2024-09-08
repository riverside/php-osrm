<?php
declare(strict_types=1);

namespace Riverside\Osrm\Service;

use Riverside\Osrm\AbstractService;
use Riverside\Osrm\Exception;

/**
 * Class Nearest
 * @package Riverside\Osrm\Service
 */
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