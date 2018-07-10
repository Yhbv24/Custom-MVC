<?php

class User extends Database
{
    private static $tableName = 'users';
    private $db;

    public function __construct()
    {
        $this->db = parent::getInstance();
    }

    public function getUsers()
    {
        $query = 'SELECT * FROM ' . self::$tableName;

        return $this->db->query($query)->results();
    }
}