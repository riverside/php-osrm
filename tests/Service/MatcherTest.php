<?php
namespace OSRM\Tests\Service;

use PHPUnit\Framework\TestCase;
use OSRM\Service\Matcher;
use OSRM\Response\Service as ServiceResponse;

class MatcherTest extends TestCase
{
    public function testMatcher()
    {
        $match = new Matcher();
        $response = $match->fetch('13.388860,52.517037;13.397634,52.529407');

        $this->assertInstanceOf(ServiceResponse::class, $response);
        $this->assertTrue($response->isOK());
    }
}