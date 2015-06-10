<?php

namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Client;
use DanielBadura\Redmine\Api\Exception\ClientException;
use DanielBadura\Redmine\Api\Exception\RedmineApiException;
use DanielBadura\Redmine\Api\Exception\RepositoryException;
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
     * @throws ClientException
     * @throws RedmineApiException
     * @throws RepositoryException
     * @return Project
     */
    public function find($id)
    {
        if ($id === null) {
            throw new RepositoryException("Can't find project. No id given!");
        }

        $result = $this->client->get('/projects/' . $id . '.json');

        return $this->deserialize($result);
    }

    /**
     * @return Project[]
     */
    public function findAll()
    {
        $projectResultReposiotry = new ProjectResultRepository($this->client);

        $projectResult = $projectResultReposiotry->find();

        return $projectResult->projects;
    }

    /**
     * @param Project $project
     *
     * @return bool|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface
     */
    public function save(Project $project)
    {
        $projectJson = $this->serialize(['project' => $project]);

        $options = ['body' => $projectJson];

        if ($project->id && $this->find($project->id)) {
            $result = $this->client->put('projects/' . $project->id . '.json', $options);
        } else {
            $result = $this->client->post('projects.json', $options);
        }

        if ($result) {
            return $result;
        }

        return false;
    }

    /**
     * @param Project $project
     *
     * @throws ClientException
     * @throws RepositoryException
     * @return bool
     */
    public function delete(Project $project)
    {
        try {
            $this->find($project->id);
        } catch (RepositoryException $e) {
            throw new RepositoryException("Couldn't delete project. No id given!", $e->getCode(), $e);
        }

        $options = [];

        $result = $this->client->delete('projects/' . $project->id . '.json', $options);

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
        // Need a better solution
        $json = json_decode($json, true);
        $json = json_encode($json['project']);

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