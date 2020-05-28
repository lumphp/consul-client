<?php
declare(strict_types=1);
namespace Lum\ConsulClient;

/**
 * Class ConsulResponse
 *
 * @package Lum\ConsulClient
 */
final class ConsulResponse
{
    const STATUS_SUCCESS = 200;
    private $headers;
    private $body;
    /**
     * @var int $status
     */
    private $status;

    /**
     * ConsulResponse constructor.
     *
     * @param $headers
     * @param $body
     * @param int $status
     */
    public function __construct($headers, $body, int $status = 200)
    {
        $this->headers = $headers;
        $this->body = $body;
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->getResult();
    }

    /**
     * @return int
     */
    public function getStatusCode() : int
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getJson()
    {
        return $this->body;
    }

    /**
     * @param bool $isArray
     *
     * @return array|mixed|null
     */
    public function getResult(bool $isArray = false)
    {
        $lines = explode("\r\n", $this->body);
        if (!$lines) {
            return json_decode($this->body, $isArray);
        }
        $result = null;
        foreach ($lines as $line) {
            $result = json_decode($line, $isArray);
            if (is_array($result)) {
                break;
            }
        }
        if (null !== $result) {
            return $result;
        }

        return $this->body;
    }
}
