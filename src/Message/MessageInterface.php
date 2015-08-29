<?php

namespace Queue\Message;

interface MessageInterface
{
    public function __construct($body, array $properties = array());
}
