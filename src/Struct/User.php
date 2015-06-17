<?php

namespace DanielBadura\Redmine\Api\Struct;

use JMS\Serializer\Annotation as JMS;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
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
    public $login;

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

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $mail;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $password;

    /**
     * @var DanielBadura\Redmine\Api\Struct\Membership
     *
     * @JMS\Type("array<string, DanielBadura\Redmine\Api\Struct\Membership>")
     */
    public $memberships;

    /**
     * @var DanielBadura\Redmine\Api\Struct\Group
     *
     * @JMS\Type("array<string, DanielBadura\Redmine\Api\Struct\Group>")
     */
    public $groups;
} 