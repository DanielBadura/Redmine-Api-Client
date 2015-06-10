<?php

namespace DanielBadura\Redmine\Api;

use DanielBadura\Redmine\Api\Exception\ClientException;
use DanielBadura\Redmine\Api\Exception\RedmineApiException;
use DanielBadura\Redmine\Api\Repository\IssueRepository;
use DanielBadura\Redmine\Api\Repository\ProjectRepository;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\FutureResponse;
use GuzzleHttp\Message\Response;
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
     * @var Guzzle
     */
    protected $guzzle;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var array
     */
    protected $options;

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
        $this->options    = [
            'auth' => [
                $this->apiKey ? : $this->username,
                $this->password
            ],
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ];
    }

    /**
     * @return IssueRepository
     */
    public function getIssueRepository()
    {
        return new IssueRepository($this);
    }

    /**
     * @return ProjectRepository
     */
    public function getProjectRepository()
    {
        return new ProjectRepository($this);
    }

    /**
     * @param       $path
     * @param array $options
     *
     * @throws ClientException
     * @throws RedmineApiException
     *
     * @return ResponseInterface|FutureResponse
     */
    public function get($path, array $options = [])
    {
        $this->mergeOptions($options);

        try {
            /** @var Response $result */
            $result = $this->guzzle->get($path, $this->options);
        } catch (RequestException $requestException) {
            if ($requestException->getCode() == 404) {
                throw new ClientException('Got HTTP Status Code 404, not Found.', 0, $requestException);
            }

            if ($requestException->getCode() == 403) {
                throw new ClientException('Got HTTP Status Code 403, forbidden.', 0, $requestException);
            }

            if ($requestException->getCode() == 401) {
                throw new ClientException('Got HTTP Status Code 401, authentication needed.', 0, $requestException);
            }

            throw new ClientException('Got HTTP Status Code ' . $requestException->getCode(), 0, $requestException);
        }

        if ($result->getStatusCode() != 200) {
            throw new RedmineApiException('Expected HTTP Status Code 200 got: ' . $result->getStatusCode());
        }

        return $result->getBody()->getContents();
    }

    /**
     * @param       $path
     * @param array $options
     *
     * @throws ClientException
     *
     * @return ResponseInterface|FutureResponse
     */
    public function post($path, array $options = [])
    {
        $this->mergeOptions($options);

        try {
            /** @var Response $result */
            $result = $this->guzzle->post($path, $this->options);
        } catch (RequestException $requestException) {  
            throw new ClientException('Could not create.', 0, $requestException);
        }

        return $result->getBody()->getContents();
    }

    /**
     * @param       $path
     * @param array $options
     *
     * @throws ClientException
     *
     * @return ResponseInterface|FutureResponse
     */
    public function put($path, array $options = [])
    {
        $this->mergeOptions($options);

        try {
            /** @var Response $result */
            $result = $this->guzzle->put($path, $this->options);
        } catch (RequestException $requestException) {
            throw new ClientException('Could not update.', 0, $requestException);
        }

        return $result->getBody()->getContents();
    }

    /**
     * @param       $path
     * @param array $options
     *
     * @throws ClientException
     *
     * @return ResponseInterface|FutureResponse
     */
    public function delete($path, array $options = [])
    {
        $this->mergeOptions($options);

        try {
            /** @var Response $result */
            $result = $this->guzzle->delete($path, $this->options);
        } catch (RequestException $requestException) {
            throw new ClientException('Could not delete.', 0, $requestException);
        }

        return $result->getBody()->getContents();
    }

    /**
     * @param       $path
     * @param array $options
     *
     * @throws ClientException
     *
     * @return ResponseInterface|FutureResponse
     */
    public function patch($path, array $options = [])
    {
        $this->mergeOptions($options);

        try {
            /** @var Response $result */
            $result = $this->guzzle->patch($path, $this->options);
        } catch (RequestException $requestException) {
            throw new ClientException('Could not update.', 0, $requestException);
        }

        return $result->getBody()->getContents();
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
     *
     * @return $this
     */
    public function setSerializer($serializer)
    {
        $this->serializer = $serializer;

        return $this;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function setOptions(array $options = [])
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    protected function mergeOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }
} 
