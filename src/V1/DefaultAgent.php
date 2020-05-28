<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

use Lum\ConsulClient\AbstractConsulService;
use Lum\ConsulClient\ConsulResponse;
use Lum\ConsulClient\Exception\ServerException;

/**
 * Class DefaultAgent
 *
 * @package Lum\ConsulClient\V1
 */
final class DefaultAgent extends AbstractConsulService
{
    /**
     * This endpoint remove a check from the local agent.
     * The agent will take care of deregistering the check from the catalog.
     * If the check with the provided ID does not exist, no action is taken.
     *
     * @param string $checkId
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function deregisterCheck(string $checkId)
    {
        $url = sprintf('/agent/check/deregister/%s', $checkId);

        return $this->client->put($url);
    }

    /**
     * List Checks
     *
     * @param string $filter
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function checks(string $filter = '')
    {
        $options = [];
        if ($filter) {
            $options['query'] = [
                'filter' => $filter,
            ];
        }

        return $this->client->get('/agent/checks', $options);
    }

    /**
     *  adds a new check to the local agent.
     * Checks may be of script, HTTP, TCP, or TTL type.
     * The agent is responsible for managing the status of the check and keeping the Catalog in sync.
     *
     * @param string $name
     * @param array $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function registerCheck(string $name, array $params = [])
    {
        $params['Name'] = $name;
        $options = [
            'body' => $params,
        ];

        return $this->client->put('/agent/check/register', $options);
    }

    /**
     * This endpoint is used with a TTL type check to set the status of the check to
     * pass|warn|fail|update and to reset the TTL clock.
     *
     * @param string $checkId
     * @param string $type
     * @param array $payload
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function ttlCheckWithType(string $checkId, string $type, array $payload = [])
    {
        $url = sprintf('/agent/check/%s/%s', $checkId, $type);

        return $this->client->put($url, $payload);
    }

    /**
     * Get Service Configuration
     *
     * @param string $serviceId
     *
     * @return ConsulResponse
     * @throws ServerException
     * @version 1.3
     */
    public function service(string $serviceId)
    {
        $url = sprintf('/agent/service/%s', $serviceId);

        return $this->client->get($url);
    }

    /**
     * Get local service health
     *
     * @param string $name service name or service id
     * @param string $type id or name
     * @param string $format
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function serviceHealth(string $name, string $type = 'id', string $format = '')
    {
        $url = sprintf('/agent/health/service/%s/%s', $type, $name);
        $options = [
            'body' => null,
        ];
        if ($format) {
            $options['body'] = [
                'format' => $format,
            ];
        }

        return $this->client->get($url, $options);
    }

    /**
     * This endpoint adds a new service, with optional health checks, to the local agent.
     * The agent is responsible for managing the status of its local services, and for sending updates
     * about its local services to the servers to keep the global catalog in sync.
     * For "connect-proxy" kind services, the service:write ACL for the Proxy.DestinationServiceName value
     * is also required to register the service.
     *
     * @param string $name
     * @param array $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function registerService(array $params = [])
    {
        $options = [
            'body' => $params,
        ];

        return $this->client->put('/agent/service/register', $options);
    }

    /**
     * List Services
     *
     * @param string $filter
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function services(string $filter = '')
    {
        $options = [];
        if ($filter) {
            $options['query'] = [
                'filter' => $filter,
            ];
        }

        return $this->client->get('/agent/services', $options);
    }

    /**
     * List Members
     *
     * @param array $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function members(array $params = [])
    {
        $options = [
            'query' => $params,
        ];

        return $this->client->get('/agent/members', $options);
    }

    /**
     * Reload Agent
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function reload()
    {
        return $this->client->put('/agent/reload');
    }

    /**
     * Read Configuration
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function self()
    {
        return $this->client->get('/agent/self');
    }

    /**
     * This endpoint instructs the agent to attempt to connect to a given address.
     *
     * @param string $address
     * @param array $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function join(string $address, array $params = [])
    {
        $options = [
            'query' => $params,
        ];
        $url = sprintf('/agent/join/%s', $address);

        return $this->client->get($url, $options);
    }

    /**
     * Force Leave and Shutdown
     *
     * @param string $node
     * @param array $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function forceLeave(string $node, array $params = [])
    {
        $url = sprintf('/agent/force-leave/%s', $node);
        $options = [
            'body' => $params,
        ];

        return $this->client->put($url, $options);
    }

    /**
     * Graceful Leave and Shutdown
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function leave()
    {
        return $this->client->put('/agent/leave');
    }

    /**
     * @param string $serviceId
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function deregisterService(string $serviceId)
    {
        $url = sprintf('/agent/service/deregister/%s', $serviceId);

        return $this->client->put($url);
    }

    /**
     * Enable Maintenance Mode
     *
     * @param array $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function enableMaintenance(array $params)
    {
        $options = [
            'body' => $params,
        ];

        return $this->client->put('/agent/maintenance', $options);
    }

    /**
     * View Metrics
     *
     * @param array $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function metrics(array $params = [])
    {
        $options = $params ? [
            'query' => $params,
        ] : [];

        return $this->client->get('/agent/metrics', $options);
    }

    /**
     * This endpoint streams logs from the local agent until the connection is closed.
     *
     * @param array $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function monitor(array $params = [])
    {
        $options = [
            'query' => $params,
        ];

        return $this->client->get('/agent/monitor', $options);
    }

    /**
     * This endpoint updates the ACL tokens currently in use by the agent.
     * It can be used to introduce ACL tokens to the agent for the first time,
     * or to update tokens that were initially loaded from the agent's configuration.
     * Tokens will be persisted only if the acl.enable_token_persistence configuration is true.
     * When not being persisted, they will need to be reset if the agent is restarted.
     *
     * @param string $token
     * @param string $configuration
     *                default, agent, agent_master, replication
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function token(string $token, string $configuration = 'default')
    {
        $options = [
            'body' => [
                'Token' => $token,
            ],
        ];
        $url = sprintf('/agent/token/%s', $configuration);

        return $this->client->put($url, $options);
    }

    /**
     * @param string $checkId
     * @param string $type
     * @param array $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function checkByType(string $checkId, string $type, array $params = [])
    {
        $options = [
            'query' => $params,
        ];
        $url = sprintf('/agent/check/%s/%s', $type, $checkId);

        return $this->client->put($url, $options);
    }
}
