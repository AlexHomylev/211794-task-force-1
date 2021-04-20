<?php

namespace src\models;

use src\exceptions\NotFoundAction;
use src\exceptions\NotFoundStatus;

/**
 * Class Task
 */
class Task
{
    // Статусы
    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_WORK = 'work';
    const STATUS_PERFORMED = 'performed';
    const STATUS_FAILED = 'failed';

    // Аттрибуты
    public $idExecutor; // Идентификатор исполнителя
    public $idCustomer; // Идентификатор клиента
    public $idUser; // Идентификатор пользователя
    public $currentStatus; // Текущий статус

    public function __construct(?int $idExecutor, ?int $idCustomer, ?int $idUser, string $currentStatus)
    {
        $this->$idExecutor = $idExecutor;
        $this->$idCustomer = $idCustomer;
        $this->$idUser = $idUser;
        $this->$currentStatus = $currentStatus;
    }

    /**
     * Получаем следующий статус после выполнения указанного действия.
     * @param Action $action
     * @return string
     * @throws NotFoundAction
     */
    public function getNextStatus(Action $action): ?string
    {
        switch ($action) {
            case new RespondAction;
                return self::STATUS_WORK;
            case new CancelAction;
                return self::STATUS_CANCELED;
            case new CompleteAction;
                return self::STATUS_PERFORMED;
            case new RefuseAction;
                return self::STATUS_FAILED;
            default;
                throw new NotFoundAction('Nonexistent action', 422);
        }
    }

    /**
     * Получаем доступные действия для указанного статуса.
     * @param string $status
     * @return string[]|null
     * @throws NotFoundStatus
     */
    public function getAvailableActions(string $status): ?array
    {
        $availableClasses = [];

        switch ($status) {
            case self::STATUS_NEW;
                $availableClasses = [new RespondAction(), new CancelAction()];
                break;
            case self::STATUS_WORK;
                $availableClasses = [new CompleteAction(), new RefuseAction()];
                break;
            case self::STATUS_PERFORMED:
            case self::STATUS_FAILED:
            case self::STATUS_CANCELED;
                return null;
            default;
                throw new NotFoundStatus('Nonexistent status', 422);
        }

        $availableActions = null;

        foreach ($availableClasses as $class) {
            if ($class->checkAccessRights($this->idExecutor, $this->idCustomer, $this->idUser)) {
                $availableActions[] = $class;
            }
        }

        return $availableActions;
    }

    /**
     * Получаем карту статусов.
     * @return string[]
     */
    private static function getStatusMap(): array
    {
        return [
            self::STATUS_NEW => 'Новое',
            self::STATUS_WORK => 'В работе',
            self::STATUS_CANCELED => 'Отменено',
            self::STATUS_PERFORMED => 'Выполнено',
            self::STATUS_FAILED => 'Провалено'
        ];
    }

    /**
     * Получаем карту действий.
     * @return string[]
     */
    private static function getActionMap(): array
    {
        return [
            (new RespondAction)->getName(),
            (new CancelAction)->getName(),
            (new CompleteAction)->getName(),
            (new RefuseAction)->getName(),
        ];
    }

}
