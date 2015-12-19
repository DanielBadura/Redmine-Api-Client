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
     * @param array  $options
     *
     * @return string
     */
    protected function getFilePath($method, $path, array $options = [])
    {
        $key = md5($method . $path . serialize($options));

        $tmp  = explode('/', $path);
        $tmp2 = explode('.', $tmp[1]);

        return sprintf('%s/%s_%s_%s.json', $this->dir, $tmp[0], $method, $tmp2[0]);

        return sprintf('%s/%s_%s.json', $this->dir, $method, $key);
    }
}
