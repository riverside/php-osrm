<?php
namespace OSRM\Tests;

use PHPUnit\Framework\TestCase;
use OSRM\Response\Service as ServiceResponse;

class ResponseServiceTest extends TestCase
{
    protected $data = '{"code":"Ok","routes":[{"legs":[{"steps":[],"summary":"","weight":263.1,"duration":260.2,"distance":1886.3},{"steps":[],"summary":"","weight":370.6,"duration":370.6,"distance":2845.5}],"weight_name":"routability","weight":633.7,"duration":630.8,"distance":4731.8}],"waypoints":[{"hint":"lv4JgHKgmoUXAAAABQAAAAAAAAAgAAAAIXRPQYXNK0AAAAAAcPePQQsAAAADAAAAAAAAABAAAACL-wAA_kvMAKlYIQM8TMwArVghAwAA7wpWZObe","distance":4.231521214,"name":"Friedrichstraße","location":[13.388798,52.517033]},{"hint":"t1jdgVXEiocGAAAACgAAAAAAAAB3AAAAppONQOodwkAAAAAA8TeEQgYAAAAKAAAAAAAAAHcAAACL-wAAfm7MABiJIQOCbswA_4ghAwAAXwVWZObe","distance":2.795148358,"name":"Torstraße","location":[13.39763,52.529432]},{"hint":"1igYgP___38fAAAAUQAAACYAAAAeAAAAeosKQlNOX0IQ7CZCjsMGQh8AAABRAAAAJgAAAB4AAACL-wAASufMAOdwIQNL58wA03AhAwQAvxBWZObe","distance":2.226580806,"name":"Platz der Vereinten Nationen","location":[13.428554,52.523239]}]}';

    public function testSuccess()
    {
        $attributes = array(
            'data',
        );
        foreach ($attributes as $attribute) {
            $this->assertClassHasAttribute($attribute, ServiceResponse::class);
        }
    }

    public function testCode()
    {
        $response = new ServiceResponse($this->data, 'route');

        $this->assertTrue($response->isOK(), 'Response code should be OK');
    }

    public function testError()
    {
        $response = new ServiceResponse($this->data, 'route');

        $this->assertEmpty($response->getError(), 'Response should not have a error');
    }

    public function testArray()
    {
        $response = new ServiceResponse($this->data, 'route');

        $this->assertIsArray($response->toArray(), 'Response data should be an array');
    }

    public function testJson()
    {
        $response = new ServiceResponse($this->data, 'route');

        $this->assertJson($response->toJson(), 'Response data should be json');
    }
}
