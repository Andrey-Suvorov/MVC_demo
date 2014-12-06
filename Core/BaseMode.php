<?php

namespace Core;

/**
 * Class BaseModel
 *
 * @package Core
 */
class BaseModel
{
    private $connection;

    private $preparedStatement;

    private $parameters;

    public function getConnection()
    {
        if (!$this->connection) {
            $this->connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
            $this->connection->exec('SET CHARACTER SET utf8');
        }

        return $this->connection;
    }

    public function setPreparedStatement($ps)
    {
        $this->preparedStatement = $ps;
        return $this;
    }

    public function setParameters($p)
    {
        $this->parameters = $p;
        return $this;
    }
}
