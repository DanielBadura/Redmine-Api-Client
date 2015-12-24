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
        $slashed = false;

        if (strpos($path, '/') !== false) {
            $pathWithSlashArray = explode('/', $path);
            $type = $pathWithSlashArray[0];
            $path = $pathWithSlashArray[1];
            $slashed = true;
        }

        $typeOrIdArray = explode('.', $path);
        $typeOrId = $typeOrIdArray[0];

        if ($slashed) {
            return sprintf('%s/%s_%s_%s.json', $this->dir, $type, $method, $typeOrId);
        }

        return sprintf('%s/%s_%s.json', $this->dir, $typeOrId, $method);
    }
}
