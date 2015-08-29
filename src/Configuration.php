<?php

namespace Queue;

class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    private $driver;
    /**
     * @var string
     */
    private $hostname;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;
    /**
     * @var int
     */
    private $port;
    /**
     * @var array
     */
    private $options;

    public function __construct(
        $driver,
        $hostname = null,
        $port = null,
        $username = null,
        $password = null,
        array $options = array()
    ) {
        $this->driver = $driver;
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    public function getOption($name, $defaultValue = null)
    {
        if (!isset($this->options[$name])) {
            return $defaultValue;
        }
        return $this->options[$name];
    }
}
