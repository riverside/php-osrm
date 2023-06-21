<?php
namespace OSRM;

use phpDocumentor\Reflection\Types\Mixed_;

class Transport
{
    /**
     * @var int
     */
    protected $connectTimeout = 10;

    /**
     * @var int
     */
    protected $httpCode;

    /**
     * @var mixed
     */
    protected $response;

    /**
     * @var bool
     */
    protected $sslVerifyPeer = false;

    /**
     * @var int
     */
    protected $timeout = 15;

    /**
     * @var string
     */
    protected $userAgent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36';

    /**
     * @param string $uri
     * @return Transport
     * @throws Exception
     */
    public function request(string $uri): Transport
    {
        $ch = curl_init();
        if (!$ch)
        {
            throw new Exception('Failed to initialize a cURL session');
        }
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->sslVerifyPeer);
        curl_setopt($ch, CURLOPT_URL,"http://router.project-osrm.org/" . $uri);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $this->response = curl_exec($ch);
        $this->httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($this->httpCode != 200)
        {
            throw new Exception('HTTP status code: ' . $this->httpCode);
        }

        if (curl_errno($ch) == 28)
        {
            throw new Exception('Timeout');
        }
        curl_close($ch);

        return $this;
    }

    /**
     * @return int
     */
    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param int $value
     * @return Transport
     */
    public function setConnectTimeout(int $value): Transport
    {
        $this->connectTimeout = (int) $value;

        return $this;
    }

    /**
     * @param int $value
     * @return Transport
     */
    public function setTimeout(int $value): Transport
    {
        $this->timeout = (int) $value;

        return $this;
    }

    /**
     * @param string $value
     * @return Transport
     */
    public function setUserAgent(string $value): Transport
    {
        $this->userAgent = $value;

        return $this;
    }

    /**
     * @param bool $value
     * @return Transport
     */
    public function setSslVerifyPeer(bool $value): Transport
    {
        $this->sslVerifyPeer = (bool) $value;

        return $this;
    }
}
