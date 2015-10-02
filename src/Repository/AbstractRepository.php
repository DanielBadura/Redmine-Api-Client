<?php

namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Client;

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
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param object $object
     * @return string
     */
    protected function serialize($object)
    {
        return $this->client->serialize($object);
    }

    /**
     * @param string $json
     * @param string $type
     * @return object
     */
    protected function deserialize($json, $type)
    {
        return $this->client->deserialize($json, $type);
    }
}
