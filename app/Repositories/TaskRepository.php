<?php

namespace App\Repositories;


use App\Components\Repository;
use App\Models\Task;

class TaskRepository extends Repository
{
    /**
     * @return string
     */
    protected function model()
    {
        return Task::class;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->fetchAll('select * from tasks');
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public function getById($id)
    {
        return $this->fetchOne('select * from tasks where id = ?', [$id]);
    }

    /**
     * @return int
     */
    public function total()
    {
        return (int)$this->fetchOne('select count(*) as total from tasks')->total;
    }

    /**
     * @param int $page
     * @param int $limit
     * @param null $orderBy
     * @return array
     */
    public function paginate($page = 1, $limit = 3, $orderBy = null)
    {
        $page = intval($page);
        $limit = intval($limit);

        if ($page < 1) {
            $page = 1;
        }

        $offset = ($page - 1) * $limit;

        if (in_array($orderBy, ['username', 'email', 'status'])) {
            $orderBy = 'order by '.$orderBy;
        }

        return $this->fetchAll("select * from tasks {$orderBy} limit {$limit} offset {$offset}");
    }

    /**
     * @param Task $object
     */
    public function save($object)
    {
        $username = $object->getUsername();
        $email = $object->getEmail();
        $status = $object->getStatus();
        $description = $object->getDescription();

        db()->query("insert into tasks(username, email, status, description) values ({$username}, {$email}, {$status}, {$description})");
    }


}