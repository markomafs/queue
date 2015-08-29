<?php

namespace Queue\Driver\Exception;

class DriverRequiredException extends AbstractDriverException
{
    public function __construct()
    {
        parent::__construct("The options 'driver' or 'driverClass' are mandatory if no PDO " .
            "instance is given to DriverManager::getConnection().");
    }
}
