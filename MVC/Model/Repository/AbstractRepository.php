<?php

namespace Model\Repository;

use Model\Repository\DbWorker\Config\DbWorkerConfig;
use Model\Repository\DbWorker\DbWorker;

/**
 * Class AbstractRepository
 * @package Model\Repository
 */
class AbstractRepository
{
    /**
     * @var DbWorker
     */
    private $worker;

    /**
     * AbstractRepository constructor.
     */
    public function __construct()
    {
        $dbWorkerConfig = new DbWorkerConfig();
        $this->worker = new DbWorker($dbWorkerConfig);
    }

    /**
     * @param $query
     * @return array
     */
    protected function executeQuery($query)
    {
        return $this->worker->executeQuery($query);
    }

    /**
     * @param $query
     * @return bool
     */
    protected function executeUpdate($query)
    {
        return (bool) $this->worker->updateQuery($query);
    }

    /**
     * @param $string
     * @return string
     */
    protected function escapeString($string)
    {
        return $this->worker->escapeString($string);
    }
}
