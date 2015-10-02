<?php

namespace DanielBadura\Redmine\Api\Adapter;


/**
 * @author David Badura <d.a.badura@gmail.com>
 */
abstract class AbstractDummyAdapter implements AdapterInterface
{
    /**
     * @var string
     */
    protected $dir;

    /**
     * @param string $dir
     */
    public function __construct($dir)
    {
        $this->dir = $dir;
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $options
     * @return string
     */
    protected function getFilePath($method, $path, array $options = [])
    {
        $key = $this->createKey($method, $path, $options);

        return $this->dir . '/' . $key . '.json';
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $options
     * @return string
     */
    protected function createKey($method, $path, array $options = [])
    {
        return md5($method . $path . serialize($options));
    }
}
