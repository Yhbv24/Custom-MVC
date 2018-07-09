<?php

class User extends Database
{
    protected $db;

    public function __construct()
    {
        $this->db = parent::getInstance();
    }
}