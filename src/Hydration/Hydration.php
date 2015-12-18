<?php

namespace DanielBadura\Redmine\Api\Hydration;

use DanielBadura\Redmine\Api\Client;
use DanielBadura\Redmine\Api\Proxy\Project;
use DanielBadura\Redmine\Api\Proxy\User;
use DanielBadura\Redmine\Api\Repository\AbstractRepository;
use ProxyManager\Factory\LazyLoadingValueHolderFactory;
use ProxyManager\Proxy\LazyLoadingInterface;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class Hydration
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
     * @param array $project
     *
     * @return \DanielBadura\Redmine\Api\Struct\Project|\ProxyManager\Proxy\VirtualProxyInterface
     */
    public function project(array $project)
    {
        $projectRepository = $this->client->getProjectRepository();

        $projectStruct = $this->getIdentity($project, $projectRepository);

        if ($projectStruct !== null) {
            return $projectStruct;
        }

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
                $projectRepository->getMapper()->setIdentity($wrappedObject->getId(), $wrappedObject);
            }

            return true;
        };

        $project = $factory->createProxy('DanielBadura\Redmine\Api\Struct\Project', $initializer);

        return $project;
    }

    /**
     * @param array $user
     *
     * @return \DanielBadura\Redmine\Api\Struct\User|\ProxyManager\Proxy\VirtualProxyInterface
     */
    public function user(array $user)
    {
        $userRepository = $this->client->getUserRepository();

        $userStruct = $this->getIdentity($user, $userRepository);

        if ($userStruct !== null) {
            return $userStruct;
        }

        $factory           = new LazyLoadingValueHolderFactory();

        $initializer = function (
            &$wrappedObject,
            LazyLoadingInterface $proxy,
            $method
        ) use ($user, $userRepository) {
            if ($method == 'getId' || $method == 'getName') {
                if (! $wrappedObject) {
                    $wrappedObject = new User($user['id'], $user['name']);
                }
            } else {
                $wrappedObject = $userRepository->find($user['id']);
                $proxy->setProxyInitializer(null);
                $userRepository->getMapper()->setIdentity($wrappedObject->getId(), $wrappedObject);
            }

            return true;
        };

        $user = $factory->createProxy('DanielBadura\Redmine\Api\Struct\User', $initializer);

        return $user;
    }

    /**
     * @param array              $data
     * @param AbstractRepository $repo
     *
     * @return mixed|null
     */
    private function getIdentity(array $data, AbstractRepository $repo)
    {
        if ($repo->getMapper()->hasIdentity($data['id'])) {
            return $repo->getMapper()->getIdentity($data['id']);
        }

        return null;
    }
} 