<?php

namespace DanielBadura\Redmine\Api\Adapter;

use DanielBadura\Redmine\Api\Exception\ClientException;
use DanielBadura\Redmine\Api\Exception\RedmineApiException;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Message\Response;

/**
 * @author Daniel Badura <d.m.badura@googlemail.com>
 * @author David Badura <d.a.badura@gmail.com>
 */
class GuzzleAdapter implements AdapterInterface
{
    /**
     * @var Guzzle
     */
    protected $guzzle;

    /**
     * @var array
     */
    protected $options;

    /**
     * @param string $url
     * @param string $identifier username or api-token
     * @param string $password
     */
    public function __construct($url, $identifier, $password = null)
    {
        $this->guzzle = new Guzzle(['base_url' => $url]);

        $this->options = [
            'auth' => [$identifier, $password],
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ];
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @throws ClientException
     * @throws RedmineApiException
     *
     * @return string
     */
    public function get($path, array $options = [])
    {
        $options = array_merge($this->options, $options);

        try {
            /** @var Response $result */
            $result = $this->guzzle->get($path, $options);
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
     * @param string $path
     * @param array  $options
     *
     * @throws ClientException
     *
     * @return string
     */
    public function post($path, array $options = [])
    {
        $options = array_merge($this->options, $options);

        try {
            /** @var Response $result */
            $result = $this->guzzle->post($path, $options);
        } catch (RequestException $requestException) {
            throw new ClientException('Could not create.', 0, $requestException);
        }

        return $result->getBody()->getContents();
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @throws ClientException
     *
     * @return string
     */
    public function put($path, array $options = [])
    {
        $options = array_merge($this->options, $options);

        try {
            /** @var Response $result */
            $result = $this->guzzle->put($path, $options);
        } catch (RequestException $requestException) {
            throw new ClientException('Could not update.', 0, $requestException);
        }

        return $result->getBody()->getContents();
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @throws ClientException
     *
     * @return string
     */
    public function delete($path, array $options = [])
    {
        $options = array_merge($this->options, $options);

        try {
            /** @var Response $result */
            $result = $this->guzzle->delete($path, $options);
        } catch (RequestException $requestException) {
            throw new ClientException('Could not delete.', 0, $requestException);
        }

        return $result->getBody()->getContents();
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @throws ClientException
     *
     * @return string
     */
    public function patch($path, array $options = [])
    {
        $options = array_merge($this->options, $options);

        try {
            /** @var Response $result */
            $result = $this->guzzle->patch($path, $options);
        } catch (RequestException $requestException) {
            throw new ClientException('Could not update.', 0, $requestException);
        }

        return $result->getBody()->getContents();
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}
