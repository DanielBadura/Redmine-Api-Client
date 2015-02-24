<?php


namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Client;
use DanielBadura\Redmine\Api\Struct\Issue;
use DanielBadura\Redmine\Api\Struct\User;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class IssueRepository implements RepositoryInterface
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
     * @param $id
     *
     * @return Issue
     */
    public function find($id)
    {
        $result = $this->client->get('issue/' . $id . '.json');

        $result = json_decode($result, true); //@TODO Make an IssueResult Struct, so I don't need to hack this with json decode
        $result = json_encode($result['issue']); //@TODO and json encode, this is not nice

        return $this->deserialize($result);
    }

    /**
     * @return Issue[]
     */
    public function findAll()
    {
        $result = $this->client->get('issue.json');

        //@TODO same as at find()

        return $this->deserialize($result);
    }

    /**
     * @param Issue $issue
     *
     * @return bool|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface
     */
    public function save(Issue $issue)
    {
        $jsonIssue = $this->serialize($issue);

        $options = ['body' => $jsonIssue];

        if ($this->find($issue->id)) {
            $result = $this->client->put('issue/' . $issue->id . '.json', $options);
        } else {
            $result = $this->client->post('issue.json', $options);
        }

        if ($result) {
            return $result;
        }

        return false;
    }

    /**
     * @param Issue $issue
     *
     * @return bool
     */
    public function delete(Issue $issue)
    {
        if (! $this->find($issue->id)) {
            return false;
        }

        $options = [];

        $result = $this->client->delete('issue/' . $issue->id . '.json', $options);

        if ($result) {
            return true;
        }

        return false;
    }

    /**
     * @param Issue $issue
     * @param User  $user
     *
     * @return bool
     */
    public function addWatcher(Issue $issue, User $user)
    {
        if (! $this->find($issue->id)) {
            return false;
        }

        $userResult = $this->client->get('/user/' . $user->id . '.json', []);   //@TODO Maybe use later the UserRepository for this

        if (! $userResult) {
            return false;
        }

        $body = [
            'user_id' => $user->id
        ];

        $body = json_encode($body); // Don't know if serialiazation would be overkill or if this right now does just fine


        $options = [
            'body' => $body
        ];

        $result = $this->client->post('/issue/' . $issue->id . '/watchers.json', $options);

        if (! $result) {
            return false;
        }

        return true;
    }

    /**
     * @param Issue $issue
     * @param User  $user
     *
     * @return bool
     */
    public function deleteWatcher(Issue $issue, User $user)
    {
        if (! $this->find($issue->id)) {
            return false;
        }

        $userResult = $this->client->get('/user/' . $user->id . '.json', []);

        if (! $userResult) {
            return false;
        }

        $result = $this->client->delete('/issue/' . $issue->id . '/watchers/' . $user->id . '.json');

        if (! $result) {
            return false;
        }

        return true;
    }

    /**
     * @param $json
     *
     * @return Issue|Issue[]
     */
    public function deserialize($json)
    {
        return $this->client->getSerializer()->deserialize($json, 'DanielBadura\Redmine\Api\Struct\Issue', 'json');
    }

    /**
     * @param $object
     *
     * @return string
     */
    public function serialize($object)
    {
        return $this->client->getSerializer()->serialize($object, 'json');
    }
} 