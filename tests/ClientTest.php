<?php

namespace DanielBadura\Redmine\Api\Tests;

use DanielBadura\Redmine\Api\Adapter\DummyAdapter;
use DanielBadura\Redmine\Api\Adapter\DummyRecordAdapter;
use DanielBadura\Redmine\Api\Adapter\GuzzleAdapter;
use DanielBadura\Redmine\Api\Client;

/**
 * @author David Badura <badura@simplethings.de>
 */
abstract class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    protected $client;

    /**
     *
     */
    public function setUp()
    {
        if (getenv('REDMINE_URL') && getenv('REDMINE_USER')) {
            $guzzle  = new GuzzleAdapter(getenv('REDMINE_URL'), getenv('REDMINE_USER'), getenv('REDMINE_PASSWORD'));
            $adapter = new DummyRecordAdapter($this->getFixtureFolder(), $guzzle);
        } else {
            $adapter = new DummyAdapter($this->getFixtureFolder());
        }

        $this->client = new Client($adapter);
    }

    protected function getFixtureFolder()
    {
        return __DIR__ . '/fixtures';
    }
}
