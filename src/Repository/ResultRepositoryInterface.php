<?php


namespace DanielBadura\Redmine\Api\Repository;


interface ResultRepositoryInterface extends SerializerInterface
{
    /**
     * Find one entity by Id
     *
     * @return mixed
     */
    public function find();
} 