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

    public function checkAccessRights($id_executor, $id_customer, $id_user): bool
    {
        return $id_customer === $id_user;
    }
}
