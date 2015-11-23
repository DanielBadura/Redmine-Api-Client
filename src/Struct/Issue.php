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
     * @JMS\Type("DanielBadura\Redmine\Api\Struct\User")
     */
    public $author;

    /**
     * @var User
     *
     * @JMS\Type("DanielBadura\Redmine\Api\Struct\User")
     */
    public $assignedTo;

    /**
     * @var Status
     *
     * @JMS\Type("DanielBadura\Redmine\Api\Struct\Status")
     */
    public $status;

    /**
     * @var Tracker
     *
     * @JMS\Type("DanielBadura\Redmine\Api\Struct\Tracker")
     */
    public $tracker;

    /**
     * @var Priority
     *
     * @JMS\Type("DanielBadura\Redmine\Api\Struct\Priority")
     */
    public $priority;

    /**
     * @var Project
     *
     * @JMS\Type("DanielBadura\Redmine\Api\Struct\Project")
     */
    public $project;

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
     * @JMS\Type("array<DanielBadura\Redmine\Api\Struct\CustomField>")
     */
    public $customFields;

    /**
     * @var Journal[]
     *
     * @JMS\Type("array<DanielBadura\Redmine\Api\Struct\Journal>")
     */
    public $journals;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $notes;
}
