<?php

namespace DanielBadura\Redmine\Api\Adapter;


/**
 * @author David Badura <d.a.badura@gmail.com>
 */
abstract class AbstractDummyAdapter implements AdapterInterface
{
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
