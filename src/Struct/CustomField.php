<?php

namespace Struct;

use JMS\Serializer\Annotation as JMS;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class CustomField 
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
    public $value;

    /**
     * @var bool
     *
     * @JMS\Type("bool")
     */
    public $multiple;
} 