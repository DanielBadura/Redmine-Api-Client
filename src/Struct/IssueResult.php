<?php

namespace DanielBadura\Redmine\Api\Struct;

use JMS\Serializer\Annotation as JMS;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class IssueResult 
{
    /**
     * @var Issue
     *
     * @JMS\Type("array<DanielBadura\Redmine\Api\Struct\Issue>")
     */
    public $issues;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    public $issueMaxCount;
} 