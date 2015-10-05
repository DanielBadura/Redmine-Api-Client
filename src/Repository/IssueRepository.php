<?php

namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Exception\RedmineApiException;
use DanielBadura\Redmine\Api\Struct\Issue;
use DanielBadura\Redmine\Api\Struct\User;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class IssueRepository extends AbstractRepository
{
    /**
     * @param int $id
     *
     * @throws RedmineApiException
     *
     * @return Issue
     */
    public function find($id)
    {
        $result = $this->client->get('issues/' . $id . '.json?include=children,attachments,relations,changesets,watchers');

        if (! $result) {
            throw new RedmineApiException('Could not find the Issue');
        }

        $result = json_decode($result, true);
        $result = json_encode($result['issue']);

        return $this->deserialize($result, 'DanielBadura\Redmine\Api\Struct\Issue');
    }

    /**
     * @throws RedmineApiException
     *
     * @return Issue[]
     */
    public function findAll()
    {
        $result = $this->client->get('issues.json?include=children,attachments,relations,changesets,watchers');

        if (! $result) {
            throw new RedmineApiException('Could not find any issues.');
        }

        return $this->deserialize($result, 'DanielBadura\Redmine\Api\Struct\IssueResult')->issues;
    }

    /**
     * @param Issue $issue
     *
     * @throws RedmineApiException
     *
     * @return bool|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface
     */
    public function save(Issue $issue)
    {
        $jsonIssue = $this->serialize(['issue' => $issue]);

        $options = ['body' => $jsonIssue];

        if ($issue->id) {
            $result = $this->client->put('issues/' . $issue->id . '.json', $options);
        } else {
            $result = $this->client->post('issues.json', $options);
        }

        $issue->notes = null; // remove note

        if ($result) {
            return $result;
        }

        return false;
    }

    /**
     * @param Issue $issue
     *
     * @throws RedmineApiException
     *
     * @return bool
     */
    public function delete(Issue $issue)
    {
        if (! $this->find($issue->id)) {
            return false;
        }

        $options = [];

        $result = $this->client->delete('issues/' . $issue->id . '.json', $options);

        if (! $result) {
            throw new RedmineApiException('Could not delete the Issue.');
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

        $result = $this->client->post('/issues/' . $issue->id . '/watchers.json', $options);

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

        $result = $this->client->delete('/issues/' . $issue->id . '/watchers/' . $user->id . '.json');

        if (! $result) {
            return false;
        }

        return true;
    }
}
