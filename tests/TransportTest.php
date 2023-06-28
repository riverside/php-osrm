<?php
namespace OSRM\Tests;

use PHPUnit\Framework\TestCase;
use OSRM\Transport;

class TransportTest extends TestCase
{
    public function testAttributes()
    {
        $attributes = array(
            'connectTimeout',
            'httpCode',
            'response',
            'sslVerifyPeer',
            'timeout',
            'userAgent',
        );
        foreach ($attributes as $attribute) {
            $this->assertClassHasAttribute($attribute, Transport::class);
        }
    }

    public function testMain()
    {
        $transport = new Transport();

        $this->assertInstanceOf(Transport::class, $transport->setConnectTimeout(30));
        $this->assertInstanceOf(Transport::class, $transport->setTimeout(30));
        $this->assertInstanceOf(Transport::class, $transport->setSslVerifyPeer(true));
        $this->assertInstanceOf(Transport::class, $transport->setUserAgent('Chrome'));
        $this->assertInstanceOf(Transport::class, $transport->request('http://router.project-osrm.org/route/v1/driving/13.388860,52.517037;13.397634,52.529407;13.428555,52.523219?overview=false'));
        $this->assertIsInt($transport->getHttpCode());
        $this->assertSame(200, $transport->getHttpCode());
        $this->assertNotEmpty($transport->getResponse());
    }
}
