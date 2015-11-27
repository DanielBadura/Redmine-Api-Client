<?php

namespace DanielBadura\Redmine\Api\Hydration;

use DanielBadura\Redmine\Api\Client;
use DanielBadura\Redmine\Api\Struct\Issue;
use DanielBadura\Redmine\Api\Struct\Project;
use ProxyManager\Factory\LazyLoadingValueHolderFactory;
use ProxyManager\Proxy\LazyLoadingInterface;

/**
 * @author Marco Giesen <marco.giesen93@gmail.com>
 */
class IssueProjectHydration
{
    /**
     * @param Issue $issue
     * @param Client $client
     * @return Issue
     */
    public function hydrateOneIssue(Issue $issue, Client $client)
    {
        $project = $issue->getProject();
        $pR = $client->getProjectRepository();

        $factory = new LazyLoadingValueHolderFactory();
        $initializer = function (
            &$wrappedObject,
            LazyLoadingInterface $proxy,
            $method
        ) use ($project, $pR, $issue) {
            $wrappedObject = $issue;
            if('getProject' == $method) {
                $wrappedObject = $issue;
                $wrappedObject->setProject($pR->find($project->id));

                $proxy->setProxyInitializer(null);
            }

            return true;
        };
        //$issue->setProject($factory->createProxy('DanielBadura\Redmine\Api\Struct\Project', $initializer));
        $issue = $factory->createProxy('DanielBadura\Redmine\Api\Struct\Issue', $initializer);

        return $issue;
    }

    /**
     * @param $issues
     * @param Client $client
     * @return array
     */
    public function hydrateManyIssues($issues, Client $client)
    {
        $tempIssues = [];

        foreach ($issues as $issue) {
            $tempIssues[] = $this->hydrateOneIssue($issue, $client);
        }

        return $tempIssues;
    }
}
