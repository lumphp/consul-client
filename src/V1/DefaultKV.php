<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

use Lum\ConsulClient\AbstractConsulService;
use Lum\ConsulClient\ConsulResponse;
use Lum\ConsulClient\Exception\ServerException;

/**
 * Class DefaultKV
 *
 * @package Lum\ConsulClient\V1
 */
final class DefaultKV extends AbstractConsulService implements KV
{
    /**
     * @param string $key
     * @param array $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function get(string $key, array $params = [])
    {
        $options = [
            'query' => $params,
        ];
        $url = sprintf('/kv/%s', ltrim($key, '/'));

        return $this->client->get($url, $options);
    }

    /**
     * @param string $key
     * @param array $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function remove(string $key, array $params = [])
    {
        $options = [
            'query' => $params,
        ];
        $url = sprintf('/kv/%s', ltrim($key, '/'));

        return $this->client->delete($url, $options);
    }

    /**
     * @param string $key
     * @param $value
     * @param array $params
     *
     * @return ConsulResponse|mixed
     * @throws ServerException
     */
    public function set(string $key, $value, array $params = [])
    {
        $options = [
            'body' => $value,
            'query' => $params,
        ];
        $url = sprintf('/kv/%s', ltrim($key, '/'));

        return $this->client->put($url, $options);
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     * @throws ServerException
     */
    public function value(string $key)
    {
        $options = [];
        $url = sprintf('/kv/%s', ltrim($key, '/'));
        $res = $this->client->get($url, $options)->getResult();
        if ($res) {
            $kv = isset($res[0]) && $res[0] ? $res[0] : null;
            $value = $kv ? base64_decode($kv->Value) : null;

            return null !== $value ? json_decode($value) : null;
        }

        return null;
    }
}
