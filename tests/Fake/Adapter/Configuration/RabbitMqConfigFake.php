<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace QueueTest\Fake\Adapter\Configuration;

use Queue\Adapter\Configuration\RabbitMqConfig;

class RabbitMqConfigFake
{
    public static function getConfigArray()
    {
        return array(
            'host' => RABBIT_HOST,
            'port' => RABBIT_PORT,
            'username' => RABBIT_USERNAME,
            'password' => RABBIT_PASSWORD,
        );
    }

    public static function getObject()
    {
        return new RabbitMqConfig(self::getConfigArray());
    }
} 