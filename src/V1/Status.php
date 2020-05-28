<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

/**
 * Interface Status
 *
 * @package Lum\ConsulClient\V1
 */
interface Status
{
    const SERVICE_NAME = 'status';

    /**
     * @return mixed
     */
    public function leader();

    /**
     * @return mixed
     */
    public function peers();
}