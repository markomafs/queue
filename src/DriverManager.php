<?php

namespace Queue;

class DriverManager
{
    private static $drivers = array(
        Driver::AMQP => 'Queue\Driver\Amqp\Driver',
    );

    /**
     * Private constructor. This class cannot be instantiated.
     */
    private function __construct()
    {
    }

    /**
     * @param string $driverName
     * @return string
     * @throws QueueException
     */
    private static function getClassName($driverName)
    {
        if (!static::$drivers[$driverName]) {
            throw QueueException::unknownDriver($driverName, static::getAvailableDrivers());
        }
        return static::$drivers[$driverName];
    }

    /**
     * Returns the list of supported drivers.
     *
     * @return array List of supported drivers.
     */
    public static function getAvailableDrivers()
    {
        return array_keys(static::$drivers);
    }

    /**
     * @param ConfigurationInterface $configuration
     * @return Connection
     * @throws QueueException
     */
    public static function getConnection(ConfigurationInterface $configuration)
    {
        $driverClassName = static::getClassName($configuration->getDriver());

        $driver = new $driverClassName();

        $wrapperClass = $configuration->getOption('wrapperClass', 'Queue\Connection');
        if (!is_subclass_of($wrapperClass, 'Queue\Driver\Connection')) {
            throw QueueException::invalidWrapperClass($wrapperClass);
        }

        return new $wrapperClass($configuration, $driver);
    }
}