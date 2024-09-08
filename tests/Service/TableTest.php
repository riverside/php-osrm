<?php
declare(strict_types=1);

namespace Riverside\Osrm\Tests\Service;

use PHPUnit\Framework\TestCase;
use Riverside\Osrm\Service\Table;
use Riverside\Osrm\Response\Service as ServiceResponse;

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