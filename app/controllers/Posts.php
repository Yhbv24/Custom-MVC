<?php

class Posts extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = $this->model('Post');
    }

    public function index()
    {
        $this->view('posts/posts');
    }
}