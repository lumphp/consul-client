<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

/**
 * Interface KV
 *
 * @package Lum\ConsulClient\V1
 */
interface KV
{
    const SERVICE_NAME = 'kv';

    /**
     * @param string $key
     * @param array $options
     *
     * @return mixed
     */
    public function get(string $key, array $options = []);

    /**
     * @param string $key
     * @param $value
     * @param array $options
     *
     * @return mixed
     */
    public function set(string $key, $value, array $options = []);

    /**
     * @param string $key
     * @param array $options
     *
     * @return mixed
     */
    public function remove(string $key, array $options = []);
}
