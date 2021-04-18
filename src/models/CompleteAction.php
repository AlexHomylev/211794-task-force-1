<?php

namespace src\models;

class CompleteAction extends Action
{
    public function __construct()
    {
        $this->setName('Выполнено');
        $this->setInternalName('сompleted');
    }

    public function checkingAccessRights($id_executor, $id_customer, $id_user): bool
    {
        return $id_customer === $id_user;
    }
}
