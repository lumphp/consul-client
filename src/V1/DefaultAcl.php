<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

use Lum\ConsulClient\AbstractConsulService;
use Lum\ConsulClient\ConsulResponse;
use Lum\ConsulClient\Exception\ServerException;

/**
 * Class DefaultAcl
 *
 * @package Lum\ConsulClient\V1
 */
final class DefaultAcl extends AbstractConsulService
{
    /**
     * This endpoint does a special one-time bootstrap of the ACL system,
     * making the first management token if the acl.tokens.master configuration entry is not specified in
     * the Consul server configuration and if the cluster has not been bootstrapped previously.
     *
     * @return ConsulResponse
     * @throws ServerException
     * @version 0.9.1
     */
    public function bootstrap()
    {
        return $this->client->put('/acl/bootstrap');
    }

    /**
     * Creates a new token with policy
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function create()
    {
        return $this->client->get('/acl/create');
    }

    /**
     * Update the policy of a token
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function update()
    {
        return $this->client->get('/acl/update');
    }

    /**
     * Destroys a given token
     *
     * @param $id
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function destroy($id)
    {
        return $this->client->get('/acl/destroy/'.$id);
    }

    /**
     * Queries the policy of a given token
     *
     * @param $id
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function info($id)
    {
        return $this->client->get('/acl/info/'.$id);
    }

    /**
     * Creates a new token by cloning an existing token
     *
     * @param $id
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function cloneId($id)
    {
        $url = sprintf('/acl/clone/%s', $id);

        return $this->client->get($url);
    }

    /**
     * Lists all the active tokens
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function all()
    {
        return $this->client->get('/acl/list');
    }

    /**
     * This endpoint returns the status of the ACL replication processes in the data center.
     * This is intended to be used by operators or by automation checking to
     * discover the health of ACL replication.
     *
     * @param string $dataCenter
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function replication(string $dataCenter = '')
    {
        $options = [
            'query' => [
                'dc' => $dataCenter,
            ],
        ];

        return $this->client->get('/acl/replication', $options);
    }

    /**
     * This endpoint returns the status of the ACL replication processes in the data center.
     * This is intended to be used by operators or by automation checking to
     * discover the health of ACL replication.
     *
     * @param string $authMethod
     * @param string $bearerToken
     * @param null|array $meta
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     * @version 1.5
     */
    public function login(string $authMethod, string $bearerToken, ?array $meta = null)
    {
        $payload = [
            'AuthMethod' => $authMethod,
            'BearerToken' => $bearerToken,
        ];
        if ($meta) {
            $payload['Meta'] = $meta;
        }
        $options = [
            'body' => $payload,
        ];

        return $this->client->get('/acl/login', $options);
    }

    /**
     * This endpoint was added in Consul 1.5.0 and is used to destroy a token created via the login endpoint.
     * The token deleted is specified with the X-Consul-Token header or the token query parameter.
     *
     * @param string $token
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     * @version 1.5
     */
    public function logout(string $token)
    {
        $headers = [
            'X-Consul-Token' => $token,
        ];
        $options = [
            'headers' => $headers,
        ];

        return $this->client->get('/acl/logout', $options);
    }
}