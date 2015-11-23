<?php


namespace DanielBadura\Redmine\Api\Struct;

use JMS\Serializer\Annotation as JMS;

/**
 * @author Marco Giesen <marco.giesen93@gmail.com>
 */
class AttachmentResult
{
    /**
     * @var Attachment[]
     *
     * @JMS\Type("array<DanielBadura\Redmine\Api\Struct\Attachment>")
     */
    public $attachments;
} 
