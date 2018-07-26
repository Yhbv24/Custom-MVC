<?php

class User extends Database
{
    private static $tableName = 'users';
    private $db;

    public function __construct()
    {
        $this->db = parent::getInstance();
    }

    /**
     * Checks is email exists
     * @param string $email
     * @return bool
     */
    public function isEmailAvailable(string $email)
    {
        $sql = 'SELECT email_address FROM users WHERE email_address = :emailAddress;';

        $this->db->prepare($sql);
        $this->db->bind([':emailAddress' => $email]);

        $row = $this->db->single();

        if (!empty($row)) {
            return false;
        }

        return true;
    }

    /**
     * Registers a user
     * @param array $params
     * @return void
     */
    public function register(array $params)
    {
        $userSql = 'INSERT INTO users (password, first_name, last_name, email_address, created_at)
                    VALUES (:password, :first_name, :last_name, :email_address, NOW());';
        $this->db->prepare($userSql);

        $bindValues = [
            ':password' => $params['password'],
            ':first_name' => $params['first-name'],
            ':last_name' => $params['last-name'],
            ':email_address' => $params['email-address']
        ];

        $this->db->bind($bindValues);
        $this->db->execute($userSql);
    }

    /**
     * Check user's credentials and make sure they are valid
     * @param string $email
     * @param string $password
     * @return Object|false User object or false
     */
    public function login(string $email, string $password)
    {
        $sql = 'SELECT *
                FROM users
                WHERE email_address = :emailAddress';
        $this->db->prepare($sql);
        $this->db->bind(['emailAddress' => $email]);

        $row = $this->db->single();

        if (password_verify($password, $row->password)) {
            return $row;
        }

        return false;
    }
}