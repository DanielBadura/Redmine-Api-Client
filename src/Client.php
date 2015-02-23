<?php

namespace DanielBadura\Redmine\Api;

use DanielBadura\Redmine\Api\Repository\IssueRepository;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Message\FutureResponse;
use GuzzleHttp\Message\ResponseInterface;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 */
class Client
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string|null
     */
    protected $password;

    /**
     * @var string|null username for impersonating API calls
     */
    protected $impersonateUser = null;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @param      $url
     * @param null $apiKey
     * @param null $username
     * @param null $password
     */
    public function __construct($url, $apiKey = null, $username = null, $password = null)
    {
        $this->url        = $url;
        $this->apiKey     = $apiKey;
        $this->username   = $username;
        $this->password   = $password;
        $this->guzzle     = new Guzzle(
            [
                'base_url' => $url
            ]
        );
        $this->serializer = SerializerBuilder::create()->build();
    }

    /**
     * @return IssueRepository
     */
    public function getIssueRepository()
    {
        return new IssueRepository($this);
    }

    /**
     * @param       $path
     * @param array $options
     *
     * @return ResponseInterface|FutureResponse
     */
    public function get($path, array $options = [])
    {

        return $this->guzzle->get($path, $options);
    }

    /**
     * @param       $path
     * @param array $options
     *
     * @return ResponseInterface|FutureResponse
     */
    public function post($path, array $options = [])
    {
        return $this->guzzle->post($path, $options);
    }

    /**
     * @param       $path
     * @param array $options
     *
     * @return ResponseInterface|FutureResponse
     */
    public function put($path, array $options = [])
    {
        return $this->guzzle->put($path, $options);
    }

    /**
     * @param       $path
     * @param array $options
     *
     * @return ResponseInterface|FutureResponse
     */
    public function delete($path, array $options = [])
    {
        return $this->guzzle->delete($path, $options);
    }

    /**
     * @param       $path
     * @param array $options
     *
     * @return ResponseInterface|FutureResponse
     */
    public function patch($path, array $options = [])
    {
        return $this->guzzle->patch($path, $options);
    }

    /**
     * @return Serializer
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @param Serializer $serializer
     */
    public function setSerializer($serializer)
    {
        $this->serializer = $serializer;
    }
} 