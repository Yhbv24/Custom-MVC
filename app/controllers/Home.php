<?php

class Home extends Controller
{
    /**
     * The index page
     * @return void
     */
    public function index()
    {
        $this->varsToPass->title = 'Welcome';
        $this->view('index');
    }
}