<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue;


use Queue\Adapter\InterfaceAdapter;

abstract class AbstractQueue implements InterfaceQueue
{

    /**
     * @var InterfaceAdapter
     */
    private $queueAdapter;

    public function __construct(InterfaceAdapter $queueAdapter)
    {
        $this->queueAdapter = $queueAdapter;
    }

    /**
     * @return InterfaceAdapter
     */
    public function queueAdapter()
    {
        return $this->queueAdapter;
    }

    abstract public function getWorkingQueueName();

    abstract public function getWorkingExchangeName();

    public function close()
    {
        $this->queueAdapter->close();
    }

    public function getQueueArguments()
    {
        return array();
    }
} 