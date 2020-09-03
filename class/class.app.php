<?php

namespace Madam;


use Madam\Database;
use Symfony\Component\Dotenv\Dotenv;

class App
{
    public function run()
    {
        $this->init();
    }

    private function init()
    {
        $this->loadEnv();
        $db = new Database();
    }

    private function loadEnv()
    {
        $dotenv = new Dotenv();
        $dotenv->load('./.env');
    }
}