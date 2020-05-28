<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

/**
 * Interface Agent
 *
 * @package Lum\ConsulClient\V1
 */
interface Agent
{
    const SERVICE_NAME = 'agent';

    /**
     * @return mixed
     */
    public function checks();

    /**
     * @param $checkId
     *
     * @return mixed
     */
    public function deregisterCheck(string $checkId);

    /**
     * @param string $name
     * @param array $check
     *
     * @return mixed
     */
    public function registerCheck(string $name, array $check);

    /**
     * @param array $options
     *
     * @return mixed
     */
    public function members(array $options = []);

    /**
     * @return mixed
     */
    public function self();

    /**
     * @param string $address
     * @param array $options
     *
     * @return mixed
     */
    public function join(string $address, array $options = []);

    /**
     * @param $node
     *
     * @return mixed
     */
    public function forceLeave(string $node);

    /**
     * @param string $checkId
     * @param string $type
     * @param array $options
     *
     * @return mixed
     */
    public function checkByType(string $checkId, string $type, array $options = []);

    /**
     * @param $serviceId
     *
     * @return mixed
     */
    public function deregisterService(string $serviceId);

    /**
     * @param string $name
     * @param $service
     *
     * @return mixed
     */
    public function registerService(string $name, array $service);

    /**
     * @return mixed
     */
    public function services();
}
