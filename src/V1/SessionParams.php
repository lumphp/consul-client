<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

/**
 * Class SessionParams
 *
 * @package Lum\ConsulClient\V1
 */
final class SessionParams
{
    private $uuid;
    private $lockDelay;
    private $name;
    private $node;
    private $behavior;
    private $checks;
    private $dc;
    private $ttl;

    /**
     * SessionParams constructor.
     *
     * @param string $uuid
     * @param string $name
     * @param string $node
     * @param array $options
     */
    public function __construct(string $uuid = '', string $name = '', string $node = '', array $options = [])
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->node = $node;
        $this->lockDelay = trim($options['lockDelay'] ?? '15s');
        $this->checks = $options['checks'] ?? [];
        $this->behavior = $options['behavior'] ?? 'release';
        $this->ttl = $options['ttl'] ?? '30s';
        $this->dc = trim($options['dc'] ?? '');
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        $params = [];
        if ($this->uuid) {
            $params['uuid'] = $this->uuid;
        }
        if ($this->dc) {
            $params['dc'] = $this->dc;
        }

        return array_filter(
            array_merge(
                $params,
                [
                    'Name' => $this->name,
                    'Node' => $this->node,
                    'LockDelay' => $this->lockDelay,
                    'Checks' => $this->checks,
                    'Behavior' => $this->behavior,
                    'TTL' => $this->ttl,
                ]
            )
        );
    }

    /**
     * @return string
     */
    public function toJson() : string
    {
        return json_encode($this->toArray());
    }
}