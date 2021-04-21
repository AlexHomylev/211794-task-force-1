<?php

namespace src\models;

class CancelAction extends Action
{
    public function getName(): string
    {
        return 'Отменить';
    }

    public function getInternalName(): string
    {
        return 'cancel';
    }

    public function checkAccessRights(?int $idExecutor, ?int $idCustomer, ?int $idUser): bool
    {
        return $idCustomer === $idUser;
    }
}
