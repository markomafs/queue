<?php

namespace Queue\Driver\Amqp;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Queue\AbstractQueue;
use Queue\ConfigurationInterface;
use Queue\ConsumerInterface;
use Queue\Driver\MessageInterface;
use Queue\InterfaceQueue;
use Queue\ProducerInterface;

class Connection implements \Queue\Driver\Connection
{
    /**
     * @var AMQPConnection
     */
    private $connection;
    /**
     * @var AMQPChannel[]
     */
    private $channels;

    public function __construct(ConfigurationInterface $configuration)
    {
        $this->connection = new AMQPConnection(
            $configuration->getHostname(),
            $configuration->getPort(),
            $configuration->getUsername(),
            $configuration->getPassword(),
            $configuration->getOption('vhost', '/'),
            $configuration->getOption('insist', false),
            $configuration->getOption('login_method', "AMQPLAIN"),
            $configuration->getOption('login_response', null),
            $configuration->getOption('locale', "en_US"),
            $configuration->getOption('connection_timeout', 3),
            $configuration->getOption('read_write_timeout', 3),
            $configuration->getOption('context', null),
            $configuration->getOption('keepalive', false),
            $configuration->getOption('heartbeat', 0)
        );
    }

    /**
     * @return void
     */
    public function close()
    {
        $this->connection->close();
    }

    /**
     * @param string $message
     * @param array $properties
     * @return MessageInterface
     */
    public function prepare($message, array $properties = array())
    {
        return new Message($message, $properties);
    }

    public function publish(MessageInterface $message, ProducerInterface $producer)
    {
        $this->declareQueue($producer);
        $channel = $this->getChannel($producer);
        $channel->basic_publish($message, $producer->getWorkingExchangeName());
    }

    /**
     * @param ConsumerInterface $consumer
     * @return MessageInterface|null
     */
    public function fetchOne(ConsumerInterface $consumer)
    {
        $this->declareQueue($consumer);
        $channel = $this->getChannel($consumer);

        $message = $channel->basic_get($consumer->getWorkingQueueName(), AbstractQueue::QUEUE_ACK);

        if (!$message) {
            return null;
        }
        return $this->prepare($message->body);
    }

    /**
     * @param InterfaceQueue $queue
     * @return AMQPChannel
     */
    protected function getChannel(InterfaceQueue $queue)
    {
        if (!isset($this->channels[$queue->getWorkingQueueName()])) {
            $this->channels[$queue->getWorkingQueueName()] = $this->connection->channel();
        }
        return $this->channels[$queue->getWorkingQueueName()];
    }

    protected function declareQueue(InterfaceQueue $queue)
    {
        $channel = $this->getChannel($queue);
        $channel->queue_declare(
            $queue->getWorkingQueueName(),
            AbstractQueue::QUEUE_NOT_PASSIVE,
            AbstractQueue::QUEUE_DURABLE,
            AbstractQueue::QUEUE_NOT_EXCLUSIVE,
            AbstractQueue::QUEUE_NOT_AUTO_DELETE,
            AbstractQueue::QUEUE_NO_WAIT,
            $queue->getQueueArguments()
        );
        $channel->exchange_declare($queue->getWorkingExchangeName(), AbstractQueue::CHANNEL_DIRECT);
        $channel->queue_bind($queue->getWorkingQueueName(), $queue->getWorkingExchangeName());
    }
}
