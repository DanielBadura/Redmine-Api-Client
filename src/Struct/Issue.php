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
    protected $id;

    /**
     * @var User
     *
     * @JMS\Type("User")
     */
    protected $author;

    /**
     * @var User
     *
     * @JMS\Type("User")
     */
    protected $assignedTo;

    /**
     * @var Status
     *
     * @JMS\Type("DanielBadura\Redmine\Api\Struct\Status")
     */
    protected $status;

    /**
     * @var Tracker
     *
     * @JMS\Type("DanielBadura\Redmine\Api\Struct\Tracker")
     */
    protected $tracker;

    /**
     * @var Priority
     *
     * @JMS\Type("DanielBadura\Redmine\Api\Struct\Priority")
     */
    protected $priority;

    /**
     * @var Project
     *
     * @JMS\Type("Project")
     */
    protected $project;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $subject;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $description;

    /**
     * @var \DateTime
     *
     * @JMS\Type("DateTime<'Y-m-d'>")
     */
    protected $startDate;

    /**
     * @var \DateTime
     *
     * @JMS\Type("DateTime<'Y-m-d'>")
     */
    protected $dueDate;

    /**
     * @var \DateTime
     *
     * @JMS\Type("DateTime<'Y-m-d\TH:i:s\Z'>")
     */
    protected $createdOn;

    /**
     * @var \DateTime
     *
     * @JMS\Type("DateTime<'Y-m-d\TH:i:s\Z'>")
     */
    protected $updatedOn;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    protected $doneRatio;

    /**
     * @var float
     *
     * @JMS\Type("float")
     */
    protected $estimatedHours;

    /**
     * @var CustomField[]
     *
     * @JMS\Type("array<DanielBadura\Redmine\Api\Struct\CustomField>")
     */
    protected $customFields;

    /**
     * @var Journal[]
     *
     * @JMS\Type("array<DanielBadura\Redmine\Api\Struct\Journal>")
     */
    protected $journals;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    protected $notes;

    /**
     * @return User
     */
    public function getAssignedTo()
    {
        return $this->assignedTo;
    }

    /**
     * @param User $assignedTo
     */
    public function setAssignedTo($assignedTo)
    {
        $this->assignedTo = $assignedTo;
    }

    /**
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
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
     * @return CustomField[]
     */
    public function getCustomFields()
    {
        return $this->customFields;
    }

    /**
     * @param CustomField[] $customFields
     */
    public function setCustomFields($customFields)
    {
        $this->customFields = $customFields;
    }

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
     * @return int
     */
    public function getDoneRatio()
    {
        return $this->doneRatio;
    }

    /**
     * @param int $doneRatio
     */
    public function setDoneRatio($doneRatio)
    {
        $this->doneRatio = $doneRatio;
    }

    /**
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTime $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @return float
     */
    public function getEstimatedHours()
    {
        return $this->estimatedHours;
    }

    /**
     * @param float $estimatedHours
     */
    public function setEstimatedHours($estimatedHours)
    {
        $this->estimatedHours = $estimatedHours;
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
     * @return Journal[]
     */
    public function getJournals()
    {
        return $this->journals;
    }

    /**
     * @param Journal[] $journals
     */
    public function setJournals($journals)
    {
        $this->journals = $journals;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return Priority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param Priority $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Status $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return Tracker
     */
    public function getTracker()
    {
        return $this->tracker;
    }

    /**
     * @param Tracker $tracker
     */
    public function setTracker($tracker)
    {
        $this->tracker = $tracker;
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
     * @param Project $project
     */
    public function setProject(Project $project)
    {
        $this->project = $project;
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
