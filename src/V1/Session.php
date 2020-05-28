<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

/**
 * Interface Session
 *
 * @package Lum\ConsulClient\V1
 */
interface Session
{
    const SERVICE_NAME = 'session';

    /**
     * @param SessionParams $params
     * @param null $body
     *
     * @return mixed
     */
    public function create($body = null, ?SessionParams $params = null);

    /**
     * @param $sessionId
     * @param SessionParams|null $params
     *
     * @return mixed
     */
    public function destroy($sessionId, ?SessionParams $params = null);

    /**
     * @param $sessionId
     * @param SessionParams|null $params
     *
     * @return mixed
     */
    public function info($sessionId, ?SessionParams $params = null);

    /**
     * @param $node
     * @param SessionParams|null $params
     *
     * @return mixed
     */
    public function node($node, ?SessionParams $params = null);

    /**
     * @param SessionParams|null $params
     *
     * @return mixed
     */
    public function all(?SessionParams $params = null);

    /**
     * @param $sessionId
     * @param SessionParams|null $params
     *
     * @return mixed
     */
    public function renew($sessionId, ?SessionParams $params = null);
}
