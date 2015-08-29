<?php

namespace QueueTest\Unit;

use Queue\Adapter\Configuration\RabbitMqConfig;
use Queue\Adapter\RabbitMqAdapter;
use Queue\Configuration;
use Queue\Driver;
use Queue\DriverManager;
use Queue\Manager;
use QueueTest\Fake\Adapter\Configuration\RabbitMqConfigFake;

class DriverManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOf()
    {
        $connection = DriverManager::getConnection(new Configuration(Driver::AMQP, '33.33.33.100', 5672, 'kanui', 'kanui'));



    }
}
 