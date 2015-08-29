<?php

namespace Queue\Driver\Exception;

use Queue\Exception\QueueException;

abstract class AbstractDriverException extends QueueException implements DriverException
{
}
