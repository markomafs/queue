<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */
namespace Queue\Adapter\Message;

use PhpAmqpLib\Message\AMQPMessage;

class RabbitMqMessage extends AMQPMessage implements InterfaceMessage
{

}