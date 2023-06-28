<?php
namespace OSRM\Tests\Service;

use PHPUnit\Framework\TestCase;
use OSRM\Service\Tile;
use OSRM\Response;

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

        $this->assertInstanceOf(Response::class, $response);
        $this->assertTrue($response->isOK());
        $this->assertSame(1209850, strlen($response->getResponse()));
    }
}