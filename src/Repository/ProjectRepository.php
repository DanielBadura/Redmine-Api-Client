<?php

namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Client;
use DanielBadura\Redmine\Api\Struct\Project;

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
     * @param Project $project
     *
     * @return bool|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface
     */
    public function save(Project $project)
    {
        $projectJson = $this->serialize($project);

        $options = ['body' => $projectJson];

        if ($this->find($project->id)) {
            $result = $this->client->put('project/' . $project->id . '.json', $options);
        } else {
            $result = $this->client->post('project.json', $options);
        }

        if ($result) {
            return $result;
        }

        return false;
    }

    /**
     * @param Project $project
     *
     * @return bool
     */
    public function delete(Project $project)
    {
        if (! $this->find($project->id)) {
            return false;
        }

        $options = [];

        $result = $this->client->delete('project/' . $project->id . '.json', $options);

        if ($result) {
            return true;
        }

        return false;
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