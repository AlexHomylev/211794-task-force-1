<?php

namespace src\models;

class CancelAction extends Action
{
    public function __construct()
    {
        $this->setName('Отменить');
        $this->setInternalName('cancel');
    }

    public function checkingAccessRights($id_executor, $id_customer, $id_user): bool
    {
        return $id_customer === $id_user;
    }
}
