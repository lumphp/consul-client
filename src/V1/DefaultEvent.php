<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

use Lum\ConsulClient\AbstractConsulService;
use Lum\ConsulClient\ConsulResponse;

/**
 * Class DefaultEvent
 *
 * @package Lum\ConsulClient\V1
 */
final class DefaultEvent extends AbstractConsulService implements Event
{
    /**
     * @param $name
     *
     * @return ConsulResponse
     */
    public function fire(string $name)
    {
        $options = [
            'body' => $name,
        ];

        return $this->client->put('/event/fire', $options);
    }

    /**
     * @return ConsulResponse
     */
    public function all()
    {
        return $this->client->get('/event/list');
    }
}