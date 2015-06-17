<?php

namespace DanielBadura\Redmine\Api\Repository;

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
     *
     * @return mixed
     */
    public function find($id)
    {
        // TODO: Implement find() method.
        $result = $this->client->get('users/' . $id . '.json');

        $result = json_decode($result, true); //@TODO Make an UserResult Struct, so I don't need to hack this with json decode
        $result = json_encode($result['user']); //@TODO and json encode, this is not nice

        return $this->deserialize($result);
    }

    /**
     * Find all entitys
     *
     * @return mixed
     */
    public function findAll()
    {
        // TODO: Implement findAll() method.
        $result = $this->client->get('users.json');

        //@TODO same as at find()

        return $this->deserialize($result);
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

        return false;
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

        return false;
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
    public function deserialize($object)
    {
        return $this->client->getSerializer()->deserialize($object, 'DanielBadura\Redmine\Api\Struct\User', 'json');
    }
}