<?php

namespace Controller;

use Model\Service\SessionService;
use Model\Service\TaskService;

/**
 * Class TaskController
 * @package Controller
 */
class TaskController extends BaseController
{
    /**
     *
     */
    public function EditTaskAction()
    {
        if (SessionService::getInstance()->getSessionData('login')  === SessionService::ADMIN_LOGIN) {
            $userName = $this->request->get('user');
            $userEmail = $this->request->get('email');
            $message = $this->request->get('message');
            $status = $this->request->get('status');
            $taskId = $this->request->get('id');
            $taskService = TaskService::getInstance();
            $taskService->EditTask($taskId, $userName, $userEmail, $message, $status);
        }
        header('Location: /index.php');
        exit();
    }

    /**
     *
     */
    public function showAddTaskAction()
    {
        $this->setTemplate('addTask');
        $this->showTemplate([]);
    }

    /**
     *
     */
    public function AddTaskAction()
    {
        $userName = $this->request->get('user');
        $userEmail = $this->request->get('email');
        $message = $this->request->get('message');
        $status = $this->request->get('status');
        $taskService = TaskService::getInstance();
        $taskService->AddTask($userName, $userEmail, $message, $status);
        header('Location: /index.php');
        exit();
    }
}
