<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue;

use Queue\Driver\MessageInterface;

interface InterfaceQueue
{

    const QUEUE_PASSIVE = true;
    const QUEUE_NOT_PASSIVE = false;
    const QUEUE_DURABLE = true;
    const QUEUE_NOT_DURABLE = false;
    const QUEUE_AUTO_DELETE = true;
    const QUEUE_NOT_AUTO_DELETE = false;
    const QUEUE_EXCLUSIVE = true;
    const QUEUE_NOT_EXCLUSIVE = false;
    const QUEUE_LOCAL = true;
    const QUEUE_NOT_LOCAL = false;
    const QUEUE_ACK = true;
    const QUEUE_NOT_ACK = false;
    const QUEUE_WAIT = true;
    const QUEUE_NO_WAIT = false;
    const CHANNEL_DIRECT = 'direct';
    const CHANNEL_FANOUT = 'fanout';
    const CHANNEL_TOPIC = 'topic';
    const CHANNEL_MATCH = 'match';
    const MESSAGE_NON_PERSISTENT = 1;
    const MESSAGE_PERSISTENT = 2;

    public function getWorkingQueueName();

    public function getWorkingExchangeName();
}
