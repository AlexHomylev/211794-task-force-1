<?php
require __DIR__ .'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class TaskTests extends TestCase
{
    public function testGetNextStatus() {
        $model = new Task(1, 1, 'new');
        $this->assertEquals('canceled', $model->getNextStatus('cancel'));

        $this->assertEquals('work', $model->getNextStatus('abandon'));

        $this->expectException(ErrorException::class);
        $model->getNextStatus('Hello!');
    }

    public function testGetAvailableActions(){
        $model = new Task(1, 1, 'new');

        $this->assertEquals(['abandon', 'cancel'], $model->getAvailableActions('new'));

        $this->assertEquals(null, $model->getAvailableActions('canceled'));

        $this->expectException(ErrorException::class);
        $model->getAvailableActions('Hello!');
    }
}
