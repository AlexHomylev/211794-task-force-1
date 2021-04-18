<?php

namespace src\models;

class AbandonAction extends Action
{
    public function __construct()
    {
        $this->setName('Откликнуться');
        $this->setInternalName('abandon');
    }

    public function checkingAccessRights($id_executor, $id_customer, $id_user): bool
    {
        if (!$id_executor && $id_customer !== $id_user) {
            return true;
        }
        return false;
    }
}
