<?php
namespace OSRM\Tests\Service;

use PHPUnit\Framework\TestCase;
use OSRM\Service\Table;
use OSRM\Response\Service as ServiceResponse;

class TableTest extends TestCase
{
    public function testTable()
    {
        $table = new Table();
        $response = $table->fetch('13.388860,52.517037;13.397634,52.529407;13.428555,52.523219');

        $this->assertInstanceOf(ServiceResponse::class, $response);
        $this->assertTrue($response->isOK());
    }
}