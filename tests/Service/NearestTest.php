<?php
namespace OSRM\Tests\Service;

use PHPUnit\Framework\TestCase;
use OSRM\Service\Nearest;
use OSRM\Response;

class NearestTest extends TestCase
{
    public function testNearest()
    {
        $nearest = new Nearest();
        $response = $nearest->setNumber(5)->fetch('13.388860,52.517037');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOK());
    }
}