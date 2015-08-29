<?php

namespace Queue\Driver\Amqp;

use PhpAmqpLib\Message\AMQPMessage;
use Queue\Message\MessageInterface;

class Message extends AMQPMessage implements MessageInterface
{
    public function __construct($body, array $properties = array())
    {
        parent::__construct($body, $properties);
    }
}