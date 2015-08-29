<?php

namespace QueueTest\Fake;

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
}