<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

use Lum\ConsulClient\AbstractConsulService;

/**
 * Class DefaultStatus
 *
 * @package Lum\ConsulClient\V1
 */
final class DefaultStatus extends AbstractConsulService implements Status
{
    /**
     * 返回当前集群的Raft leader
     *
     * @return \Lum\Consul\ConsulResponse
     */
    public function leader()
    {
        return $this->client->get('/status/leader');
    }

    /**
     * 返回当前集群中同事
     *
     * @return \Lum\Consul\ConsulResponse
     */
    public function peers()
    {
        return $this->client->get('/status/peers');
    }
}