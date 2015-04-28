<?php

namespace DanielBadura\Redmine\Api\Repository;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
interface RepositoryInterface extends SerializerInterface
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
} 