<?php
/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


use mysqli;

class Database
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    public $connection;

    function __construct()
    {
        $this->servername = $_ENV['DB_SERVER'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->dbname = $_ENV['DB_NAME'];
    }

    public function setConnection()
    {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    public function getConnection()
    {
        $this->setConnection();

        return $this->connection;
    }
    
    public function init()
    {
        // check connection
        if ($this->getConnection()->connect_error) {
            die("database connection failed" . $this->getConnection()->connect_error);
        }
    }
}