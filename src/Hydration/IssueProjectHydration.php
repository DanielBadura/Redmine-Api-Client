<?php

namespace DanielBadura\Redmine\Api\Hydration;

use DanielBadura\Redmine\Api\Client;
use DanielBadura\Redmine\Api\Struct\Issue;
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
    public function hydrateIssue(Issue $issue, Client $client)
    {
        $project = $issue->getProject();
        $projectRepository = $client->getProjectRepository();

        $factory = new LazyLoadingValueHolderFactory();
        $initializer = function (
            &$wrappedObject,
            LazyLoadingInterface $proxy,
            $method
        ) use ($project, $projectRepository) {
            if($method == "getIdentifier" ||
                $method == "getDescription" ||
                $method == "getCreatedOn" ||
                $method == "getUpdatedOn" ||
                $method == "isPublic" ||
                $method == "getParentId" ||
                $method == "isInheritMembers" ||
                $method == "getHomepage"
            ) {
                if(! $wrappedObject) {
                    $wrappedObject = $projectRepository->find($project->getId());
                    $proxy->setProxyInitializer(null);
                }
            } else {
                $wrappedObject = $project;
            }

            return true;
        };
        $issue->project = $factory->createProxy('DanielBadura\Redmine\Api\Struct\Project', $initializer);

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
            $tempIssues[] = $this->hydrateIssue($issue, $client);
        }

        return $tempIssues;
    }
}
