<?php


namespace DanielBadura\Redmine\Api\Repository;


interface RepositoryInterface
{
    /**
     * Find one entity by Id
     *
     * @param $id
     *
     * @return mixed
     */
    public function find($id);

    /**
     * Find all entitys
     *
     * @return mixed
     */
    public function findAll();

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