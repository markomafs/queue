<?php

namespace Queue;

use Queue\Driver\MessageInterface;

interface ConsumerInterface extends InterfaceQueue
{
    const PERSISTENT = true;
    const NOT_PERSISTENT = false;

    /**
     * @return void
     */
    public function consume();

    /**
     * @param MessageInterface $message
     * @return void
     */
    public function process(MessageInterface $message);
}
