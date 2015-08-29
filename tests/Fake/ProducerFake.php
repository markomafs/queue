<?php

namespace QueueTest\Fake;

use Queue\Adapter\Message\InterfaceMessage;
use Queue\Producer;

/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

class ProducerFake extends Producer
{

    public function getWorkingQueueName()
    {
        return 'test.queue';
    }

    public function getWorkingExchangeName()
    {
        return 'amqp.direct';
    }

    /**
     * @param mixed $message
     * @return InterfaceMessage
     */
    public function handleMessage($message)
    {
        return $this->queueAdapter()->buildMessage($message);
    }
}