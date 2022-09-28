<?php

namespace Model\Repository\DbWorker\Config;

/**
 * Class DbWorkerConfig
 * @package Model\Repository\DbWorker\Config
 */
class DbWorkerConfig
{
    private const CONFIG = [
        'host' => '127.0.0.1',
        'username' => 'admin',
        'password' => 'admin',
        'dbname' => 'todolist',
        'port' => 3306
    ];

    /**
     * @return string
     */
    public function getHost()
    {
        return self::CONFIG['host'];
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return self::CONFIG['username'];
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return self::CONFIG['password'];
    }

    /**
     * @return string
     */
    public function getDbName()
    {
        return self::CONFIG['dbname'];
    }
    
    /**
     * @return int
     */
    public function getPort()
    {
        return self::CONFIG['port'];
    }
}
