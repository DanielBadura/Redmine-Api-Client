<?php

namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Client;
use DanielBadura\Redmine\Api\Exception\RedmineApiException;

/**
 * @author Marco Giesen <marco.giesen93@gmail.com>
 */
class UserResultRepository implements ResultRepositoryInterface
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
     * @throws RedmineApiException
     *
     * @return IssueResult
     */
    public function find()
    {
        $result = $this->client->get('users.json');

        if(! $result) {
            throw new RedmineApiException('Could not find any users.');
        }

        return $this->deserialize($result);
    }

    /**
     * @param $json
     *
     * @return IssueResult|IssueResult[]
     */
    public function deserialize($json)
    {
        return $this->client->getSerializer()->deserialize($json, 'DanielBadura\Redmine\Api\Struct\UserResult', 'json');
    }

    /**
     * @param IssueResult $object
     *
     * @return string
     */
    public function serialize($object)
    {
        return $this->client->getSerializer()->serialize($object, 'json');
    }
}
