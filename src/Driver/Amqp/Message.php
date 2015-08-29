<?php

namespace Queue\Driver\Amqp;

use PhpAmqpLib\Message\AMQPMessage;
use Queue\Driver\MessageInterface;

class Message extends AMQPMessage implements MessageInterface
{
    public function __construct($body, array $properties = array())
    {
        parent::__construct($body, $properties);
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
}
