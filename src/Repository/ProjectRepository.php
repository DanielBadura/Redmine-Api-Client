<?php

namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Client;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class ProjectRepository implements RepositoryInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $id
     *
     * @return Project
     */
    public function find($id)
    {
        $result = $this->client->get('/projects/' . $id . '.json');

        return $this->deserialize($result);
    }

    /**
     * @return Project[]
     */
    public function findAll()
    {
        $result = $this->client->get('/projects.json');

        return $this->deserialize($result);
    }

    /**
     * @param $json
     *
     * @return Project|Project[]
     */
    public function deserialize($json)
    {
        return $this->client->getSerializer()->deserialize($json, 'DanielBadura\Redmine\Api\Struct\Project', 'json');
    }

    /**
     * @param $object
     *
     * @return string
     */
    public function serialize($object)
    {
        return $this->client->getSerializer()->serialize($object, 'json');
    }
}