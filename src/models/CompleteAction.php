<?php

namespace src\models;

class CompleteAction extends Action
{
    public function getName()
    {
        return 'Выполнено';
    }

    public function getInternalName()
    {
        return 'сompleted';
    }

    public function checkAccessRights($idExecutor, $idCustomer, $idUser): bool
    {
        return $idCustomer === $idUser;
    }
}
