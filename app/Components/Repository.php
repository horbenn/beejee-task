<?php


namespace App\Components;


use PDO;

abstract class Repository
{
    /**
     * @return string
     */
    abstract protected function model();

    /**
     * @param $sql
     * @param null $parameters
     * @return array
     */
    protected function fetchAll($sql, $parameters = null)
    {
        return db()->query($sql, $parameters)
            ->fetchAll(PDO::FETCH_CLASS, $this->model());
    }

    /**
     * @param $sql
     * @param null $parameters
     * @return mixed|null
     */
    protected function fetchOne($sql, $parameters = null)
    {
        return static::fetchAll($sql, $parameters)[0] ?? null;
    }

}