<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue;

use Queue\Driver\Exception\DriverException;

interface Driver
{
    const AMQP = 'amqp';

    /**
     * Attempts to create a connection with the queue.
     *
     * @param ConfigurationInterface $configuration
     *
     * @return Driver\Connection The database connection.
     *
     * @throws DriverException
     */
    public function connect(ConfigurationInterface $configuration);

    /**
     * Gets the name of driver.
     *
     * @return string The name of driver.
     */
    public function getName();
}
