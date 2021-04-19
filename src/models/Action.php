<?php

namespace src\models;

abstract class Action
{
    abstract public function getName();

    abstract public function getInternalName();

    abstract public function checkAccessRights($idExecutor, $idCustomer, $idUser);
}
