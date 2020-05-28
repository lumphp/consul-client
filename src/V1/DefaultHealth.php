<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

use Lum\ConsulClient\AbstractConsulService;
use Lum\ConsulClient\ConsulResponse;
use Lum\ConsulClient\Exception\ServerException;

/**
 * Class DefaultHealth
 *
 * @package Lum\ConsulClient\V1
 */
final class DefaultHealth extends AbstractConsulService
{
    /**
     * List Checks for Node
     *
     * @param string $node
     * @param array $params
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function checksByNode(string $node, array $params = [])
    {
        $options = [
            'query' => $params,
        ];
        $url = sprintf('/health/node/%s', $node);

        return $this->client->get($url, $options);
    }

    /**
     * List Checks for Service
     *
     * @param string $service
     * @param array $params
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function checksByService(string $service, array $params = [])
    {
        $options = [
            'query' => $params,
        ];
        $url = sprintf('/health/checks/%s', $service);

        return $this->client->get($url, $options);
    }

    /**
     * List Nodes for Service
     *
     * @param string $service
     * @param array $params
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function nodesByService(string $service, array $params = [])
    {
        $options = [
            'query' => $params,
        ];
        $url = sprintf('/health/service/%s', $service);

        return $this->client->get($url, $options);
    }

    /**
     * List Nodes for Connect-capable Service
     *
     * @param string $service
     * @param array $params
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function nodesByConnectCapableService(string $service, array $params = [])
    {
        $options = [
            'query' => $params,
        ];
        $url = sprintf('/health/connect/%s', $service);

        return $this->client->get($url, $options);
    }

    /**
     * List Checks in State
     *
     * @param string $state
     * @param array $params
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function checksByState(string $state, array $params = [])
    {
        $options = [
            'query' => $params,
        ];
        $url = sprintf('/health/state/%s', $state);

        return $this->client->get($url, $options);
    }
}
