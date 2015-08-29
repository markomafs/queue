<?php

namespace QueueTest\Unit;

use Queue\Configuration;
use Queue\Driver;
use Queue\DriverManager;

class DriverManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Queue\Driver\Exception\UnknownDriverException
     */
    public function testUnknownDriver()
    {
        DriverManager::getConnection(new Configuration('test', '', null, '', ''));
    }

    /**
     * @expectedException \Queue\Exception\InvalidWrapperClassException
     */
    public function testInvalidWrapperClass()
    {
        $options = array('wrapperClass' => '\stdClass');
        DriverManager::getConnection(new Configuration(Driver::AMQP, '', null, '', '', $options));
    }

    public function testCreateAConnectionObject()
    {
        $connection = DriverManager::getConnection(new Configuration(Driver::AMQP, '', null, '', ''));
        $this->assertInstanceOf('Queue\Connection', $connection);
    }
}
 