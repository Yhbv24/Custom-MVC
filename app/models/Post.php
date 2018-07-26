<?php

class Post extends Database
{
    private static $tableName = 'posts';
    private $db;

    public function __construct()
    {
        $this->db = parent::getInstance();
    }
}