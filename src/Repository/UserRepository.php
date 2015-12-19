<?php

namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Exception\RedmineApiException;
use DanielBadura\Redmine\Api\Struct\User;

/**
 * @author Marco Giesen <marco.giesen93@gmail.com>
 */
class UserRepository extends AbstractRepository
{
    /**
     * Find one entity by Id
     *
     * @param $id
     *
     * @return User
     * @throws RedmineApiException
     */
    public function find($id)
    {
        $result = $this->client->get('users/' . $id . '.json');

        if (! $result) {
            throw new RedmineApiException('Could not find the User');
        }

        $result = json_decode($result, true);
        $result = json_encode($result['user']);

        return $this->deserialize($result, 'DanielBadura\Redmine\Api\Struct\User');
    }

    /**
     * Find all entitys
     *
     * @return User[]
     * @throws RedmineApiException
     */
    public function findAll()
    {
        $result = $this->client->get('users.json');

        if (! $result) {
            throw new RedmineApiException('Could not find any users.');
        }

        return $this->deserialize($result, 'DanielBadura\Redmine\Api\Struct\UserResult')->users;
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function save(User $user)
    {
        // Need a better solution
        $jsonUser = $this->serialize(['user' => $user]);

        $options = ['body' => $jsonUser];

        if ($user->getId() != null && $this->find($user->getId())) {
            $result = $this->client->put('users/' . $user->getId() . '.json', $options);
        } else {
            $result = $this->client->post('users.json', $options);
        }

        if ($result) {
            return $result;
        }

        return null;
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function delete(User $user)
    {
        if (! $this->find($user->getId())) {
            return false;
        }

        $options = [];

        $result = $this->client->delete('user/' . $user->getId() . '.json', $options);

        if ($result) {
            return true;
        }

        return null;
    }
}
