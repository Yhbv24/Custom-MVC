<?php

class About extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = $this->model('User');
    }

    public function index()
    {
        $this->view('about');
    }
}