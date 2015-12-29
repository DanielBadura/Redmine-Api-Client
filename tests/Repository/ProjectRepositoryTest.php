<?php


namespace DanielBadura\Redmine\Api\Tests\Repository;

use DanielBadura\Redmine\Api\Tests\ClientTest;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class ProjectRepositoryTest extends ClientTest
{
    public function testFindProject()
    {
        $project = $this->client->getProjectRepository()->find(1);

        $this->assertEquals(1, $project->getId());
    }

    public function testFindAll()
    {
        $projects = $this->client->getProjectRepository()->findAll();

        $id = count($projects);

        foreach ($projects as $project) {
            $this->assertEquals($id--, $project->getId());
        }
    }
} 