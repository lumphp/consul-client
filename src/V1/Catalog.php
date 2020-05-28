<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

/**
 * Interface Catalog
 *
 * @package Lum\ConsulClient\V1
 */
interface Catalog
{
    const SERVICE_NAME = 'catalog';

    /**
     * @param string $node
     *
     * @return mixed
     */
    public function register(string $node);

    /**
     * @param string $node
     *
     * @return mixed
     */
    public function deregister(string $node);

    /**
     * @return mixed
     */
    public function dataCenters();

    /**
     * @param array $options
     *
     * @return mixed
     */
    public function nodes(array $options = []);

    /**
     * @param string $node
     * @param array $options
     *
     * @return mixed
     */
    public function node(string $node, array $options = []);

    /**
     * @param array $options
     *
     * @return mixed
     */
    public function services(array $options = []);

    /**
     * @param string $service
     * @param array $options
     *
     * @return mixed
     */
    public function service(string $service, array $options = []);
}
