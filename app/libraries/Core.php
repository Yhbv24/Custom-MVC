<?php

/**
 * Application core class
 * ----------------------
 * Creates URL and loads core controller
 * URL Format -- /controller/method/params
 */
class Core
{
    /**
     * @var $currentController - The current controller
     * @var $currentMethod - The current method on that controller
     * @var $params - The separated controller/method/params
     */
    protected $currentController = 'Home';
    protected $currentMethod = 'index';
    protected $params = [];

    /**
     * Core constructor - Responsible for setting the controller and its methods
     * @return void
     */
    public function __construct()
    {
        $url = $this->getURL();

        // Check if controller exists, set that to the current controller
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        // Require the controller and instantiate it
        require_once('../app/controllers/' . $this->currentController . '.php');
        $this->currentController = new $this->currentController;

        // Check for methods within controller and set it to the current method
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    /**
     * Gets the URL
     * @return array Split up URL
     */
    private function getURL()
    {
        if (isset($_SERVER['QUERY_STRING'])) {
            $url = str_replace('url=', '', $_SERVER['QUERY_STRING']);
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}