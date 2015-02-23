<?php


namespace DanielBadura\Redmine\Api\Struct;

use JMS\Serializer\Annotation as JMS;

class Issue 
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
    public $title;

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
     * @var Journal[]
     *
     * @JMS\Type("array<Journal>")
     */
    public $journals;
    
} 