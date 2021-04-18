<?php

namespace src\models;

class RefuseAction extends Action
{
    public function __construct()
    {
        $this->setName('Отказаться');
        $this->setInternalName('refuse');
    }

    public function checkingAccessRights($id_executor, $id_customer, $id_user): bool
    {
        return $id_executor === $id_user;
    }
}
