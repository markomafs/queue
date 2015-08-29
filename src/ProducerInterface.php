<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue;

use Queue\Driver\MessageInterface;

interface ProducerInterface extends InterfaceQueue
{
    /**
     * @param MessageInterface $message
     * @return void
     */
    public function publish(MessageInterface $message);
}
