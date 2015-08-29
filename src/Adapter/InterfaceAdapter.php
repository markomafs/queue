<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue\Adapter;

use Queue\Adapter\Message\InterfaceMessage;
use Queue\Producer;

interface InterfaceAdapter
{
    function close();

    function publish(Producer $producer, InterfaceMessage $message);

    /**
     * @return InterfaceMessage
     */
    function getMessageObject();

    function buildMessage($message, array $properties = array());

}