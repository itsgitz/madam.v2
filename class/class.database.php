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
        if ($this->getConnection()->connect_errno) {
            die('database connection failed' . $this->getConnection()->connect_error);
        }

        if (!$this->isMigrations()) {
            $this->runMigrations();
        }
    }

    private function getNumOfTables()
    {
        $tables = [
            $_ENV['CUSTOMER_TABLE'],
            $_ENV['USER_TABLE'],
            $_ENV['CID_TABLE'],
            $_ENV['ACCESS_RIGHTS_TABLE'],
            // $_ENV['NETWORKING_TABLE']
        ];

        $num = count($tables);

        return $num;
    }

    public function isMigrations()
    {
        $showTables = 'SHOW TABLES';
        $result = $this->getConnection()->query($showTables);

        if ($result->num_rows != $this->getNumOfTables()) {
            return false;
        } else {
            return true;
        }
    }

    public function runMigrations()
    {
        $this->migrationCreateTable();
        $this->migrationSeeder();
    }

    private function migrationCreateTable()
    {

        $sqlQuery = [];

        // sql query for create customer table
        $sqlQuery['create_customer_table'] = "CREATE TABLE IF NOT EXISTS {$_ENV['CUSTOMER_TABLE']} (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            customer_name VARCHAR(128) NOT NULL,
            sales_name VARCHAR(128) NOT NULL,
            segmentation VARCHAR(64) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
        ";

        // sql query for create user table
        $sqlQuery['create_user_table'] = "CREATE TABLE IF NOT EXISTS {$_ENV['USER_TABLE']} (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(64) NOT NULL,
            username VARCHAR(32) NOT NULL,
            password VARCHAR(256) NOT NULL,
            email VARCHAR(128) NOT NULL,
            activated VARCHAR(16) NOT NULL,
            user_role VARCHAR(64) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
        ";

        // sql query for create cid table 
        $sqlQuery['create_cid_table'] = "CREATE TABLE IF NOT EXISTS {$_ENV['CID_TABLE']} (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            cid VARCHAR(64) NOT NULL,
            service_name VARCHAR(64) NOT NULL,
            customer_name VARCHAR(128) NOT NULL,
            location VARCHAR(64) NOT NULL,
            rack_location VARCHAR(64) NOT NULL,
            u_location VARCHAR(32) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
        ";

        // sql query for create access_rights table
        $sqlQuery['create_access_rights_table'] = "CREATE TABLE IF NOT EXISTS {$_ENV['ACCESS_RIGHTS_TABLE']} (
            id INT (6) AUTO_INCREMENT PRIMARY KEY,
            customer_id INT(6) NOT NULL,
            name VARCHAR(64) NOT NULL,
            company_name VARCHAR(64) NOT NULL,
            identity_number VARCHAR(64) NOT NULL,
            email VARCHAR(64) NOT NULL,
            FOREIGN KEY (customer_id) REFERENCES {$_ENV['CUSTOMER_TABLE']}(id)
        )";

        // $sqlQuery['create_networking_table'] = "CREATE TABLE IF NOT EXISTS {$_ENV['NETWORKING_TABLE']}
        //     ";

        // run migrations queries
        foreach ($sqlQuery as $q) {
            if (!$this->getConnection()->query($q)) {
                die('Unable to run migrations query: ' . $q . ', error: ' . $this->getConnection()->error);
            }
        }

        $this->getConnection()->close();
    }

    private function migrationSeeder()
    {
        $customerSeeder     = "INSERT INTO {$_ENV['CUSTOMER_TABLE']} (customer_name, sales_name, segmentation)
            VALUES ('Bank QNB Indonesia', 'Sivi Paramudhita', 'Finance');";

        $customerSeeder     .= "INSERT INTO {$_ENV['CUSTOMER_TABLE']} (customer_name, sales_name, segmentation)
            VALUES ('Citiink Indonesia', 'Ahmad Nurwakhid', 'Transportation');";

        $customerSeeder     .= "INSERT INTO {$_ENV['CUSTOMER_TABLE']} (customer_name, sales_name, segmentation)
            VALUES ('Dummy Dumb Indonesia', 'Dummy Sudrajat', 'Services')";

        $hashedPassword = password_hash($_ENV['DB_PASSWORD'], PASSWORD_DEFAULT);

        $userSeeder     = "INSERT INTO {$_ENV['USER_TABLE']} (name, username, password, email, activated, user_role)
            VALUES ('Gatta Pherasi Aditama', 'gtt', '{$hashedPassword}', 'gatta.aditama@lintasarta.co.id', 'Yes', 'Administrator');";

        $userSeeder     .= "INSERT INTO {$_ENV['USER_TABLE']} (name, username, password, email, activated, user_role)
            VALUES ('Ellan Marsage', 'ell', '{$hashedPassword}', 'ellan.marsage@lintasarta.co.id', 'Yes', 'Technician');";

        $userSeeder     .= "INSERT INTO {$_ENV['USER_TABLE']} (name, username, password, email, activated, user_role)
                VALUES ('Dummy Dumb', 'dmm', '{$hashedPassword}', 'dummy.dumb@lintasarta.co.id', 'Yes', 'Technician')";

        $cidSeeder  = "INSERT INTO {$_ENV['CID_TABLE']} (cid, service_name, customer_name, location, rack_location, u_location)
            VALUES ('2012006972', 'DRC', 'Bank QNB Indonesia', 'TBS Lt. 1', 'Cage A', 'U1-45');";
        
        $cidSeeder  .= "INSERT INTO {$_ENV['CID_TABLE']} (cid, service_name, customer_name, location, rack_location, u_location)
            VALUES ('2020000020', 'Facility Management', 'Dummy Dumb Indonesia', 'TBS Lt. 1', 'Cage B', 'U1-45')";

        // customer data seeder
        if ($this->getConnection()->query("SELECT * FROM {$_ENV['CUSTOMER_TABLE']}")->num_rows < 3) {
            $this->getConnection()->multi_query($customerSeeder);
        }

        // user data seeder
        if ($this->getConnection()->query("SELECT * FROM {$_ENV['USER_TABLE']}")->num_rows < 3) {
            $this->getConnection()->multi_query($userSeeder);
        }

        // cid data seeder
        if ($this->getConnection()->query("SELECT * FROM {$_ENV['CID_TABLE']}")->num_rows < 2) {
            $this->getConnection()->multi_query($cidSeeder);
        }

        $this->getConnection()->close();
    }
}
