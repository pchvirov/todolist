<?php

namespace Model\Repository;

/**
 * Class TaskRepository
 * @package Model\Repository
 */
class TaskRepository extends AbstractRepository
{
    /**
     * @param int $id
     * @return array
     */
    public function getTaskById($id)
    {
        $query = 'SELECT * FROM task WHERE id=' . (int) $id;
        return $this->executeQuery($query);
    }

    /**
     * @param int $from
     * @param int $count
     * @param string $sortKey
     * @param string $sortType
     * @return array
     */
    public function getTasks($from = 0, $count = 0, $sortKey = '', $sortType = 'ASC')
    {
        $sortKey = $this->escapeString($sortKey);
        $sortType = $this->escapeString($sortType);
        $query = 'SELECT * FROM task ';
        if ($sortKey) {
            $query .= ' ORDER BY `' . $sortKey . '` ' . $sortType;
        }
        if ($count) {
            $query .= ' LIMIT ' . $count . ' OFFSET ' . $from;
        }

        return $this->executeQuery($query);
    }

    /**
     * @param string $userName
     * @param string $userEmail
     * @param string $message
     * @param string $status
     * @return bool
     */
    public function addTask($userName, $userEmail, $message, $status)
    {
        $userName = $this->escapeString($userName);
        $userEmail = $this->escapeString($userEmail);
        $message = $this->escapeString($message);
        $status = $this->escapeString($status);

        $query = "INSERT INTO task(`user`, `email`, `message`, `status`) VALUES ('$userName', '$userEmail', '$message', '$status')";
        return $this->executeUpdate($query);
    }

    /**
     * @param int $taskId
     * @param string $userName
     * @param string $userEmail
     * @param string $message
     * @param string $status
     * @return bool
     */
    public function editTask($taskId, $userName, $userEmail, $message, $status)
    {
        $userName = $this->escapeString($userName);
        $userEmail = $this->escapeString($userEmail);
        $message = $this->escapeString($message);
        $status = $this->escapeString($status);

        $query = "UPDATE task SET `user`='$userName', `email`='$userEmail', `message`='$message', `status`='$status' WHERE id=" . (int) $taskId;
        return $this->executeUpdate($query);
    }

    /**
     * @return mixed
     */
    public function getTaskCount()
    {
        $query = 'SELECT count(*) as c FROM task';
        return $this->executeQuery($query)[0]['c'];
    }
}
