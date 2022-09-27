<?php

/**
 * Class Router
 */
class Router
{
    /**
     * Router constructor.
     */
    public function __construct()
    {
        $action = $_REQUEST['action'] ?? 'tasklist';

        switch ($action) {
            case 'tasklist' : $this->CallController('PageController', 'ShowTodoListAction');
                break;
            case 'login' : $this->CallController('LoginController', 'LoginAction');
                break;
            case 'logout' : $this->CallController('LoginController', 'LogoutAction');
                break;
            case 'edit' : $this->CallController('TaskController', 'EditTaskAction');
                break;
            case 'create' : $this->CallController('TaskController', 'showAddTaskAction');
                break;
            case 'add' : $this->CallController('TaskController', 'AddTaskAction');
                break;
            default://если нет контроллера перенаправление на 404 страницу
                header('Location: 404.html');
                exit;
        }
    }

    /**
     * @param string $controllerName
     * @param string $action
     */
    private function CallController($controllerName, $action)
    {
        $fullControllerName = '\\Controller\\' .$controllerName;
        $controller = new $fullControllerName();
        call_user_func([$controller, $action]);
    }
}
