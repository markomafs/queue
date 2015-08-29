<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue\Adapter\Configuration;


class RabbitMqConfig implements InterfaceConfiguration
{
    /**
     * @var
     */
    protected $host;

    /**
     * @var
     */
    protected $port;

    /**
     * @var
     */
    protected $username;

    /**
     * @var
     */
    protected $password;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->host = $config['host'];
        $this->port = $config['port'];
        $this->username = $config['username'];
        $this->password = $config['password'];
    }

    /**
     * @return mixed
     */
    public function host()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function password()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function port()
    {
        return $this->port;
    }

    /**
     * @return mixed
     */
    public function username()
    {
        return $this->username;
    }
}