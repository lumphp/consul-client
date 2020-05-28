<?php
declare(strict_types=1);
namespace Lum\ConsulClient\Exception;

/**
 * Class ErrCode
 *
 * @package Lum\ConsulClient\Exception
 */
final class ConsulError
{
    const HTTP_CLIENT_ERROR = 100001;
    const CONSUL_SERVER_ERROR = 100002;
    const CONSUL_NOT_FOUND = 100003;
}