<?php

namespace DanielBadura\Redmine\Api\Repository;

use DanielBadura\Redmine\Api\Exception\RedmineApiException;
use DanielBadura\Redmine\Api\Struct\Attachment;

/**
 * @author Marco Giesen <marco.giesen93@gmail.com>
 */
class AttachmentRepository extends AbstractRepository
{
    /**
     * @param int $id
     *
     * @throws RedmineApiException
     *
     * @return Attachment
     */
    public function find($id)
    {
        $result = $this->client->get('attachments/' . $id . '.json');

        if (! $result) {
            throw new RedmineApiException('Could not find the Attachments');
        }

        $result = json_decode($result, true);
        $result = json_encode($result['attachment']);

        return $this->deserialize($result, 'DanielBadura\Redmine\Api\Struct\Attachment');
    }

    public function findAll()
    {
    }

}
