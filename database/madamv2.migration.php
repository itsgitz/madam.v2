<?php
/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

require './vendor/autoload.php';

use Madam\App;
use Madam\Database;

// load .env file using App class
$app = new App();
$app->loadEnv();

// initialize Database instance
$db = new Database();

$db->init();
$conn = $db->getConnection();

// define query variable as array
$query = [];

// create database query
$query['create_database'] = "CREATE DATABASE IF NOT EXISTS {$_ENV['DB_NAME']}";
$query['create_customer_table'] = "CREATE TABLE IF NOT EXISTS {$_ENV['CUSTOMER_TABLE']} (
        id INT(6) AUTO_INCREMENT PRIMARY KEY,
        customer_name VARCHAR(128) NOT NULL,
        sales_name VARCHAR(128) NOT NULL,
        segmentation VARCHAR(64) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )
";

// create user table
$query['create_user_table'] = "CREATE TABLE IF NOT EXISTS {$_ENV['USER_TABLE']} (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    username VARCHAR(32) NOT NULL,
    email VARCHAR(128) NOT NULL,
    activated VARCHAR(16) NOT NULL,
    user_role VARCHAR(64) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
";

// Run query
foreach ($query as $q) {
    sqlQuery($conn, $q);
}

// close connection
$conn->close();

// sqlQuery function for run the sql query
function sqlQuery($conn = null, $query)
{
    echo "[DEBUG]: $query \n";
    if ($conn->query($query)) {
        echo "[DEBUG]: Successfully run query \n";
    } else {
        echo "[DEBUG]: Error -> {$conn->connect_error} \n";
    }
}
