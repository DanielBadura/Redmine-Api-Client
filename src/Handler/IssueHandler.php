<?php

namespace DanielBadura\Redmine\Api\Handler;

use DanielBadura\Redmine\Api\Client;
use DanielBadura\Redmine\Api\Hydration\Hydration;
use DanielBadura\Redmine\Api\Proxy\Project;
use DanielBadura\Redmine\Api\Proxy\User;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\VisitorInterface;
use ProxyManager\Factory\LazyLoadingValueHolderFactory;
use ProxyManager\Proxy\LazyLoadingInterface;

class IssueHandler implements SubscribingHandlerInterface
{
    /**
     * @var Hydration
     */
    private $hydration;

    /**
     * @param Hydration $hydration
     */
    public function __construct(Hydration $hydration)
    {
        $this->hydration = $hydration;
    }

    public static function getSubscribingMethods()
    {
        $methods[] = [
            'type' => 'Project',
            'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
            'format' => 'json',
            'method' => 'deserializeProject'
        ];

        $methods[] = [
            'type' => 'User',
            'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
            'format' => 'json',
            'method' => 'deserializeUser'
        ];

        return $methods;
    }

    public function deserializeProject(VisitorInterface $visitor, $project, array $type, Context $context)
    {
        return $this->hydration->project($project);
    }

    public function deserializeUser(VisitorInterface $visitor, $user, array $type, Context $context)
    {
        return $this->hydration->user($user);
    }
}
