<?php

namespace DanielBadura\Redmine\Api\Repository;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
interface RepositoryInterface
{
    /**
     * Find one entity by Id
     *
     * @param int $id
     *
     * @return object
     */
    public function find($id);

    /**
     * Find all entitys
     *
     * @return object[]
     */
    public function findAll();
}
