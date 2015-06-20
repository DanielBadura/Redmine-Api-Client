<?php


namespace DanielBadura\Redmine\Api\Struct;

use JMS\Serializer\Annotation as JMS;

/**
 * @author Marco Giesen <marco.giesen93@gmail.com>
 */
class UserResult
{
    /**
     * @var User[]
     *
     * @JMS\Type("array<DanielBadura\Redmine\Api\Struct\User>")
     */
    public $users;

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
