<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue;

use Queue\Adapter\Message\InterfaceMessage;

abstract class Producer extends AbstractQueue
{
    /**
     * @param mixed $message
     * @return InterfaceMessage
     */
    abstract public function handleMessage($message);

    /**
     * @param InterfaceMessage $message
     * @return void
     */
    final public function publish(InterfaceMessage $message)
    {
        $this->queueAdapter()->publish($this, $message);
    }
} 