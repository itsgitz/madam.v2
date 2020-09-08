<?php

namespace Madam;


class Database
{
    private $servername;
    private $username;
    private $password;

    function __construct()
    {
        $this->servername = $_ENV['DB_SERVER'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
    }

    public function getServername()
    {
        return $this->servername;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }
}