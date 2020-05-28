<?php
declare(strict_types=1);
namespace Lum\ConsulClient;

/**
 * Class AbstractConsulService
 *
 * @package Lum\ConsulClient
 */
abstract class AbstractConsulService
{
    /**
     * @var ConsulClient|null $client
     */
    protected $client;

    /**
     * AbstractConsulService constructor.
     *
     * @param ConsulClient|null $client
     */
    public function __construct(?ConsulClient $client = null)
    {
        $this->client = $client ? $client : new ConsulClient;
    }
}