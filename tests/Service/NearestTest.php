<?php
declare(strict_types=1);

namespace Riverside\Osrm\Tests\Service;

use PHPUnit\Framework\TestCase;
use Riverside\Osrm\Service\Nearest;
use Riverside\Osrm\Response\Service as ServiceResponse;

/**
 * Class NearestTest
 * @package Riverside\Osrm\Tests\Service
 */
class NearestTest extends TestCase
{
    public function testNearest()
    {
        $nearest = new Nearest();
        $response = $nearest->setNumber(5)->fetch('13.388860,52.517037');

        $this->assertInstanceOf(ServiceResponse::class, $response);
        $this->assertTrue($response->isOK());
    }
}