<?php

namespace QueueTest\Fake;

use Queue\Consumer;
use Queue\Driver\MessageInterface;

/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */
class ConsumerFake extends Consumer
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
     * @param MessageInterface $message
     * @return void
     */
    public function process(MessageInterface $message)
    {
        echo $message->getBody() . ' ... ok' . PHP_EOL;
    }
}