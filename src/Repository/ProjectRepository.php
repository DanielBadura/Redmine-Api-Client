<?php

namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Exception\ClientException;
use DanielBadura\Redmine\Api\Exception\RedmineApiException;
use DanielBadura\Redmine\Api\Exception\RepositoryException;
use DanielBadura\Redmine\Api\Struct\Project;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class ProjectRepository extends AbstractRepository
{
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

        $result = json_decode($result, true);
        $result = json_encode($result['project']);

        return $this->deserialize($result, 'DanielBadura\Redmine\Api\Struct\Project');
    }

    /**
     * @return Project[]
     * @throws RedmineApiException
     */
    public function findAll()
    {
        $result = $this->client->get('projects.json');

        if (!$result) {
            throw new RedmineApiException('Could not find any Projects..');
        }

        return $this->deserialize($result, 'DanielBadura\Redmine\Api\Struct\ProjectResult')->projects;
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

        if ($project->getId() && $this->find($project->getId())) {
            $result = $this->client->put('projects/' . $project->getId() . '.json', $options);
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
            $this->find($project->getId());
        } catch (RepositoryException $e) {
            throw new RepositoryException("Couldn't delete project. No id given!", $e->getCode(), $e);
        }

        $options = [];

        $result = $this->client->delete('projects/' . $project->getId() . '.json', $options);

        if ($result) {
            return true;
        }

        return false;
    }
}
