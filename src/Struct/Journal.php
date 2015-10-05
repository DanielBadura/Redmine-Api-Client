<?php

namespace DanielBadura\Redmine\Api\Struct;

use JMS\Serializer\Annotation as JMS;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class Journal 
{
    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    public $id;

    /**
     * @var User
     *
     * @JMS\Type("User")
     */
    public $author;

    /**
     * @var Detail[]
     *
     * @JMS\Type("array<Detail>")
     */
    public $details;

} 