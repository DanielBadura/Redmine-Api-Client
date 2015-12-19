<?php

namespace DanielBadura\Redmine\Api\Tests\Repository;

use DanielBadura\Redmine\Api\Tests\ClientTest;
use ProxyManager\Proxy\LazyLoadingInterface;

class IssueRepositoryTest extends ClientTest
{
    public function testFindIssue()
    {
        $issue = $this->client->getIssueRepository()->find(1);

        $this->assertEquals(1, $issue->getId());
    }

    public function testProjectLazyLoad()
    {
        $issue   = $this->client->getIssueRepository()->find(1);
        $project = $issue->getProject();
        $id      = $project->getId();

        $this->assertEquals(1, $id);
        $this->assertTrue($project instanceof LazyLoadingInterface);
        $this->assertTrue($project->getProxyInitializer() instanceof \Closure);

        $name = $project->getName();
        $this->assertEquals("Test", $name);
        $this->assertTrue($project->getProxyInitializer() instanceof \Closure);

        $id = $project->getIdentifier();
        $this->assertEquals('test', $id);;
        $this->assertTrue($project->getProxyInitializer() === null);
    }

    public function testUserLazyLoad()
    {
        $issue = $this->client->getIssueRepository()->find(1);
        $user  = $issue->getAuthor();
        $id    = $user->getId();

        $this->assertEquals(1, $id);
        $this->assertTrue($user instanceof LazyLoadingInterface);
        $this->assertTrue($user->getProxyInitializer() instanceof \Closure);;


        $name = $user->getName();
        $this->assertEquals("Redmine Admin", $name);
        $this->assertTrue($user instanceof LazyLoadingInterface);
        $this->assertTrue($user->getProxyInitializer() instanceof \Closure);

        $login = $user->getLogin();
        $this->assertEquals("admin", $login);
        $this->assertTrue($user->getProxyInitializer() === null);
    }
}
