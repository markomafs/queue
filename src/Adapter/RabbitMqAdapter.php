<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue\Adapter;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPConnection;
use Queue\AbstractQueue;
use Queue\Adapter\Configuration\RabbitMqConfig;
use Queue\Adapter\Message\InterfaceMessage;
use Queue\Adapter\Message\RabbitMqMessage;
use Queue\Producer;

class RabbitMqAdapter implements InterfaceAdapter
{
    /**
     * @var $this
     */
    protected static $_instance;

    /**
     * @var AMQPChannel[]
     */
    protected $channels;

    /**
     * @var AMQPConnection
     */
    protected $connection;

    /**
     * @var RabbitMqConfig
     */
    private $config;

    /**
     * @param RabbitMqConfig $config
     */
    private function __construct(RabbitMqConfig $config)
    {
        $this->config = $config;
    }

    public function __destruct()
    {
        $this->channels = array();
        $this->close();
    }

    /**
     * @return void
     */
    public function close()
    {

    }

    /**
     * @param RabbitMqConfig $configuration
     * @return RabbitMqAdapter
     */
    public static function create(RabbitMqConfig $configuration)
    {
        if (!static::getInstance() instanceof RabbitMqAdapter) {
            self::$_instance = new static($configuration);
        }
        return static::getInstance();
    }

    /**
     * @return $this
     */
    public static function getInstance()
    {
        return self::$_instance;
    }

    protected function connect()
    {
        $this->connection = new AMQPConnection(
            $this->config->host(),
            $this->config->port(),
            $this->config->username(),
            $this->config->password()
        );
    }

    public function connection()
    {
        if ($this->connection == null) {
            $this->connect();
        }
        return $this->connection;
    }

    public function publish(Producer $producer, InterfaceMessage $message)
    {
        $this->declareQueue($producer);
            $channel = $this->getChannel($producer);
            $channel->basic_publish($message, $producer->getWorkingExchangeName());
    }

    public function declareQueue(AbstractQueue $queue)
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

    public function getChannel(AbstractQueue $queue)
    {
        if (!isset($this->channels[$queue->getWorkingQueueName()])) {
            $this->channels[$queue->getWorkingQueueName()] = $this->buildChannel();
        }
        return $this->channels[$queue->getWorkingQueueName()];
    }

    /**
     * @param string $channelId
     * @return \PhpAmqpLib\Channel\AMQPChannel
     */
    protected function buildChannel($channelId = null)
    {
        return $this->connection()->channel($channelId);
    }

    /**
     * @return InterfaceMessage
     */
    public function getMessageObject()
    {
        return new RabbitMqMessage();
    }

    public function buildMessage($message, array $properties = array())
    {
        $properties = array_merge(
            array('delivery_mode' => AbstractQueue::MESSAGE_PERSISTENT),
            $properties
        );
        return new RabbitMqMessage($message, $properties);
    }
}