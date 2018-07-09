<?php

/**
 * Application database class
 * --------------------------
 * Singleton - Instantiates the database with PDO
 */
class Database
{
    /**
     * @var string $host The DB host name
     */
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASSWORD;
    private $dbName = DB_NAME;
    private $dbh;
    private $stmt;
    private $error;
    private static $instance = null;
  
    private function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;

        // Set options
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $ex) {
            $this->error = $ex->getMessage();
        }
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }
}