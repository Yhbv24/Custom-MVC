<?php

/**
 * Application core controller
 * ---------------------------
 * The base controller for the app
 */
abstract class Controller
{
    /**
     * @var Twig_Environment $view The Twig object, used to render templates
     * @var Model $model The controller's primary model
     * @var stdClass $varsToPass Array of data to pass to the view
     */
    protected $view;
    protected $model;
    protected $varsToPass;

    /**
     * Sets the Twig view
     * @return void
     */
    protected function __construct()
    {
        // Twig setup
        $loader = new Twig_Loader_Filesystem('../app/views');
        $this->view = new Twig_Environment($loader);
        $this->view->addExtension(new Twig_Extension_Debug());

        // Variables to pass into Twig template as an object
        $this->varsToPass = new stdClass();

        // Load constants
        $this->varsToPass->URL = URL;
        $this->varsToPass->APP_ROOT = APP_ROOT;
        $this->varsToPass->SITE_NAME = SITE_NAME;

        session_start();
        $this->varsToPass->SESSION = Session::all();
    }

    /**
     * Sets the controller's main model
     * @param string $model The string filename
     * @return void
     */
    protected function model(string $model)
    {
        if (file_exists('../app/models/' . $model . '.php')) {
            require_once('../app/models/' . $model . '.php');
        }

        $this->model = new $model;

        return $this->model;
    }

    /**
     * Renders templates
     * @param string $view The view filename
     * @return void
     */
    protected function view(string $view)
    {
        if (file_exists('../app/views/' . $view . '.html.twig')) {
            echo $this->view->render($view . '.html.twig', (array) $this->varsToPass);
        }
    }

    protected function redirect(string $page = '')
    {
        header('location: ' . URL . '/' . $page);
    }

    protected function beginSession(Object $user)
    {
        Session::set('first-name', $user->first_name);
        Session::set('last-name', $user->last_name);
        Session::set('email-address', $user->email_address);
        Session::set('user-id', $user->user_id);

        $this->redirect();
    }
}