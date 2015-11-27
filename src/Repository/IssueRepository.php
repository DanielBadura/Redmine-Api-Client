<?php

namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Exception\RedmineApiException;
use DanielBadura\Redmine\Api\Hydration\IssueProjectHydration;
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

        if(! $result) {
            throw new RedmineApiException('Could not find the Issue');
        }

        $result = json_decode($result, true);
        $result = json_encode($result['issue']);
        $issue = $this->deserialize($result, 'DanielBadura\Redmine\Api\Struct\Issue');

        $hydrate = new IssueProjectHydration();
        $issue = $hydrate->hydrateOneIssue($issue, $this->client);

        return $issue;
    }

    /**
     * @throws RedmineApiException
     *
     * @return Issue[]
     */
    public function findAll()
    {
        $result = $this->client->get('issues.json?include=children,attachments,relations,changesets,watchers');

        if(! $result) {
            throw new RedmineApiException('Could not find any issues.');
        }

        $issues = $this->deserialize($result, 'DanielBadura\Redmine\Api\Struct\IssueResult')->issues;

        $hydrate = new IssueProjectHydration();
        $issues = $hydrate->hydrateManyIssues($issues, $this->client);

        return $issues;
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

        if($issue->id) {
            $result = $this->client->put('issues/' . $issue->id . '.json', $options);
        } else {
            $result = $this->client->post('issues.json', $options);
        }

        $issue->notes = null; // remove note

        if($result) {
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
        if(! $this->find($issue->id)) {
            return false;
        }

        $options = [];

        $result = $this->client->delete('issues/' . $issue->id . '.json', $options);

        if(! $result) {
            throw new RedmineApiException('Could not delete the Issue.');
        }

        return false;
    }

    /**
     * @param Issue $issue
     * @param User $user
     *
     * @return bool
     */
    public function addWatcher(Issue $issue, User $user)
    {
        if(! $this->find($issue->id)) {
            return false;
        }

        $userRepository = $this->client->getUserRepository();

        if (! $userRepository->find($user->id)) {
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

        if(! $result) {
            return false;
        }

        return true;
    }

    /**
     * @param Issue $issue
     * @param User $user
     *
     * @return bool
     */
    public function deleteWatcher(Issue $issue, User $user)
    {
        if(! $this->find($issue->id)) {
            return false;
        }

        $userRepository = $this->client->getUserRepository();

        if (! $userRepository->find($user->id)) {
            return false;
        }

        $result = $this->client->delete('/issues/' . $issue->id . '/watchers/' . $user->id . '.json');

        if(! $result) {
            return false;
        }

        return true;
    }
}
