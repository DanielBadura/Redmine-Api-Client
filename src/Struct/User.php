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
    protected $id;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $login;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $firstname;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $lastname;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $mail;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $password;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    protected $auth_source_id;

    /**
     * @var Membership
     *
     * @JMS\Type("array<string, DanielBadura\Redmine\Api\Struct\Membership>")
     */
    protected $memberships;

    /**
     * @var Group
     *
     * @JMS\Type("array<string, DanielBadura\Redmine\Api\Struct\Group>")
     */
    protected $groups;

    /**
     * @return int
     */
    public function getAuthSourceId()
    {
        return $this->auth_source_id;
    }

    /**
     * @param int $auth_source_id
     */
    public function setAuthSourceId($auth_source_id)
    {
        $this->auth_source_id = $auth_source_id;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return Group
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param Group $groups
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return Membership
     */
    public function getMemberships()
    {
        return $this->memberships;
    }

    /**
     * @param Membership $memberships
     */
    public function setMemberships($memberships)
    {
        $this->memberships = $memberships;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
