<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

/**
 * Interface Event
 *
 * @package Lum\ConsulClient\V1
 */
interface Event
{
    const SERVICE_NAME = 'event';

    /**
     * @param $name
     *
     * @return mixed
     */
    public function fire(string $name);

    /**
     * @return mixed
     */
    public function all();
}