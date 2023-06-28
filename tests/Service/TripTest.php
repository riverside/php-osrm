<?php
namespace OSRM\Tests\Service;

use PHPUnit\Framework\TestCase;
use OSRM\Service\Trip;
use OSRM\Response\Service as ServiceResponse;

class TripTest extends TestCase
{
    public function testTrip()
    {
        $trip = new Trip();
        $response = $trip->fetch('13.388860,52.517037;13.397634,52.529407');

        $this->assertInstanceOf(ServiceResponse::class, $response);
        $this->assertTrue($response->isOK());
    }
}