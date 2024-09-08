<?php
declare(strict_types=1);

namespace Riverside\Osrm;

/**
 * Class Transport
 * @package Riverside\Osrm
 */
class Transport
{
    /**
     * Connection timeout
     *
     * @var int
     */
    protected $connectTimeout = 10;

    /**
     * POST data
     *
     * @var array|string
     */
    protected $data = '';

    /**
     * Request headers
     *
     * @var array
     */
    protected $headers = [];

    /**
     * HTTP status code
     *
     * @var int
     */
    protected $httpCode;

    /**
     * HTTP verb
     *
     * @var string
     */
    protected $method = 'GET';

    /**
     * Response
     *
     * @var mixed
     */
    protected $response;

    /**
     * SSL verify peer
     *
     * @var bool
     */
    protected $sslVerifyPeer = false;

    /**
     * Timeout
     *
     * @var int
     */
    protected $timeout = 15;

    /**
     * User agent
     *
     * @var string
     */
    protected $userAgent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36';

    /**
     * Make a HTTP request
     *
     * @param string $url
     * @return Transport
     * @throws Exception
     */
    public function request(string $url): Transport
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
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);

        $post_fields = $this->getData();

        switch ($this->getMethod())
        {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                if ($post_fields && is_array($post_fields))
                {
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if (!empty($post_fields))
                {
                    $url = "{$url}?{$post_fields}";
                }
                break;
            case 'HEAD':
                curl_setopt($ch, CURLOPT_NOBODY, true);
                break;
        }

        $headers = $this->getHeaders();
        if (!empty($headers))
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        $this->response = curl_exec($ch);
        $this->httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($this->httpCode != 200)
        {
            throw new Exception("HTTP status code: {$this->httpCode}. Response: {$this->response}");
        }

        if (curl_errno($ch) == 28)
        {
            throw new Exception('Timeout');
        }
        curl_close($ch);

        return $this;
    }

    /**
     * Get POST data
     *
     * @return array|string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get HTTP status code
     *
     * @return int
     */
    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    /**
     * Get HTTP verb
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Get response
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set connection timeout
     *
     * @param int $value
     * @return Transport
     */
    public function setConnectTimeout(int $value): Transport
    {
        $this->connectTimeout = (int) $value;

        return $this;
    }

    /**
     * Set POST data
     *
     * @param array|string $data
     * @param bool $encode_string
     * @return Transport
     */
    public function setData($data, bool $encode_string=true): Transport
    {
        if (is_array($data) && $encode_string)
        {
            if (version_compare(phpversion(), '5.1.2', '>='))
            {
                $data = http_build_query($data, NULL, '&');
            } else {
                $data = http_build_query($data);
            }
        }
        $this->data = $data;

        return $this;
    }

    /**
     * Set HTTP verb
     *
     * @param string $method
     * @return Transport
     */
    public function setMethod(string $method): Transport
    {
        $this->method = strtoupper($method);

        return $this;
    }

    /**
     * Set timeout
     *
     * @param int $value
     * @return Transport
     */
    public function setTimeout(int $value): Transport
    {
        $this->timeout = (int) $value;

        return $this;
    }

    /**
     * Set user agent
     *
     * @param string $value
     * @return Transport
     */
    public function setUserAgent(string $value): Transport
    {
        $this->userAgent = $value;

        return $this;
    }

    /**
     * Set SSL verify peer
     *
     * @param bool $value
     * @return Transport
     */
    public function setSslVerifyPeer(bool $value): Transport
    {
        $this->sslVerifyPeer = (bool) $value;

        return $this;
    }

    /**
     * Set request headers
     *
     * @param array $headers
     * @return Transport
     */
    public function setHeaders(array $headers): Transport
    {
        $this->headers = [];

        foreach (self::flattenHeaders($headers) as $header)
        {
            $this->addHeader($header);
        }

        return $this;
    }

    /**
     * Add request header
     *
     * @param string $header
     * @return Transport
     */
    public function addHeader(string $header): Transport
    {
        if (0 === stripos(substr($header, -8), 'HTTP/1.') && 3 == count($parts = explode(' ', $header)))
        {
            list($method, ) = $parts;

            $this->setMethod($method);
        } else {
            $this->headers[] = $header;
        }
        return $this;
    }

    /**
     * Get request headers
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Flatten headers
     *
     * @param array $headers
     * @return array
     */
    protected static function flattenHeaders(array $headers): array
    {
        $flattened = [];
        foreach ($headers as $key => $header)
        {
            if (is_int($key))
            {
                $flattened[] = $header;
            } else {
                $flattened[] = $key.': '.$header;
            }
        }

        return $flattened;
    }
}
