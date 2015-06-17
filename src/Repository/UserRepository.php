<?php

namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Struct\User;
use DanielBadura\Redmine\Api\Exception\RedmineApiException;
use DanielBadura\Redmine\Api\Struct\UserResult;
use DanielBadura\Redmine\Api\Client;

/**
 * @author Marco Giesen <marco.giesen93@gmail.com>
 */
class UserRepository implements RepositoryInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Find one entity by Id
     *
     * @param $id
     * @return User
     * @throws RedmineApiException
     */
    public function find($id)
    {
        $result = $this->client->get('users/' . $id . '.json');

        if(! $result) {
            throw new RedmineApiException('Could not find the User');
        }
        dump($result);
        return $this->deserialize($result);
    }

    /**
     * Find all entitys
     *
     * @return User[]
     */
    public function findAll()
    {
        $userResultRepository = new UserResultRepository($this->client);

        /* @var UserResult $userResult */
        $userResult = $userResultRepository->find();

        return $userResult->users;
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function save(User $user)
    {
        $jsonUser = $this->serialize($user);

        $options = ['body' => $jsonUser];

        if($this->find($user->id)) {
            $result = $this->client->put('user/' . $user->id . '.json', $options);
        } else {
            $result = $this->client->post('user.json', $options);
        }

        if($result) {
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
        if(! $this->find($user->id)) {
            return false;
        }

        $options = [];

        $result = $this->client->delete('user/' . $user->id . '.json', $options);

        if($result) {
            return true;
        }

        return null;
    }

    /**
     * Serialze an entity from a json to an object
     *
     * @param $json
     *
     * @return mixed
     */
    public function serialize($json)
    {
        return $this->client->getSerializer()->serialize($json, 'DanielBadura\Redmine\Api\Struct\User', 'json');
    }

    /**
     * Deserialize an object to a json string
     *
     * @param $object
     *
     * @return mixed
     */
    public function deserialize($json)
    {
        // Need a better solution
        $json = json_decode($json, true);
        $json = json_encode($json['user']);

        return $this->client->getSerializer()->deserialize($json, 'DanielBadura\Redmine\Api\Struct\User', 'json');
    }
}