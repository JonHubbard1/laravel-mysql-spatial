<?php

namespace JonHubbard1\LaravelMysqlSpatial;

use Doctrine\DBAL\Connection as DoctrineConnection;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Database\Schema\MySqlBuilder;
use JonHubbard1\LaravelMysqlSpatial\Schema\Grammars\MySqlGrammar as SpatialGrammar;
use JonHubbard1\LaravelMysqlSpatial\Schema\MySqlBuilder as SpatialBuilder;

class MysqlConnection extends \Illuminate\Database\MySqlConnection
{
    /**
     * Get a schema builder instance for the connection.
     */
    public function getSchemaBuilder(): MySqlBuilder
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }

        return new SpatialBuilder($this);
    }

    /**
     * Get the default schema grammar instance.
     */
    protected function getDefaultSchemaGrammar(): Grammar
    {
        return $this->withTablePrefix(new SpatialGrammar);
    }

    /**
     * Laravel 12 (DBAL 4) compatibility - Get the Doctrine Schema Manager.
     */
    public function getDoctrineSchemaManager(): \Doctrine\DBAL\Schema\AbstractSchemaManager
    {
        return $this->getDoctrineConnection()->createSchemaManager();
    }

    /**
     * Laravel 12 (DBAL 4) compatibility - Get the Doctrine DBAL connection instance.
     */
    public function getDoctrineConnection(): DoctrineConnection
    {
        if (!$this->doctrineConnection) {
            $driver = $this->getDoctrineDriver();
            $config = new \Doctrine\DBAL\Configuration();

            $this->doctrineConnection = new DoctrineConnection(
                $this->getDoctrineConnectionParameters(),
                $driver,
                $config
            );
        }

        return $this->doctrineConnection;
    }

    /**
     * Get the Doctrine DBAL driver.
     */
    protected function getDoctrineDriver()
    {
        return new \Doctrine\DBAL\Driver\PDOMySql\Driver();
    }

    /**
     * Get the connection parameters for Doctrine DBAL.
     */
    protected function getDoctrineConnectionParameters(): array
    {
        return [
            'dbname'    => $this->getDatabaseName(),
            'user'      => $this->getConfig('username'),
            'password'  => $this->getConfig('password'),
            'host'      => $this->getConfig('host'),
            'driver'    => 'pdo_mysql',
            'port'      => $this->getConfig('port'),
            'charset'   => $this->getConfig('charset') ?? 'utf8mb4',
        ];
    }
}
