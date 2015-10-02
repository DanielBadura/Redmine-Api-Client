<?php

namespace DanielBadura\Redmine\Api\Adapter;

/**
 * @author David Badura <d.a.badura@gmail.com>
 */
class DummyRecordAdapter extends AbstractDummyAdapter
{
    /**
     * @var string
     */
    protected $dir;

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @param string $dir
     * @param AdapterInterface $adapter
     */
    public function __construct($dir, AdapterInterface $adapter)
    {
        $this->dir     = $dir;
        $this->adapter = $adapter;
    }

    /**
     * @param string $path
     * @param array $options
     *
     * @return string
     */
    public function get($path, array $options = [])
    {
        return $this->record('get', $path, $options);
    }

    /**
     * @param string $path
     * @param array $options
     * @return string
     */
    public function post($path, array $options = [])
    {
        return $this->record('post', $path, $options);
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
        return $this->record('put', $path, $options);
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
        return $this->record('delete', $path, $options);
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
        return $this->record('patch', $path, $options);
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $options
     * @return FutureResponse|ResponseInterface
     */
    private function record($method, $path, array $options = [])
    {
        $key    = $this->createKey($method, $path, $options);
        $result = $this->$method($path, $options);

        $this->saveResult($key, $result);

        return $result;
    }

    /**
     * @param string $key
     * @param $path
     */
    private function saveResult($key, $path)
    {
        // todo
    }
}
