<?php
declare(strict_types=1);

namespace Riverside\Osrm\Tests\Service;

use PHPUnit\Framework\TestCase;
use Riverside\Osrm\Service\Tile;
use Riverside\Osrm\Response\Service as ServiceResponse;

class TileTest extends TestCase
{
    public function testAttributes()
    {
        $attributes = array(
            'service',
            'profile',
            'format',
        );
        foreach ($attributes as $attribute) {
            $this->assertClassHasAttribute($attribute, Tile::class);
        }
    }

    public function testTile()
    {
        $tile = new Tile();
        $response = $tile
            ->setProfile('car')
            ->fetch('tile(1310,3166,13)');

        $this->assertInstanceOf(ServiceResponse::class, $response);
        $this->assertTrue($response->isOK());
        $this->assertSame(1273121, strlen($response->getResponse()));
    }
}