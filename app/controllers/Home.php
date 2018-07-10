<?php

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = $this->model('User');
    }

    /**
     * The index page
     * @return void
     */
    public function index()
    {
        $this->varsToPass->users = $this->model->getUsers();
        $this->view('index');
    }
}