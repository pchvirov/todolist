<?php

namespace Model\Service;

/**
 * Class SessionService
 * @package Model\Service
 */
class SessionService
{
    const ADMIN_LOGIN = 'admin';
    const ADMIN_PASSWORD = 'admin';

    /**
     * @var SessionService
     */
    private static $instance;

    /**
     * SessionService constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return SessionService
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
     * @param string $key
     * @param mixed $data
     */
    public function saveSessionData($key, $data) {
        $_SESSION[$key] = $data;
    }

    /**
     * @param string $key
     */
    public function deleteSessionData($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getSessionData($key) {
        return $_SESSION[$key] ?? null;
    }
}
