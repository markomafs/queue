<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue;

use Queue\Driver\MessageInterface;

abstract class Producer extends AbstractQueue implements ProducerInterface
{

    /**
     * @param string $message
     * @return MessageInterface
     */
    public function prepare($message)
    {
        return $this->getConnection()->prepare($message);
    }

    /**
     * @param MessageInterface $message
     * @return void
     */
    final public function publish(MessageInterface $message)
    {
        $this->getConnection()->publish($message, $this);
    }
}
