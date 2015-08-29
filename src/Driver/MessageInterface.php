<?php

namespace Queue\Driver;

interface MessageInterface
{
    public function __construct($body, array $properties = array());
}
