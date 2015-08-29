<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue;

use Queue\Message\MessageInterface;

interface ProducerInterface
{
    /**
     * @param string $message
     * @return MessageInterface
     */
    public function prepare($message);

    /**
     * @param MessageInterface $message
     * @return void
     */
    public function publish(MessageInterface $message);
}
