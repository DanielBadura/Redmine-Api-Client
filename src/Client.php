<?php

namespace DanielBadura\Redmine\Api;

use DanielBadura\Redmine\Api\Adapter\AdapterInterface;
use DanielBadura\Redmine\Api\Repository\IssueRepository;
use DanielBadura\Redmine\Api\Repository\ProjectRepository;
use DanielBadura\Redmine\Api\Repository\UserRepository;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 * @author David Badura <d.a.badura@gmail.com>
 */
class Client
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var string|null username for impersonating API calls
     */
    protected $impersonateUser = null;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter    = $adapter;
        $this->serializer = SerializerBuilder::create()->build();
    }

    /**
     * @return IssueRepository
     */
    public function getIssueRepository()
    {
        return new IssueRepository($this);
    }

    /**
     * @return ProjectRepository
     */
    public function getProjectRepository()
    {
        return new ProjectRepository($this);
    }

    /**
     * @return UserRepository
     */
    public function getUserRepository()
    {
        return new UserRepository($this);
    }

    /**
     * @param string $path
     * @param array $options
     * @return string
     */
    public function get($path, array $options = [])
    {
        return $this->adapter->get($path, $options);
    }

    /**
     * @param string $path
     * @param array $options
     * @return string
     */
    public function post($path, array $options = [])
    {
        return $this->adapter->post($path, $options);
    }

    /**
     * @param string $path
     * @param array $options
     * @return string
     */
    public function put($path, array $options = [])
    {
        return $this->adapter->put($path, $options);
    }

    /**
     * @param string $path
     * @param array $options
     * @return string
     */
    public function delete($path, array $options = [])
    {
        return $this->adapter->delete($path, $options);
    }

    /**
     * @param string $path
     * @param array $options
     * @return string
     */
    public function patch($path, array $options = [])
    {
        return $this->adapter->patch($path, $options);
    }

    /**
     * @return Serializer
     */
    public function getSerializer()
    {
        return $this->serializer;
    }
}
