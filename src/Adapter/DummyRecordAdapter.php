<?php

namespace DanielBadura\Redmine\Api\Adapter;

/**
 * @author David Badura <d.a.badura@gmail.com>
 */
class DummyRecordAdapter extends AbstractDummyAdapter
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @param string           $dir
     * @param AdapterInterface $adapter
     */
    public function __construct($dir, AdapterInterface $adapter)
    {
        parent::__construct($dir);

        $this->adapter = $adapter;
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function get($path, array $options = [])
    {
        return $this->record('get', $path, $options);
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function post($path, array $options = [])
    {
        return $this->record('post', $path, $options);
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function put($path, array $options = [])
    {
        return $this->record('put', $path, $options);
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function delete($path, array $options = [])
    {
        return $this->record('delete', $path, $options);
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function patch($path, array $options = [])
    {
        return $this->record('patch', $path, $options);
    }

    /**
     * @param string $method
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    private function record($method, $path, array $options = [])
    {
        $result = $this->adapter->$method($path, $options);
        file_put_contents($this->getFilePath($method, $path, $options), $result);

        return $result;
    }
}
