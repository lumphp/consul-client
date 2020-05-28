<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

/**
 * Interface Health
 *
 * @package Lum\ConsulClient\V1
 */
interface Health
{
    const SERVICE_NAME = 'health';

    /**
     * @param string $node
     * @param array $options
     *
     * @return mixed
     */
    public function node(string $node, array $options = []);

    /**
     * @param string $service
     * @param array $options
     *
     * @return mixed
     */
    public function checks(string $service, array $options = []);

    /**
     * @param string $service
     * @param array $options
     *
     * @return mixed
     */
    public function service(string $service, array $options = []);

    /**
     * @param string $state
     * @param array $options
     *
     * @return mixed
     */
    public function state(string $state, array $options = []);
}
