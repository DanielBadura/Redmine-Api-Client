<?php

namespace DanielBadura\Redmine\Api\Struct;

use JMS\Serializer\Annotation as JMS;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class Project
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
    protected $identifier;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $name;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $description;

    /**
     * @var \DateTime
     *
     * "DateTime<'D M j h:i:s O Y'>"
     *
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sO'>")
     */
    protected $createdOn;

    /**
     * @var \DateTime
     *Sat Sep 29 12:03:04 +0200 2007
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sO'>")
     */
    protected $updatedOn;

    /**
     * @var bool
     *
     * @JMS\Type("boolean")
     */
    protected $isPublic;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $homepage;

    /**
     * @var Project
     *
     * @JMS\Type("Project")
     */
    protected $parent_id;

    /**
     * @var bool
     *
     * @JMS\Type("boolean")
     */
    protected $inherit_members;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * @param \DateTime $updatedOn
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
    }

    /**
     * @return boolean
     */
    public function isPublic()
    {
        return $this->isPublic;
    }

    /**
     * @param boolean $isPublic
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;
    }

    /**
     * @return string
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * @param string $homepage
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
    }

    /**
     * @return Project
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param Project $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return boolean
     */
    public function isInheritMembers()
    {
        return $this->inherit_members;
    }

    /**
     * @param boolean $inherit_members
     */
    public function setInheritMembers($inherit_members)
    {
        $this->inherit_members = $inherit_members;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
