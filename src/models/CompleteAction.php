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

    public function checkAccessRights($id_executor, $id_customer, $id_user): bool
    {
        return $id_customer === $id_user;
    }
}
