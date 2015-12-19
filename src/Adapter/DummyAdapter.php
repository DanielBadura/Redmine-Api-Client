<?php

namespace DanielBadura\Redmine\Api\Adapter;

/**
 * @author David Badura <d.a.badura@gmail.com>
 */
class DummyAdapter extends AbstractDummyAdapter
{
    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function get($path, array $options = [])
    {
        return $this->read('get', $path, $options);
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function post($path, array $options = [])
    {
        return $this->read('post', $path, $options);
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function put($path, array $options = [])
    {
        return $this->read('put', $path, $options);
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function delete($path, array $options = [])
    {
        return $this->read('delete', $path, $options);
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function patch($path, array $options = [])
    {
        return $this->read('patch', $path, $options);
    }

    /**
     * @param string $method
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    private function read($method, $path, array $options = [])
    {
        return file_get_contents($this->getFilePath($method, $path, $options));
    }
}
