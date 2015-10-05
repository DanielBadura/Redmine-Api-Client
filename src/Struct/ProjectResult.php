<?php


namespace DanielBadura\Redmine\Api\Struct;

use JMS\Serializer\Annotation as JMS;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class ProjectResult 
{
    /**
     * @var Project[]
     *
     * @JMS\Type("array<DanielBadura\Redmine\Api\Struct\Project>")
     */
    public $projects;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    public $total_count;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    public $offset;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    public $limit;
} 