<?php

namespace DanielBadura\Redmine\Api\Handler;

use DanielBadura\Redmine\Api\Client;
use DanielBadura\Redmine\Api\Proxy\Project;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\VisitorInterface;
use ProxyManager\Factory\LazyLoadingValueHolderFactory;
use ProxyManager\Proxy\LazyLoadingInterface;

class IssueHandler implements SubscribingHandlerInterface
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

    public static function getSubscribingMethods()
    {
        $methods[] = [
            'type' => 'Project',
            'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
            'format' => 'json',
            'method' => 'deserializeProject'
        ];

        return $methods;
    }

    public function deserializeProject(VisitorInterface $visitor, $project, array $type, Context $context)
    {
        dump($project);

        if ($this->client->getMapper()->hasIdentity('project.' . $project['id'])) {
            return $this->client->getMapper()->getIdentity('project.' . $project['id']);
        }

        return $this->hydrate($project);
    }

    private function hydrate($project)
    {
        $projectRepository = $this->client->getProjectRepository();
        $factory           = new LazyLoadingValueHolderFactory();

        $initializer = function (
            &$wrappedObject,
            LazyLoadingInterface $proxy,
            $method
        ) use ($project, $projectRepository) {
            if ($method == 'getId' || $method == 'getName') {
                if (! $wrappedObject) {
                    $wrappedObject = new Project($project['id'], $project['name']);
                }
            } else {
                $wrappedObject = $projectRepository->find($project['id']);
                $proxy->setProxyInitializer(null);
                $this->client->getMapper()->setIdentity('project.' . $wrappedObject->getId(), $wrappedObject);
            }

            return true;
        };

        $project = $factory->createProxy('DanielBadura\Redmine\Api\Struct\Project', $initializer);

        dump($project);

        return $project;
    }
} 