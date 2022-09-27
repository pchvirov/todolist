<?php

namespace Controller;

use Model\Service\SessionService;
use Model\Service\TaskService;

/**
 * Class PageController
 * @package Controller
 */
class PageController extends BaseController
{
    const COUNT_TASK_ON_PAGE = 3;
    const ENABLE_SORTING_FIELDS = [
        'user',
        'email',
        'status'
    ];

    const ENABLE_SORTING_TYPES = [
        'asc',
        'desc'
    ];

    /**
     *
     */
    public function ShowTodoListAction()
    {
        $sessionService = SessionService::getInstance();
        $loginError = $sessionService->getSessionData('error') ?? '';
        $sessionService->deleteSessionData('error');

        $sortingField = $this->request->get('sorting') ?? '';
        $sortingType = $this->request->get('sorting_type') ?? '';

        $pageNumber = $this->request->get('page') ?? 1;

        $notEnableValuesForSortCondition = !in_array($sortingField, self::ENABLE_SORTING_FIELDS) || !in_array($sortingType, self::ENABLE_SORTING_TYPES);
        $notEmptyValueInSortCondition = ($sortingField !== '') || ($sortingType !== '');

        if ($notEnableValuesForSortCondition && $notEmptyValueInSortCondition) {
            $sessionService->saveSessionData('error', "You didn't choose all necessary options for sorting");
            header('Location: /index.php');
            die;
        }
        $numberFirstTaskOnPage = ($pageNumber - 1) * self::COUNT_TASK_ON_PAGE;
        $taskService = TaskService::getInstance();
        $countTasks = $taskService->getTaskCount();
        $countPages = ceil($countTasks / self::COUNT_TASK_ON_PAGE);
        $tasks = $taskService->getTasks(
            $numberFirstTaskOnPage,
            self::COUNT_TASK_ON_PAGE,
            $sortingField,
            $sortingType
        );

        $this->setTemplate('taskList');
        $argsForPaginator = $this->generateArgsForUrl($sortingField, $sortingType);
        $paginator = $this->ShowPages($pageNumber, $countPages, $argsForPaginator);

        $isAdmin = $sessionService->getSessionData('login') === SessionService::ADMIN_LOGIN;
        //выводится шаблон
        $this->showTemplate([
            'number_page' => $pageNumber,
            'tasks' => $tasks,
            'count_pages' => $countPages,
            'pages' => $paginator,
            'admin' => $isAdmin,
            'login_error' => $loginError,
            'sorting_field' => $sortingField,
            'sorting_type' => $sortingType

        ]);
    }

    /**
     * @param string $sortingField
     * @param string $sortingType
     * @return string
     */
    private function generateArgsForUrl($sortingField, $sortingType)
    {
        $result = '';
        if (in_array($sortingField, self::ENABLE_SORTING_FIELDS) && in_array($sortingType, self::ENABLE_SORTING_TYPES)) {
            $result = 'sorting=' . $sortingField . '&sorting_type=' . $sortingType . '&';
        }
        return $result;
    }
}
