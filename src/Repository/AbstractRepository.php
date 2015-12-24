<?php

namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Client;
use DanielBadura\Redmine\Api\IdentityMap;

/**
 * @author David Badura <badura@simplethings.de>
 */
abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var IdentityMap
     */
    protected $map;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->map = new IdentityMap();
    }

    /**
     * @return IdentityMap
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param object $object
     *
     * @return string
     */
    protected function serialize($object)
    {
        return $this->client->serialize($object);
    }

    /**
     * @param string $json
     * @param string $type
     *
     * @return object
     */
    protected function deserialize($json, $type)
    {
        return $this->client->deserialize($json, $type);
    }
}
