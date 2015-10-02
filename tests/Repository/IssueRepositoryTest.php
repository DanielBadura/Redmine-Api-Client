<?php

namespace DanielBadura\Redmine\Api\Tests\Repository;

use DanielBadura\Redmine\Api\Tests\ClientTest;

class IssueRepositoryTest extends ClientTest
{
    public function testFindIssue()
    {
        $issue = $this->client->getIssueRepository()->find(10);

        dump($issue);
    }
}
