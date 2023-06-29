<?php
namespace OSRM\Tests;

use OSRM\Exception;
use PHPUnit\Framework\TestCase;
use OSRM\Transport;

class TransportTest extends TestCase
{
    public function testAttributes()
    {
        $attributes = array(
            'connectTimeout',
            'data',
            'headers',
            'httpCode',
            'method',
            'response',
            'sslVerifyPeer',
            'timeout',
            'userAgent',
        );
        foreach ($attributes as $attribute) {
            $this->assertClassHasAttribute($attribute, Transport::class);
        }
    }

    public function testSetters()
    {
        $transport = new Transport();

        $this->assertInstanceOf(Transport::class, $transport->setConnectTimeout(30));
        $this->assertInstanceOf(Transport::class, $transport->setData(''));
        $this->assertInstanceOf(Transport::class, $transport->setMethod('GET'));
        $this->assertInstanceOf(Transport::class, $transport->setSslVerifyPeer(true));
        $this->assertInstanceOf(Transport::class, $transport->setTimeout(30));
        $this->assertInstanceOf(Transport::class, $transport->setUserAgent('Chrome'));
        $this->assertInstanceOf(Transport::class, $transport->addHeader('Accept: application/json'));
    }

    public function testService()
    {
        $transport = new Transport();

        $this->assertInstanceOf(Transport::class, $transport->request('http://router.project-osrm.org/route/v1/driving/13.388860,52.517037;13.397634,52.529407;13.428555,52.523219?overview=false'));
        $this->assertIsInt($transport->getHttpCode());
        $this->assertSame(200, $transport->getHttpCode());
        $this->assertNotEmpty($transport->getResponse());
    }

    public function testException()
    {
        $transport = new Transport();

        $transport
            ->setMethod('POST')
            ->setData('{"locations":[[8.681495,49.41461],[8.686507,49.41943]],	"range":[300,200]}')
            ->addHeader('Content-Type: application/json; charset=utf-8')
            ->addHeader('Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8');

        $this->expectException(Exception::class);

        $transport->request('https://api.openrouteservice.org/v2/isochrones/driving-car');
    }

    public function testIsochrones()
    {
        $transport = new Transport();

        $transport
            ->setMethod('POST')
            ->setData('{"locations":[[8.681495,49.41461],[8.686507,49.41943]],	"range":[300,200]}')
            ->addHeader('Content-Type: application/json; charset=utf-8')
            ->addHeader('Accept: application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8');

        try {
            $transport->request('https://api.openrouteservice.org/v2/isochrones/driving-car');
        } catch (Exception $e) {
            $this->assertIsInt($transport->getHttpCode());
            $this->assertSame(401, $transport->getHttpCode());
            $this->assertNotEmpty($transport->getResponse());
        }
    }
}
