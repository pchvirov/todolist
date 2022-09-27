<?php

namespace Model\Service;

use Model\Repository\TaskRepository;

/**
 * Class TaskService
 * @package Model\Service
 */
class TaskService
{
    /**
     * @var TaskService
     */
    private static $instance;

    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * TaskService constructor.
     */
    protected function __construct()
    {
        $this->taskRepository = new TaskRepository();
    }

    /**
     * @return TaskService
     */
    public static function getInstance()
    {
        if (is_null(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param int $from
     * @param int $count
     * @param string $sortKey
     * @param string $sortType
     * @return array
     */
    public function getTasks($from, $count, $sortKey, $sortType)
    {
        return $this->taskRepository->getTasks($from, $count, $sortKey, $sortType);
    }

    /**
     * @param string $userName
     * @param string $userEmail
     * @param string $message
     * @param string $status
     * @return bool
     */
    public function AddTask($userName, $userEmail, $message, $status)
    {
        return $this->taskRepository->addTask($userName, $userEmail, $message, $status);
    }

    /**
     * @param int $taskId
     * @param string $userName
     * @param string $userEmail
     * @param string $message
     * @param string $status
     * @return bool
     */
    public function EditTask($taskId, $userName, $userEmail, $message, $status)
    {
        return $this->taskRepository->editTask($taskId, $userName, $userEmail, $message, $status);
    }

    /**
     * @return mixed
     */
    public function getTaskCount()
    {
        return $this->taskRepository->getTaskCount();
    }
}
