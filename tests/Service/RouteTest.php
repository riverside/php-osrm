<?php
namespace OSRM\Tests\Service;

use PHPUnit\Framework\TestCase;
use OSRM\Service\Route;
use OSRM\Response\Service as ServiceResponse;

class RouteTest extends TestCase
{
    public function testRoute()
    {
        $route = new Route();
        $response = $route
            ->setSteps('true')
            ->fetch('13.388860,52.517037;13.397634,52.529407');

        $this->assertInstanceOf(ServiceResponse::class, $response);
        $this->assertTrue($response->isOK());
    }
}