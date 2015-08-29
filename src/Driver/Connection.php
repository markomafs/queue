<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue\Driver;

use Queue\ConsumerInterface;
use Queue\ProducerInterface;

interface Connection
{
    const DRIVER_AMQP = 'amqp';

    /**
     * @return void
     */
    public function close();

    /**
     * @param MessageInterface $message
     * @param ProducerInterface $producer
     * @return void
     */
    public function publish(MessageInterface $message, ProducerInterface $producer);

    /**
     * @param string $message
     * @param array $properties
     * @return MessageInterface
     */
    public function prepare($message, array $properties = array());

    /**
     * @param ConsumerInterface $consumer
     * @return MessageInterface|null
     */
    public function fetchOne(ConsumerInterface $consumer);
}
