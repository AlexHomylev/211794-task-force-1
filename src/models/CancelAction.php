<?php

namespace src\models;

class CancelAction extends Action
{
    public function getName()
    {
        return 'Отменить';
    }

    public function getInternalName()
    {
        return 'cancel';
    }

    public function checkAccessRights($idExecutor, $idCustomer, $idUser): bool
    {
        return $idCustomer === $idUser;
    }
}
