<?php

namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Client;
use DanielBadura\Redmine\Api\Exception\RedmineApiException;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class IssueResultRepository
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
        $result = $this->client->get('issues.json');

        if (! $result) {
            throw new RedmineApiException('Could not find any issues..');
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
        return $this->client->getSerializer()->deserialize($json, 'DanielBadura\Redmine\Api\Struct\IssueResult', 'json');
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