<?php

namespace Model\Entity;

/**
 * Class Request
 * @package Model\Entity
 */
class Request
{
    /**
     * @var array
     */
    private $getData;

    /**
     * @var array
     */
    private $postData;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->getData = $_GET;
        $this->postData = $_POST;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        $result = null;
        if (isset($this->getData[$key])) {
            $result = $this->getData[$key];
        } elseif(isset($this->postData[$key])) {
            $result = $this->postData[$key];
        }
        return $result;
    }
}
