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
    public $name;

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
    public $description;

    /**
     * @var \DateTime
     *
     * @JMS\Type("DateTime<'D M j h:i:s O Y'>")
     */
    public $createdOn;

    /**
     * @var \DateTime
     *Sat Sep 29 12:03:04 +0200 2007
     * @JMS\Type("DateTime<'D M j h:i:s O Y'>")
     */
    public $updatedOn;

    /**
     * @var bool
     *
     * @JMS\Type("bool")
     */
    public $isPublic;
} 