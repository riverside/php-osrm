<?php
declare(strict_types=1);

namespace Riverside\Osrm\Tests\Service;

use PHPUnit\Framework\TestCase;
use Riverside\Osrm\Service\Matcher;
use Riverside\Osrm\Response\Service as ServiceResponse;

/**
 * Class MatcherTest
 * @package Riverside\Osrm\Tests\Service
 */
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