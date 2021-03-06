<?php
require __DIR__ . '../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use src\exceptions\NotFoundAction;
use src\exceptions\NotFoundStatus;
use src\models\RespondAction;
use src\models\CancelAction;
use src\models\CompleteAction;
use src\models\RefuseAction;
use src\models\Task;

class TaskCest
{
    public function getNextStatus(UnitTester $I) {
        $model = new Task(1, 1, 1, 'new');

        $I->assertEquals($model::STATUS_WORK, $model->getNextStatus(new RespondAction));

        $I->assertEquals($model::STATUS_PERFORMED, $model->getNextStatus(new CompleteAction));

        $I->expectThrowable(TypeError::class, function() use ($model) {
            $model->getNextStatus('Hello!');
        });
    }

    public function getAvailableActions(UnitTester $I){
        $model = new Task(1, 1, 1,'new');

        $I->assertEquals([new CancelAction], $model->getAvailableActions('new'));
        $I->assertEquals([new CompleteAction, new RefuseAction], $model->getAvailableActions('work'));
        $I->assertEquals(null, $model->getAvailableActions('performed'));
        $I->assertEquals(null, $model->getAvailableActions('failed'));
        $I->assertEquals(null, $model->getAvailableActions('canceled'));

        $model->idUser = 2;
        $model->idExecutor = null;

        $I->assertEquals([new RespondAction], $model->getAvailableActions('new'));
        $I->assertEquals(null, $model->getAvailableActions('work'));
        $I->assertEquals(null, $model->getAvailableActions('performed'));
        $I->assertEquals(null, $model->getAvailableActions('failed'));
        $I->assertEquals(null, $model->getAvailableActions('canceled'));

        $model->idExecutor = 2;

        $I->assertEquals(null, $model->getAvailableActions('new'));
        $I->assertEquals([new RefuseAction], $model->getAvailableActions('work'));
        $I->assertEquals(null, $model->getAvailableActions('performed'));
        $I->assertEquals(null, $model->getAvailableActions('failed'));
        $I->assertEquals(null, $model->getAvailableActions('canceled'));

        $I->expectThrowable(NotFoundStatus::class, function() use ($model) {
            $model->getAvailableActions('Hello!');
        });
    }
}
