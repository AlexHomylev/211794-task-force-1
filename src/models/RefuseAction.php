<?php

namespace src\models;

class RefuseAction extends Action
{
    public function getName(): string
    {
        return 'Отказаться';
    }

    public function getInternalName(): string
    {
        return 'refuse';
    }

    public function checkAccessRights(?int $idExecutor, ?int $idCustomer, ?int $idUser): bool
    {
        return $idExecutor === $idUser;
    }
}
