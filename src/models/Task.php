<?php

namespace src\models;

use ErrorException;

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
    public $id_executor; // Идентификатор исполнителя
    public $id_customer; // Идентификатор клиента
    public $id_user; // Идентификатор пользователя
    public $current_status; // Текущий статус

    public function __construct($id_executor, $id_customer, $id_user, $current_status)
    {
        $this->id_executor = $id_executor;
        $this->id_customer = $id_customer;
        $this->current_status = $current_status;
        $this->id_user = $id_user;
    }

    /**
     * Получаем следующий статус после выполнения указанного действия.
     * @param $action
     * @return string
     * @throws ErrorException
     */
    public function getNextStatus($action)
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
                throw new ErrorException('Nonexistent action', 422);
        }
    }

    /**
     * Получаем доступные действия для указанного статуса.
     * @param $status
     * @return string[]|null
     * @throws ErrorException
     */
    public function getAvailableActions($status): ?array
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
                throw new ErrorException('Nonexistent status', 422);
        }

        $availableActions = null;

        foreach ($availableClasses as $class) {
            if ($class->checkAccessRights($this->id_executor, $this->id_customer, $this->id_user)) {
                $availableActions[] = $class;
            }
        }

        return $availableActions;
    }

    /**
     * Получаем карту статусов.
     * @return string[]
     */
    private static function getStatusMap()
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
    private static function getActionMap()
    {
        return [
            (new RespondAction)->getName(),
            (new CancelAction)->getName(),
            (new CompleteAction)->getName(),
            (new RefuseAction)->getName(),
        ];
    }

}
