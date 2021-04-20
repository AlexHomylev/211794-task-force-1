<?php

namespace src\models;

class CompleteAction extends Action
{
    public function getName(): string
    {
        return 'Выполнено';
    }

    public function getInternalName(): string
    {
        return 'сompleted';
    }

    public function checkAccessRights(?int $idExecutor, ?int $idCustomer, ?int $idUser): bool
    {
        return $idCustomer === $idUser;
    }
}
