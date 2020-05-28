<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

use Lum\ConsulClient\AbstractConsulService;
use Lum\ConsulClient\ConsulResponse;
use Lum\ConsulClient\Exception\ServerException;

/**
 * Class DefaultCatalog
 *
 * @package Lum\ConsulClient\V1
 */
final class DefaultCatalog extends AbstractConsulService implements Catalog
{
    /**
     * @return ConsulResponse
     * @throws ServerException
     */
    public function dataCenters()
    {
        return $this->client->get('/catalog/datacenters');
    }

    /**
     * @param string $node
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function deregister(string $node)
    {
        $options = [
            'body' => $node,
        ];

        return $this->client->get('/catalog/deregister', $options);
    }

    /**
     * @param string $node
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function register(string $node)
    {
        $options = [
            'body' => $node,
        ];

        return $this->client->get('/catalog/register', $options);
    }

    /**
     * @param array $params
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function nodes(array $params = [])
    {
        $options = [
            'query' => $params,
        ];

        return $this->client->get('/catalog/nodes', $options);
    }

    /**
     * @param string $node
     * @param array $params
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function node(string $node, array $params = [])
    {
        $options = [
            'query' => $params,
        ];
        $url = sprintf('/catalog/node/%s', $node);

        return $this->client->get($url, $options);
    }

    /**
     * @param string $node
     * @param array $params
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function servicesByNode(string $node, array $params = [])
    {
        $options = $params ? [
            'query' => $params,
        ] : [];
        $url = sprintf('/catalog/node-services/%s', $node);

        return $this->client->get($url, $options);
    }

    /**
     * @param array $params
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function services(array $params = [])
    {
        $options = [
            'query' => $params,
        ];

        return $this->client->get('/catalog/services', $options);
    }

    /**
     * @param string $service
     * @param array $params
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function service(string $service, array $params = [])
    {
        $options = [
            'query' => $params,
        ];
        $url = sprintf('/catalog/service/%s', $service);

        return $this->client->get($url, $options);
    }
}
