<?php
declare(strict_types=1);

namespace Riverside\Osrm\Tests;

use PHPUnit\Framework\TestCase;
use Riverside\Osrm\Response\Isochrones as IsochronesResponse;

/**
 * Class ResponseIsochronesTest
 * @package Riverside\Osrm\Tests
 */
class ResponseIsochronesTest extends TestCase
{
    protected $data = '{"type":"FeatureCollection","metadata":{"attribution":"openrouteservice.org | OpenStreetMap contributors","service":"isochrones","timestamp":1688035029252,"query":{"profile":"driving-car","locations":[[8.681495,49.41461],[8.686507,49.41943]],"range":[300,200]},"engine":{"version":"7.1.0","build_date":"2023-06-16T03:06:42Z","graph_date":"2023-06-19T18:05:47Z"}},"bbox":[8.663578,49.402765,8.702728,49.435392],"features":[{"type":"Feature","properties":{"group_index":0,"value":200,"center":[8.681494991825476,49.41459939191395]},"geometry":{"coordinates":[[[8.672918,49.417108],[8.674698,49.408814],[8.67662,49.407786],[8.676751,49.407786],[8.686325,49.412709],[8.690761,49.413064],[8.690942,49.413071],[8.691124,49.413077],[8.691809,49.413164],[8.6933,49.417194],[8.693236,49.417548],[8.690386,49.418706],[8.684954,49.420673],[8.680829,49.422106],[8.677497,49.422496],[8.677284,49.422366],[8.677071,49.422235],[8.673229,49.419824],[8.672918,49.417108]]],"type":"Polygon"}},{"type":"Feature","properties":{"group_index":0,"value":300,"center":[8.681494991825476,49.41459939191395]},"geometry":{"coordinates":[[[8.663578,49.419089],[8.663648,49.418736],[8.665533,49.409682],[8.670623,49.405741],[8.678205,49.402781],[8.67834,49.402765],[8.685922,49.407776],[8.692064,49.410558],[8.700767,49.413778],[8.700693,49.41413],[8.692914,49.42088],[8.684098,49.42814],[8.683386,49.428588],[8.672785,49.428668],[8.671039,49.427832],[8.670745,49.427625],[8.663578,49.419089]]],"type":"Polygon"}},{"type":"Feature","properties":{"group_index":1,"value":200,"center":[8.68650655292892,49.41942996400096]},"geometry":{"coordinates":[[[8.676263,49.417013],[8.676338,49.416829],[8.677842,49.415779],[8.685296,49.412503],[8.685624,49.412531],[8.685953,49.412559],[8.692094,49.413092],[8.694044,49.413585],[8.694095,49.413941],[8.694192,49.414821],[8.694225,49.422555],[8.69132,49.42575],[8.68681,49.427281],[8.683547,49.428371],[8.683212,49.428298],[8.681134,49.425013],[8.676268,49.41718],[8.676263,49.417013]]],"type":"Polygon"}},{"type":"Feature","properties":{"group_index":1,"value":300,"center":[8.68650655292892,49.41942996400096]},"geometry":{"coordinates":[[[8.671011,49.419817],[8.671014,49.419457],[8.67457,49.412583],[8.676467,49.408729],[8.676899,49.408812],[8.686552,49.410043],[8.691093,49.408761],[8.692263,49.408502],[8.692621,49.408543],[8.702728,49.414202],[8.702644,49.414552],[8.697686,49.422444],[8.697542,49.422599],[8.690671,49.429237],[8.683713,49.434346],[8.681996,49.435392],[8.681768,49.435114],[8.678874,49.430994],[8.674639,49.42538],[8.671011,49.419817]]],"type":"Polygon"}}]}';

    public function testAttributes()
    {
        $attributes = array(
            'data',
            'provider',
        );
        foreach ($attributes as $attribute) {
            $this->assertClassHasAttribute($attribute, IsochronesResponse::class);
        }
    }

    public function testCode()
    {
        $response = new IsochronesResponse($this->data, 'openrouteservice');

        $this->assertTrue($response->isOK(), 'Response code should be OK');
    }

    public function testArray()
    {
        $response = new IsochronesResponse($this->data, 'openrouteservice');

        $this->assertIsArray($response->toArray(), 'Response data should be an array');
    }

    public function testJson()
    {
        $response = new IsochronesResponse($this->data, 'openrouteservice');

        $this->assertJson($response->toJson(), 'Response data should be json');
    }

    public function testType()
    {
        $response = new IsochronesResponse($this->data, 'openrouteservice');

        $this->assertSame('FeatureCollection', $response->getType());
    }

    public function testMetadata()
    {
        $response = new IsochronesResponse($this->data, 'openrouteservice');

        $this->assertIsArray($response->getMetadata());
    }

    public function testBbox()
    {
        $response = new IsochronesResponse($this->data, 'openrouteservice');

        $this->assertIsArray($response->getBbox());
    }

    public function testFeatures()
    {
        $response = new IsochronesResponse($this->data, 'openrouteservice');

        $this->assertIsArray($response->getFeatures());
    }
}