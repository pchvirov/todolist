<?php

namespace Controller;

use Model\Service\SessionService;

/**
 * Class LoginController
 * @package Controller
 */
class LoginController extends BaseController
{
    /**
     *
     */
    public function LoginAction()
    {
        $login = $this->request->get('login') ?? '';
        $password = $this->request->get('password') ?? '';
        if (($login === SessionService::ADMIN_LOGIN) && ($password === SessionService::ADMIN_PASSWORD)) {
            SessionService::getInstance()->saveSessionData('login', $login);
        } else {
            SessionService::getInstance()->saveSessionData('error', 'Wrong login or password.');
        }
        header('Location: /index.php');
        exit();
    }

    /**
     *
     */
    public function LogoutAction()
    {
        SessionService::getInstance()->deleteSessionData('login');
        header('Location: /index.php');
        exit();
    }
}