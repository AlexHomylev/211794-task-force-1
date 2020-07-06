<?php

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

    // Действия
    const ACTION_CANCEL = 'cancel';
    const ACTION_ABANDON = 'abandon';
    const ACTION_RESPOND = 'respond';
    const ACTION_COMPLETED = 'completed';

    // Аттрибуты
    public $id_executor;
    public $id_customer;
    public $current_status;

    // Карты
    public $statusMap = [
        self::STATUS_NEW => 'Новое',
        self::STATUS_WORK => 'В работе',
        self::STATUS_CANCELED => 'Отменено',
        self::STATUS_PERFORMED => 'Выполнено',
        self::STATUS_FAILED => 'Провалено'
    ];

    public $actionMap = [
        self::ACTION_ABANDON => 'Откликнуться',
        self::ACTION_CANCEL => 'Отменить',
        self::ACTION_COMPLETED => 'Выполнено',
        self::ACTION_RESPOND => 'Отказаться',
    ];

    public function __construct($id_executor, $id_customer, $current_status)
    {
        $this->id_executor = $id_executor;
        $this->id_customer = $id_customer;
        $this->current_status = $current_status;
    }

    /**
     * Получаем следующий статус после выполнения указанного действия.
     * @param $action
     * @return string
     * @throws ErrorException
     */
    public function getNextStatus($action) {
        switch ($action) {
            case self::ACTION_ABANDON;
                return self::STATUS_WORK;
            case self::ACTION_CANCEL;
                return self::STATUS_CANCELED;
            case self::ACTION_COMPLETED;
                return self::STATUS_PERFORMED;
            case self::ACTION_RESPOND;
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
    public function getAvailableActions($status) {
        switch ($status) {
            case self::STATUS_NEW;
                return [self::ACTION_ABANDON, self::ACTION_CANCEL];
            case self::STATUS_WORK;
                return [self::ACTION_COMPLETED, self::ACTION_RESPOND];
            case self::STATUS_CANCELED;
                return null;
            case self::STATUS_PERFORMED;
                return null;
            case self::STATUS_FAILED;
                return null;
            default;
                throw new ErrorException('Nonexistent status', 422);
        }
    }

    /**
     * Получаем карту статусов.
     * @return string[]
     */
    private function getStatusMap() {
        return $this->statusMap;
    }

    /**
     * Получаем карту действий.
     * @return string[]
     */
    private function getActionMap() {
        return $this->actionMap;
    }

}
