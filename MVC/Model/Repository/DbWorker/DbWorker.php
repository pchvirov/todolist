<?php

namespace Model\Repository\DbWorker;

use Model\Repository\DbWorker\Config\DbWorkerConfig;
use mysqli;
use mysqli_result;

/**
 * Class DbWorker
 * @package Model\Repository\DbWorker
 */
class DbWorker
{
    /**
     * @var DbWorkerConfig
     */
    private $config;

    /**
     * @var mysqli
     */
    private $mysqli;

    /**
     * DbWorker constructor.
     * @param DbWorkerConfig $config
     */
    public function __construct(DbWorkerConfig $config)
    {
        $this->config = $config;
        $this->mysqli = new mysqli(
            $this->config->getHost(),
            $this->config->getUsername(),
            $this->config->getPassword(),
            $this->config->getDbName()
        );
        if ($this->mysqli->connect_error) {
            echo 'error connect to db';
            die;
        }
    }

    /**
     * @param $query
     * @return array
     */
    public function executeQuery($query)
    {
        $result = [];
        $queryResult = $this->mysqli->query($query);
        if ($queryResult !== false) {
            while ($row = $queryResult->fetch_assoc()) {
                $result[] = $row;
            }
        }
        return $result;
    }

    /**
     * @param $query
     * @return bool|mysqli_result
     */
    public function updateQuery($query)
    {
        return $this->mysqli->query($query);
    }

    /**
     * @param $string
     * @return string
     */
    public function escapeString($string)
    {
        return $this->mysqli->real_escape_string($string);
    }
}
