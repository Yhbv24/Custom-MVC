<?php

class User extends Database
{
    private static $tableName = 'users';
    private $db;

    public function __construct()
    {
        $this->db = parent::getInstance();
    }
}