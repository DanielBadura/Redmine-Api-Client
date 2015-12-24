<?php

namespace DanielBadura\Redmine\Api\Tests\Repository;

use DanielBadura\Redmine\Api\Tests\ClientTest;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class UserRepositoryTest extends ClientTest
{
    public function testFindUser()
    {
        $user = $this->client->getUserRepository()->find(1);
        $this->assertEquals(1, $user->getId());
    }

    public function testFindAll()
    {
        $users = $this->client->getUserRepository()->findAll();

        $id = 1;

        foreach ($users as $user) {
            $this->assertEquals($id++, $user->getId());
        }
    }
} 