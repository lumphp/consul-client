<?php
namespace Lum\ConsulClient;

use Lum\ConsulClient\V1\Acl;
use Lum\ConsulClient\V1\Agent;
use Lum\ConsulClient\V1\Catalog;
use Lum\ConsulClient\V1\DefaultAcl;
use Lum\ConsulClient\V1\DefaultAgent;
use Lum\ConsulClient\V1\DefaultCatalog;
use Lum\ConsulClient\V1\DefaultEvent;
use Lum\ConsulClient\V1\DefaultHealth;
use Lum\ConsulClient\V1\DefaultKV;
use Lum\ConsulClient\V1\DefaultSession;
use Lum\ConsulClient\V1\DefaultStatus;
use Lum\ConsulClient\V1\Event;
use Lum\ConsulClient\V1\Health;
use Lum\ConsulClient\V1\KV;
use Lum\ConsulClient\V1\Session;
use Lum\ConsulClient\V1\Status;
use Lum\HttpClient\DefaultClient as GuzzleClient;
use Lum\HttpClient\Exceptions\InvalidArgumentException;
use Psr\Log\LoggerInterface;

/**
 * Class Consul
 *
 * @package Lum\ConsulClient
 */
final class Consul
{
    private static $services = [
        Acl::class => DefaultAcl::class,
        Agent::class => DefaultAgent::class,
        Catalog::class => DefaultCatalog::class,
        Event::class => DefaultEvent::class,
        Health::class => DefaultHealth::class,
        Session::class => DefaultSession::class,
        KV::class => DefaultKV::class,
        Status::class => DefaultStatus::class,
        Acl::SERVICE_NAME => DefaultAcl::class,
        Agent::SERVICE_NAME => DefaultAgent::class,
        Catalog::SERVICE_NAME => DefaultCatalog::class,
        Event::SERVICE_NAME => DefaultEvent::class,
        Health::SERVICE_NAME => DefaultHealth::class,
        Session::SERVICE_NAME => DefaultSession::class,
        KV::SERVICE_NAME => DefaultKV::class,
        Status::SERVICE_NAME => DefaultStatus::class,
    ];
    /**
     * @var ConsulClient $client
     */
    private $client;
    /**
     * @var Consul|null $instance
     */
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @param string $baseUri
     * @param array $options
     * @param LoggerInterface|null $logger
     * @param GuzzleClient|null $guzzleClient
     *
     * @return Consul|null
     */
    public static function getInstance(
        string $baseUri = '',
        array $options = [],
        LoggerInterface $logger = null,
        GuzzleClient $guzzleClient = null
    ) {
        if (is_null(static::$instance) || !isset(static::$instance)) {
            static::$instance = new Consul;
            static::$instance->client = new ConsulClient($baseUri, $guzzleClient, $options, $logger);
        }

        return self::$instance;
    }

    /**
     * @param string $service
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function useService(string $service)
    {
        if (!array_key_exists(strtolower($service), self::$services)) {
            throw new InvalidArgumentException(
                sprintf(
                    'The service "%s" is not available. Pick one among "%s".',
                    $service,
                    implode('", "', array_keys(self::$services))
                )
            );
        }
        $class = self::$services[$service];

        return new $class($this->client);
    }
}
