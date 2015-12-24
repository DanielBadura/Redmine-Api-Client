<?php

namespace DanielBadura\Redmine\Api;

class IdentityMap
{
    /**
     * @var array
     */
    private $identities = [];

    /**
     * @param $id
     *
     * @return bool
     */
    public function hasIdentity($id)
    {
        return isset($this->identities[$id]);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getIdentity($id)
    {
        return $this->identities[$id];
    }

    /**
     * @param $id
     * @param $identity
     */
    public function setIdentity($id, $identity)
    {
        $this->identities[$id] = $identity;
    }
} 