<?php

namespace Queue;

use Queue\Driver\Connection as DriverConnection;
use Queue\Message\MessageInterface;

class Connection implements DriverConnection
{
    /**
     * @var DriverConnection
     */
    private $connection;
    /**
     * @var Driver
     */
    private $driver;
    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    public function __construct(ConfigurationInterface $configuration, Driver $driver)
    {
        $this->driver = $driver;
        $this->configuration = $configuration;
    }

    /**
     * @return Driver
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @return ConfigurationInterface
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @return DriverConnection
     */
    protected function connect()
    {
        if (!$this->connection) {
            $this->connection = $this->getDriver()->connect($this->getConfiguration());
        }
        return $this->connection;
    }

    /**
     * @return void
     */
    public function close()
    {
        $this->connect()->close();
    }

    /**
     * @param MessageInterface $message
     * @param AbstractQueue $queue
     * @return mixed
     */
    public function publish(MessageInterface $message, AbstractQueue $queue)
    {
        $this->connect()->publish($message, $queue);
    }

    /**
     * @param string $message
     * @param array $properties
     * @return MessageInterface
     */
    public function prepare($message, array $properties = array())
    {
        return $this->connect()->prepare($message, $properties);
    }
}