<?php

namespace src\models;

class RespondAction extends Action
{
    public function getName()
    {
        return 'Откликнуться';
    }

    public function getInternalName()
    {
        return 'respond';
    }

    public function checkAccessRights($id_executor, $id_customer, $id_user): bool
    {
        if (!$id_executor && $id_customer !== $id_user) {
            return true;
        }
        return false;
    }
}
