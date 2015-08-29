<?php

namespace Queue\Driver\Amqp;

use Queue\ConfigurationInterface;

class Driver implements \Queue\Driver
{
    /**
     * Attempts to create a connection with the queue.
     *
     * @param ConfigurationInterface $configuration
     * @return \Queue\Driver\Connection The queue connection.
     * @throws AmqpException
     */
    public function connect(ConfigurationInterface $configuration)
    {
        try {
            return new Connection($configuration);
        } catch (\Exception $e) {
            throw new AmqpException($e->getMessage(), null, $e);
        }
    }

    /**
     * Gets the name of driver.
     *
     * @return string The name of driver.
     */
    public function getName()
    {
        return self::AMQP;
    }
}
