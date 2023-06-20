<?php
namespace OSRM\Tests\Service;

use PHPUnit\Framework\TestCase;
use OSRM\Service\Trip;
use OSRM\Response;

class TripTest extends TestCase
{
    public function testTrip()
    {
        $trip = new Trip();
        $response = $trip->fetch('13.388860,52.517037;13.397634,52.529407');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOK());
    }
}