<?php

/**
 * Class App
 */
class App
{
    private $controller;
    private $method;
    private $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        // set data parsed
        $this->setProperties($url);
        // inject parameters in method
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Parse url and made the array
     * @return array
     */
    private function parseUrl()
    {
        if (isset($_GET['path'])) {
            return $url = explode('/', filter_var(rtrim($_GET['path'], '/'), FILTER_SANITIZE_URL));
        }
    }

    /**
     * set controller, method and params
     * @param $url
     */
    private function setProperties($url)
    {
        $url = $this->setController($url);
        $url = $this->setMethod($url);
        $this->setParameter($url);
    }

    /**
     * iniciate the controller class
     */
    private function callController()
    {
        if (empty($this->controller)) {
            header("Location: Home/index");
            exit;
        }
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller();
    }

    private function setController($url)
    {
        if (file_exists('../app/controllers/'.$url[0].'.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        $this->callController();

        return $url;
    }
    private function setMethod($url)
    {
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        return $url;
    }
    private function setParameter($url)
    {
        $this->params = $url ? array_values($url) : [];
    }
}