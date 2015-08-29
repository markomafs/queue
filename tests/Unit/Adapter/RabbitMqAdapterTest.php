<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace QueueTest\Unit\Adapter;

use Queue\Adapter\RabbitMqAdapter;
use QueueTest\Fake\Adapter\Configuration\RabbitMqConfigFake;
use QueueTest\Fake\ProducerFake;

class RabbitMqAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOfAndDestruct()
    {
        $adapter = RabbitMqAdapter::create(RabbitMqConfigFake::getObject());
        $this->assertInstanceOf('\Queue\Adapter\RabbitMqAdapter', $adapter);
        $adapter->__destruct();
    }

    public function testConnection()
    {
        $adapter = RabbitMqAdapter::create(RabbitMqConfigFake::getObject());
        $adapter->connection();
    }

    public function testPublishAndClose()
    {
        $adapter = RabbitMqAdapter::create(RabbitMqConfigFake::getObject());
        $producer = new ProducerFake($adapter);
        $message = $producer->handleMessage('teste: '.rand());
        $producer->publish($message);
        $producer->close();
    }

}