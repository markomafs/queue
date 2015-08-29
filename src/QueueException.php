<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue;

class QueueException extends \Exception
{

    /**
     * @return QueueException
     */
    public static function driverRequired()
    {
        return new static(
            "The options 'driver' or 'driverClass' are mandatory if no PDO " .
            "instance is given to DriverManager::getConnection()."
        );
    }

    /**
     * @param $unknownDriverName
     * @param array $knownDrivers
     * @return QueueException
     */
    public static function unknownDriver($unknownDriverName, array $knownDrivers)
    {
        return new static(
            "The given 'driver' " . $unknownDriverName . " is unknown, " .
            "Doctrine currently supports only the following drivers: " . implode(", ", $knownDrivers)
        );
    }

    /**
     * @param string $wrapperClass
     * @return QueueException
     */
    public static function invalidWrapperClass($wrapperClass)
    {
        return new static("The given 'wrapperClass' " . $wrapperClass . " has to be a " .
            "subtype of \Queue\Connection.");
    }
}