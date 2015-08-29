<?php

namespace QueueTest\Unit;

use Queue\Adapter\Configuration\RabbitMqConfig;
use Queue\Adapter\RabbitMqAdapter;
use Queue\Manager;
use QueueTest\Fake\Adapter\Configuration\RabbitMqConfigFake;

class ManagerTest extends \PHPUnit_Framework_TestCase
{


    public function testInstanceOf()
    {
        $adapter = RabbitMqAdapter::create(RabbitMqConfigFake::getObject());
        $queueManager = new Manager($adapter);
        $this->assertSame($adapter, $queueManager->getAdapter());
    }

    public function testMessageObject()
    {
        $adapter = RabbitMqAdapter::create(RabbitMqConfigFake::getObject());
        $queueManager = new Manager($adapter);
        $this->assertInstanceOf('\Queue\Adapter\Message\InterfaceMessage', $queueManager->getMessageObject());
    }
}
 