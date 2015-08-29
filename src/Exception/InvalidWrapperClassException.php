<?php

namespace Queue\Exception;

class InvalidWrapperClassException extends QueueException
{
    public function __construct($wrapperClass)
    {
        parent::__construct('The given \'wrapperClass\' ' . $wrapperClass . ' has to be a ' .
            'subtype of \Queue\Connection.');
    }
}
