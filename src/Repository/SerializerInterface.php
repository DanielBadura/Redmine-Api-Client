<?php

namespace DanielBadura\Redmine\Api\Repository;

interface SerializerInterface 
{
    /**
     * Serialze an entity from a json to an object
     *
     * @param $json
     *
     * @return mixed
     */
    public function serialize($json);

    /**
     * Deserialize an object to a json string
     *
     * @param $object
     *
     * @return mixed
     */
    public function deserialize($object);
} 