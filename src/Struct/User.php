<?php

namespace DanielBadura\Redmine\Api\Struct;

use JMS\Serializer\Annotation as JMS;

/**
 * @author Marco Giesen <marco.giesen93@gmail.com>
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
     * @var int
     *
     * @JMS\Type("integer")
     */
    public $auth_source_id;

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
