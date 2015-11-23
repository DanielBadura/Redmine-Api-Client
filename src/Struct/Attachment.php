<?php

namespace DanielBadura\Redmine\Api\Struct;

use JMS\Serializer\Annotation as JMS;

/**
 * @author Marco Giesen <marco.giesen93@gmail.com>
 */
class Attachment
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
    public $filename;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     */
    public $filesize;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $contentType;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $description;

    /**
     * @var string
     *
     * @JMS\Type("string")
     */
    public $contentUrl;

    /**
     * @var User
     *
     * @JMS\Type("DanielBadura\Redmine\Api\Struct\User")
     */
    public $author;

    /**
     * @var \DateTime
     *
     * @JMS\Type("DateTime<'Y-m-d\TH:i:s.???Z'>")
     */
    public $createdOn;

}
