<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

use Lum\ConsulClient\AbstractConsulService;
use Lum\ConsulClient\ConsulResponse;
use Lum\ConsulClient\Exception\ServerException;

/**
 * Class Session
 *
 * @package Lum\ConsulClient\V1
 */
final class DefaultSession extends AbstractConsulService implements Session
{
    /**
     * Create  session
     *
     * @param string|null $body
     * @param SessionParams|null $params
     *
     * @return ConsulResponse
     * @throws ServerException
     */
    public function create($body = null, ?SessionParams $params = null)
    {
        $options = $params ? [
            'query' => $params->toArray(),
        ] : [];
        if ($body) {
            $optios['body'] = $body;
        }

        return $this->client->put('/session/create', $options);
    }

    /**
     * Delete session
     *
     * @param $sessionId
     * @param SessionParams|null $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function destroy($sessionId, ?SessionParams $params = null)
    {
        $options = $params ? [
            'query' => $params->toArray(),
        ] : [];

        return $this->client->put('/session/destroy/'.$sessionId, $options);
    }

    /**
     * Read Session
     *
     * @param $sessionId
     * @param SessionParams|null $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function info($sessionId, ?SessionParams $params = null)
    {
        $options = $params ? [
            'query' => $params->toArray(),
        ] : [];

        return $this->client->get('/session/info/'.$sessionId, $options);
    }

    /**
     * List Sessions for Node
     *
     * @param $node
     * @param SessionParams|null $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function node($node, ?SessionParams $params = null)
    {
        $options = [
            'query' => $params ? $params->toArray() : null,
        ];

        return $this->client->get('/session/node/'.$node, $options);
    }

    /**
     * List Sessions(the list of active sessions.)
     *
     * @param SessionParams|null $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function all(?SessionParams $params = null)
    {
        $options = $params ? [
            'query' => $params->toArray(),
        ] : [];

        return $this->client->get('/session/list', $options);
    }

    /**
     * @param $sessionId
     * @param SessionParams|null $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function renew($sessionId, ?SessionParams $params = null)
    {
        $options = [
            'query' => $params ? $params->toArray() : null,
        ];

        return $this->client->put('/session/renew/'.$sessionId, $options);
    }
}
