<?php

namespace src\models;

class RefuseAction extends Action
{
    public function getName()
    {
        return 'Отказаться';
    }

    public function getInternalName()
    {
        return 'refuse';
    }

    public function checkAccessRights($idExecutor, $idCustomer, $idUser): bool
    {
        return $idExecutor === $idUser;
    }
}
