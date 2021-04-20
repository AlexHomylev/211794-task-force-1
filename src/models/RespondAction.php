<?php

namespace src\models;

class RespondAction extends Action
{
    public function getName()
    {
        return 'Откликнуться';
    }

    public function getInternalName()
    {
        return 'respond';
    }

    public function checkAccessRights($idExecutor, $idCustomer, $idUser): bool
    {
        if (!$idExecutor && $idCustomer !== $idUser) {
            return true;
        }
        return false;
    }
}
