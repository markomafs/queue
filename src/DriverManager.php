<?php

namespace Queue;

use Queue\Driver\Exception\UnknownDriverException;
use Queue\Exception\InvalidWrapperClassException;

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
     * @throws UnknownDriverException
     */
    private static function getClassName($driverName)
    {
        if (!isset(static::$drivers[$driverName])) {
            throw new UnknownDriverException($driverName, static::getAvailableDrivers());
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
     * @throws InvalidWrapperClassException
     */
    public static function getConnection(ConfigurationInterface $configuration)
    {
        $driverClassName = static::getClassName($configuration->getDriver());

        $driver = new $driverClassName();

        $wrapperClass = $configuration->getOption('wrapperClass', 'Queue\Connection');
        if (!is_subclass_of($wrapperClass, 'Queue\Driver\Connection')) {
            throw new InvalidWrapperClassException($wrapperClass);
        }

        return new $wrapperClass($configuration, $driver);
    }
}
