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
    private $charset = DB_CHARSET;

    private $dbh;
    private $stmt;
    private $error;
    private static $instance = null;
  
    /**
     * Database constructor
     * Sets up database
     * @return void
     */
    private function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;

        // Set options
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $ex) {
            $this->error = $ex->getMessage();
            echo $this->error;
        }
    }

    /**
     * Returns instance of the database
     * @return void
     */
    protected static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Prepares query
     * @param string $sql The query to run
     * @return void
     */
    public function query(string $sql)
    {
        $this->stmt = $this->dbh->prepare($sql);

        return $this;
    }

    /**
     * Binds query
     * @param mixed $param
     * @param mixed $value
     * @param mixed $type
     * @return void
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Executes query
     * @return mixed
     */
    public function execute()
    {
        return $this->stmt->execute();
    }

    /**
     * Returns results of the query as an object
     * @return Object Query results
     */
    public function results()
    {
        $this->execute();

        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Returns a single row
     * @return Object Query results
     */
    public function single()
    {
        $this->execute();
        
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Gets count of rows
     * @return int Count of returned rows
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}