<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace QueueTest\Unit\Adapter\Configuration;


use Queue\Adapter\Configuration\RabbitMqConfig;
use QueueTest\Fake\Adapter\Configuration\RabbitMqConfigFake;

class RabbitMqConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOf()
    {
        $config = new RabbitMqConfig(RabbitMqConfigFake::getConfigArray());
        $this->assertInstanceOf('\Queue\Adapter\Configuration\RabbitMqConfig', $config);
    }
}
 