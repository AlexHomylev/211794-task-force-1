<?php

namespace src\models;

abstract class Action
{
    /**
     * Получаем общее название действия
     * @return string
     */
    abstract public function getName(): string;

    /**
     * Получаем внутреннее название действия
     * @return string
     */
    abstract public function getInternalName(): string;

    /**
     * Проверяем доступность действия
     * @param int|null $idExecutor
     * @param int|null $idCustomer
     * @param int|null $idUser
     * @return bool
     */
    abstract public function checkAccessRights(?int $idExecutor, ?int $idCustomer, ?int $idUser): bool;
}
