<?php

namespace DanielBadura\Redmine\Api\Adapter;

/**
 * @author David Badura <d.a.badura@gmail.com>
 */
interface AdapterInterface
{
    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function get($path, array $options = []);

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function post($path, array $options = []);

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function put($path, array $options = []);

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function delete($path, array $options = []);

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function patch($path, array $options = []);
}