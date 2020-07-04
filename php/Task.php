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

    public function __construct($id_executor, $id_customer, $current_status)
    {
        $this->id_executor = $id_executor;
        $this->id_customer = $id_customer;
        $this->current_status = $current_status;
    }

    /**
     * Получаем следующий статус после выполнения указанного действия.
     * @param $action
     */
    public function getNextStatus($action) {

    }

    /**
     * Получаем доступные действия для указанного статуса.
     * @param $status
     */
    public function getAvailableActions($status) {

    }

    /**
     * Получаем карту статусов.
     *
     */
    private function getStatusMap() {
        $statusMap = [
            self::STATUS_NEW => 'Новое',
            self::STATUS_WORK => 'В работе',
            self::STATUS_CANCELED => 'Отменено',
            self::STATUS_PERFORMED => 'Выполнено',
            self::STATUS_FAILED => 'Провалено'
        ];

        return $statusMap;
    }

    /**
     * Получаем карту действий.
     *
     */
    private function getActionMap() {
        $actionMap = [
          self::ACTION_ABANDON => 'Откликнуться',
          self::ACTION_COMPLETED => 'Выполнено',
          self::ACTION_RESPOND => 'Отказаться',
          self::ACTION_CANCEL => 'Отменить'
        ];

        return $actionMap;
    }

}
