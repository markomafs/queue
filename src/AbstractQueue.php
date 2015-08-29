<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue;

use Queue\Driver\Connection as DriverConnection;

abstract class AbstractQueue implements InterfaceQueue
{

    /**
     * @var DriverConnection
     */
    private $connection;

    public function __construct(DriverConnection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return DriverConnection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    abstract public function getWorkingQueueName();

    abstract public function getWorkingExchangeName();

    public function getQueueArguments()
    {
        return array();
    }
}
