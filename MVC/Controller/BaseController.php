<?php

namespace Controller;

use Model\Entity\Request;

/**
 * Class BaseController
 * @package Controller
 */
class BaseController
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var string
     */
    protected $template;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @param array $params
     * @param null $template
     */
    protected function showTemplate($params = [], $template = null)
    {
        if (is_null($template)) {
            $template = $this->getTemplate();
        }
        extract($params);
        include SITE_PATH . '/MVC/View/' . $template . '.html';
    }

    /**
     * @param int $currentPageNumber
     * @param int $countPages
     * @param string $route
     * @return string
     */
    public function ShowPages($currentPageNumber, $countPages, $route="")
    {
        $html = '<div class="text-center">';
        for ($pageNumber = 1; $pageNumber <= $countPages; $pageNumber++) {
            if (($pageNumber == $currentPageNumber) and ($pageNumber == $countPages)) {
                $html .= "[$pageNumber].";
            }
            elseif ($pageNumber == $countPages) {
                $html .= '<a href=' . RELATIVE_PATH . '/index.php?' . $route . 'page=' . $pageNumber . '>[' . $pageNumber . ']</a>.';
            }
            elseif ($pageNumber == $currentPageNumber) {
                $html .= "[$pageNumber],";
            }
            elseif (($pageNumber < 6) or (abs($pageNumber - $currentPageNumber) < 3) or (($countPages - $pageNumber) < 6)) {
                $html .= '<a href=' . RELATIVE_PATH . '/index.php?' . $route . 'page=' . $pageNumber . '>[' . $pageNumber . ']</a>,';
            }
            elseif ((($pageNumber == 6) and ($currentPageNumber < 10)) or (($pageNumber == $countPages - 6) and ($currentPageNumber > $countPages - 10))) {
                $html .= "...";
            }
            elseif (abs($pageNumber - $currentPageNumber) == 3) {
                $html .="...";
            }
        }
        $html .= '</div>';

        return $html;
    }
}
