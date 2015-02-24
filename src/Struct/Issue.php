<?php

namespace DanielBadura\Redmine\Api\Struct;

use JMS\Serializer\Annotation as JMS;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class Issue
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
     * @var User
     *
     * @JMS\Type("User")
     */
    public $assignedTo;

    /**
     * @var Status
     *
     * @JMS\Type("Status")
     */
    public $status;

    /**
     * @var Tracker
     *
     * @JMS\Type("Tracker")
     */
    public $tracker;

    /**
     * @var Priority
     *
     * @JMS\Type("Priority")
     */
    public $priority;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $subject;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $description;

    /**
     * @var \DateTime
     *
     * @JMS\Type("DateTime<'Y-m-d'>")
     */
    public $startDate;

    /**
     * @var \DateTime
     *
     * @JMS\Type("DateTime<'Y-m-d'>")
     */
    public $dueDate;

    /**
     * @var \DateTime
     *
     * @JMS\Type("DateTime<'Y-m-d\TH:i:s\Z'>")
     */
    public $createdOn;

    /**
     * @var \DateTime
     *
     * @JMS\Type("DateTime<'Y-m-d\TH:i:s\Z'>")
     */
    public $updatedOn;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    public $doneRatio;

    /**
     * @var float
     *
     * @JMS\Type("float")
     */
    public $estimatedHours;

    /**
     * @var CustomField[]
     *
     * @JMS\Type("array<CustomField>")
     */
    public $customsFields;

    /**
     * @var Journal[]
     *
     * @JMS\Type("array<Journal>")
     */
    public $journals;
} 