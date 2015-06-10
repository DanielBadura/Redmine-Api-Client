<?php


namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Client;
use DanielBadura\Redmine\Api\Exception\RedmineApiException;
use DanielBadura\Redmine\Api\Struct\ProjectResult;

class ProjectResultRepository
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
     * @throws RedmineApiException
     *
     * @return ProjectResult
     */
    public function find()
    {
        $result = $this->client->get('projects.json');

        if (! $result) {
            throw new RedmineApiException('Could not find any Projects..');
        }

        return $this->deserialize($result);
    }

    /**
     * @param $json
     *
     * @return ProjectResult
     */
    public function deserialize($json)
    {
        return $this->client->getSerializer()->deserialize($json, 'DanielBadura\Redmine\Api\Struct\ProjectResult', 'json');
    }

    /**
     * @param ProjectResult $object
     *
     * @return string
     */
    public function serialize(ProjectResult $object)
    {
        return $this->client->getSerializer()->serialize($object, 'json');
    }
} 