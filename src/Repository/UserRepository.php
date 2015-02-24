<?php
/**
 * Created by PhpStorm.
 * User: marcogiesen
 * Date: 24.02.15
 * Time: 15:52
 */

namespace DanielBadura\Redmine\Api\Repository;


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

        $result = json_decode($result, true); //@TODO Make an IssueResult Struct, so I don't need to hack this with json decode
        $result = json_encode($result['issue']); //@TODO and json encode, this is not nice

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
     * Serialze an entity from a json to an object
     *
     * @param $json
     *
     * @return mixed
     */
    public function serialize($json)
    {
        // TODO: Implement serialize() method.
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
        // TODO: Implement deserialize() method.
    }
}