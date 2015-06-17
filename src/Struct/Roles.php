<?php

namespace DanielBadura\Redmine\Api\Struct;

/**
 * @author Marco Giesen <marco.giesen93@gmail.com>
 */
class Roles
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
}