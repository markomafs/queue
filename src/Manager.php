<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue;


use Queue\Adapter\InterfaceAdapter;

class Manager
{
    /**
     * @var InterfaceAdapter
     */
    private $queueAdapter;

    /**
     * @param InterfaceAdapter $queueAdapter
     */
    public function __construct(InterfaceAdapter $queueAdapter)
    {
        $this->queueAdapter = $queueAdapter;
    }

    /**
     * @return InterfaceAdapter
     */
    public function getAdapter()
    {
        return $this->queueAdapter;
    }

    /**
     * @return Message\InterfaceMessage
     */
    public function getMessageObject()
    {
        return $this->queueAdapter->getMessageObject();
    }
}