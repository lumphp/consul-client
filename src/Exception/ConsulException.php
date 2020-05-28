<?php
declare(strict_types=1);
namespace Lum\ConsulClient\Exception;

use Exception;
use Throwable;

/**
 * Class ConsulException
 *
 * @package Lum\ConsulClient\Exception
 */
class ConsulException extends Exception
{
    /**
     * @var mixed|null $data
     */
    private $data;

    /**
     * ConsulException constructor.
     *
     * @param int $code
     * @param string $msg
     * @param null $data
     * @param Throwable|null $previous
     */
    public function __construct(int $code, string $msg = "", $data = null, ?Throwable $previous = null)
    {
        parent::__construct($msg, $code, $previous);
        $this->data = $data;
    }

    /**
     * @return mixed |null
     */
    public function getData()
    {
        return $this->data;
    }
}