<?php

namespace App\Components;


use PDO;
use PDOException;
use PDOStatement;

class Database
{
    /**
     * @var PDO
     */
    private $connection;

    public function __construct($config)
    {
        try {
            $this->connection = new PDO($this->getDsn($config), $config['username'], $config['password']);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $sql
     * @param null $parameters
     * @return PDOStatement
     */
    public function query($sql, $parameters = null)
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute($parameters);

        return $statement;
    }

    protected function getDsn(array $config)
    {
        /**
         * @var $host
         * @var $port
         * @var $database
         */
        extract($config);

        return isset($port)
            ? "mysql:host={$host};port={$port};dbname={$database}"
            : "mysql:host={$host};dbname={$database}";
    }

}