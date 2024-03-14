<?php

namespace nailfor\Couchbase\Couch;

use Illuminate\Database\Connectors\Connector;
use Illuminate\Database\Connectors\ConnectorInterface;

class PDOConnector extends Connector implements ConnectorInterface
{
    /**
     * Establish a database connection.
     *
     * @param  array  $config
     * @return PDO
     */
    public function connect(array $config)
    {
        $dsn = $this->getDsn($config);
        $options = $this->getOptions($config);

        // We need to grab the PDO options that should be used while making the brand
        // new connection instance. The PDO options control various aspects of the
        // connection's behavior, and some might be specified by the developers.
        $connection = $this->createConnection($dsn, $config, $options);

        if (! empty($config['database'])) {
            $connection->exec("use `{$config['database']}`;");
        }

        $this->configureIsolationLevel($connection, $config);

        return $connection;
    }

    /**
     * Set the connection transaction isolation level.
     *
     * @param  PDO  $connection
     * @param  array  $config
     * @return void
     */
    protected function configureIsolationLevel($connection, array $config)
    {
        if (! isset($config['isolation_level'])) {
            return;
        }

        ///TODO
        //$connection->???
    }

    /**
     * Create a DSN string from a configuration.
     *
     * Chooses socket or host/port based on the 'unix_socket' config value.
     *
     * @param  array  $config
     * @return string
     */
    protected function getDsn(array $config)
    {
        return $this->getHostDsn($config);
    }

    /**
     * Get the DSN string for a host / port configuration.
     *
     * @param  array  $config
     * @return string
     */
    protected function getHostDsn(array $config)
    {
        return $config['host'] ?? '';
    }

    protected function createPdoConnection($dsn, $username, $password, $options)
    {
        return new PDO($dsn, $username, $password, $options);
    }    
}
