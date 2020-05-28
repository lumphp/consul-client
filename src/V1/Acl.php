<?php
declare(strict_types=1);
namespace Lum\ConsulClient\V1;

/**
 * Interface Acl
 *
 * @package Lum\ConsulClient\V1
 */
interface Acl
{
    const SERVICE_NAME = 'acl';

    /**
     * Creates a new token with policy
     *
     * @return mixed
     */
    public function create();

    /**
     * Update the policy of a token
     *
     * @return mixed
     */
    public function update();

    /**
     * Destroys a given token
     *
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id);

    /**
     * Queries the policy of a given token
     *
     * @param $id
     *
     * @return mixed
     */
    public function info($id);

    /**
     * Creates a new token by cloning an existing token
     *
     * @param $id
     *
     * @return mixed
     */
    public function cloneId($id);

    /**
     * Lists all the active tokens
     *
     * @return mixed
     */
    public function all();
}