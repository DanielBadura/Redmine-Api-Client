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
    public $id;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $identifier;

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
    public $description;

    /**
     * @var \DateTime
     *
     * "DateTime<'D M j h:i:s O Y'>"
     *
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sO'>")
     */
    public $createdOn;

    /**
     * @var \DateTime
     *Sat Sep 29 12:03:04 +0200 2007
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sO'>")
     */
    public $updatedOn;

    /**
     * @var bool
     *
     * @JMS\Type("boolean")
     */
    public $isPublic;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $homepage;

    /**
     * @var Project
     *
     * @JMS\Type("Project")
     */
    public $parent_id;

    /**
     * @var bool
     *
     * @JMS\Type("boolean")
     */
    public $inherit_members;
}