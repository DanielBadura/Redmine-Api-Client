<?php


namespace DanielBadura\Redmine\Api\Struct;

use JMS\Serializer\Annotation as JMS;

class User 
{
    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    public $id;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $name;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $firstname;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $lastname;
} 