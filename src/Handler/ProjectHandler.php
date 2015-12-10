<?php

namespace DanielBadura\Redmine\Api\Handler;

use DanielBadura\Redmine\Api\Struct\Project;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\VisitorInterface;

class ProjectHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        $methods[] = [
            'type' => 'Project',
            'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
            'format' => 'json',
        ];

        $methods[] = [
            'type' => 'Project',
            'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
            'format' => 'json'
        ];

        return $methods;
    }

    public function serializeProject(VisitorInterface $visitor, Project $project, array $type)
    {

    }
} 