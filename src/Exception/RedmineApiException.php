<?php


namespace DanielBadura\Redmine\Api\Exception;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class RedmineApiException extends \Exception
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}