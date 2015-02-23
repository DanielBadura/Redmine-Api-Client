<?php

namespace DanielBadura\Redmine\Api\Tests\Repository;

use DanielBadura\Redmine\Api\Client;
use DanielBadura\Redmine\Api\Repository\IssueRepository;
use DanielBadura\Redmine\Api\Struct\Issue;
use JMS\Serializer\SerializerBuilder;

class IssueRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    public $clientMock;

    /**
     * @var IssueRepository
     */
    public $OUT;

    public function __construct()
    {
        $this->clientMock = $this->getMockBuilder('DanielBadura\Redmine\Api\Client')
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock->setSerializer(SerializerBuilder::create()->build());

        $this->OUT = new IssueRepository($this->clientMock);
    }

    public function testFindIssue()
    {
        $this->clientMock->expects($this->once())->method('get')->with('issue/1.json')->will($this->returnValue($this->getIssueJson()));

        $result = $this->OUT->find(1);

        $this->assertEquals($result, 1);
    }

    private function getIssueJson()
    {
        return json_encode(
            [
                'issue' => [
                    'id' => 1,
                    'project' => [
                        'id' => 1,
                        'name' => 'TestProject'
                    ],
                    'tracker' => [
                        'id' => 1,
                        'name' => 'Feature'
                    ],
                    'status' => [
                        'id' => 1,
                        'name' => 'New'
                    ],
                    'priority' => [
                        'id' => 1,
                        'name' => 'Normal'
                    ],
                    'author' => [
                        'id' => 1,
                        'name' => 'DanielBadura'
                    ],
                    'assignedTo' => [
                        'id' => 1,
                        'name' => 'DanielBadura'
                    ],
                    'subject' => 'TestCase',
                    'description' => 'Just an Test.',
                    'start_date' => '2014-2-3',
                    'due_date' => '2014-2-5',
                ]
            ]
        );
    }

    public function getIssueObject()
    {
        $issue             = new Issue();
        $issue->id         = 1;
        $issue->assignedTo = 1;
        $issue->author     = 1;
        $issue->journals   = null;
        $issue->priority   = 1;
        $issue->status     = 1;
        $issue->title      = 'TestCase';

        return $issue;
    }
} 