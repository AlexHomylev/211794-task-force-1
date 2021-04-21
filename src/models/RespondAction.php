<?php

namespace src\models;

class RespondAction extends Action
{
    public function getName(): string
    {
        return 'Откликнуться';
    }

    public function getInternalName(): string
    {
        return 'respond';
    }

    public function checkAccessRights(?int $idExecutor, ?int $idCustomer, ?int $idUser): bool
    {
        if (!$idExecutor && $idCustomer !== $idUser) {
            return true;
        }
        return false;
    }
}
