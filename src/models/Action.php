<?php

namespace src\models;

abstract class Action
{
    public $name;

    public $internalName;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getInternalName()
    {
        return $this->internalName;
    }

    public function setInternalName($internalName)
    {
        $this->internalName = $internalName;
    }

    abstract public function checkingAccessRights($id_executor, $id_customer, $id_user);
}
