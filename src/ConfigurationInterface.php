<?php
/**
 * @author Marco.Souza<marco.souza@tricae.com.br>
 * @since 2015.08.28
 *
 */

namespace Queue;

interface ConfigurationInterface
{
    /**
     * @return string
     */
    public function getDriver();

    public function getUsername();

    public function getPassword();

    public function getHostname();

    public function getPort();

    public function getOption($name, $defaultValue = null);
}
