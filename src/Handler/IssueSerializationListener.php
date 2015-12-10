<?php


namespace DanielBadura\Redmine\Api\Handler;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;

class IssueSerializationListener implements EventSubscriberInterface
{
    /**
     * @inheritdoc
     */
    static public function getSubscribedEvents()
    {
        return array(
            array('event' => 'serializer.post_serialize', 'class' => 'DanielBadura\Redmine\Api\Struct\Issue', 'method' => 'onPostSerialize'),
        );
    }

    public function onPostSerialize(ObjectEvent $event)
    {
        dump($event);
    }
} 