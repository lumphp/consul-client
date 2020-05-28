<?php
declare(strict_types=1);
namespace Lum\ConsulClient;

/**
 * Interface Client
 *
 * @package Lum\ConsulClient
 */
interface HttpClient
{
    /**
     * @param string $url
     * @param array $options
     *
     * @return mixed
     */
    public function get(string $url, array $options = []);

    /**
     * @param string $url
     * @param array $options
     *
     * @return mixed
     */
    public function head(string $url, array $options = []);

    /**
     * @param string $url
     * @param array $options
     *
     * @return mixed
     */
    public function delete(string $url, array $options = []);

    /**
     * @param string $url
     * @param array $options
     *
     * @return mixed
     */
    public function put(string $url, array $options = []);

    /**
     * @param string $url
     * @param array $options
     *
     * @return mixed
     */
    public function patch(string $url, array $options = []);

    /**
     * @param string $url
     * @param array $options
     *
     * @return mixed
     */
    public function post(string $url, array $options = []);

    /**
     * @param string $url
     * @param array $options
     *
     * @return mixed
     */
    public function options(string $url, array $options = []);
}
