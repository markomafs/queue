<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue\Driver;

use Queue\AbstractQueue;
use Queue\Message\MessageInterface;

interface Connection
{
    const DRIVER_AMQP = 'amqp';

    /**
     * @return void
     */
    public function close();

    /**
     * @param MessageInterface $message
     * @param AbstractQueue $queue
     * @return mixed
     */
    public function publish(MessageInterface $message, AbstractQueue $queue);

    /**
     * @param string $message
     * @param array $properties
     * @return MessageInterface
     */
    public function prepare($message, array $properties = array());
}