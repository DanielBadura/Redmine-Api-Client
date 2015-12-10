<?php

namespace DanielBadura\Redmine\Api;

use DanielBadura\Redmine\Api\Adapter\AdapterInterface;
use DanielBadura\Redmine\Api\Handler\IssueHandler;
use DanielBadura\Redmine\Api\Repository\AttachmentRepository;
use DanielBadura\Redmine\Api\Repository\IssueRepository;
use DanielBadura\Redmine\Api\Repository\ProjectRepository;
use DanielBadura\Redmine\Api\Repository\UserRepository;
use DanielBadura\Redmine\Api\Struct\Issue;
use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\Handler\HandlerRegistry;
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
     * @var IdentityMapper
     */
    protected $mapper;

    /**
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        AnnotationRegistry::registerLoader('class_exists');

        $this->adapter    = $adapter;
        $this->mapper     = new IdentityMapper();
        $this->serializer = SerializerBuilder::create()
            ->configureHandlers(function (HandlerRegistry $registry) {
                $registry->registerSubscribingHandler(new IssueHandler($this));
            })
            ->build();
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
     * @return AttachmentRepository
     */
    public function getAttachmentRepository()
    {
        return new AttachmentRepository($this);
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function get($path, array $options = [])
    {
        return $this->adapter->get($path, $options);
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function post($path, array $options = [])
    {
        return $this->adapter->post($path, $options);
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function put($path, array $options = [])
    {
        return $this->adapter->put($path, $options);
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function delete($path, array $options = [])
    {
        return $this->adapter->delete($path, $options);
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function patch($path, array $options = [])
    {
        return $this->adapter->patch($path, $options);
    }

    /**
     * @param object $object
     *
     * @return string
     */
    public function serialize($object)
    {
        return $this->serializer->serialize($object, 'json');
    }

    /**
     * @param string $json
     * @param string $type
     *
     * @return object
     */
    public function deserialize($json, $type)
    {
        return $this->serializer->deserialize($json, $type, 'json');
    }

    /**
     * @return IdentityMapper
     */
    public function getMapper()
    {
        return $this->mapper;
    }
}
