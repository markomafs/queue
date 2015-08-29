<?php

namespace Queue\Driver\Amqp;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPConnection;
use Queue\AbstractQueue;
use Queue\ConfigurationInterface;
use Queue\Driver\MessageInterface;

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

    public function publish(MessageInterface $message, AbstractQueue $queue)
    {
        $this->declareQueue($queue);
        $channel = $this->getChannel($queue);
        $channel->basic_publish($message, $queue->getWorkingExchangeName());
    }

    /**
     * @param AbstractQueue $queue
     * @return AMQPChannel
     */
    protected function getChannel(AbstractQueue $queue)
    {
        if (!isset($this->channels[$queue->getWorkingQueueName()])) {
            $this->channels[$queue->getWorkingQueueName()] = $this->connection->channel();
        }
        return $this->channels[$queue->getWorkingQueueName()];
    }

    protected function declareQueue(AbstractQueue $queue)
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