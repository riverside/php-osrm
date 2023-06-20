<?php
namespace OSRM\Tests\Service;

use PHPUnit\Framework\TestCase;
use OSRM\Service\Match;
use OSRM\Response;

class MatchTest extends TestCase
{
    public function testMatch()
    {
        $matchInst = new Match();
        $response = $matchInst->fetch('13.388860,52.517037;13.397634,52.529407');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOK());
    }
}