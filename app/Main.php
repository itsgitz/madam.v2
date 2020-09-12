<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


use \Symfony\Component\Dotenv\Dotenv;

class App
{
    const ENV = './.env';

    function __construct()
    {
        
    }
    
    public function run()
    {
        // load environment variables from .env
        $this->loadEnv();

        // database initialization
        $this->db();

        // router initialization
        $this->router();
    }

    public function loadEnv()
    {
        $dotenv = new Dotenv();
        $dotenv->load(self::ENV);
    }

    private function db()
    {
        $db = new Database();
        $db->init();
    }

    private function router()
    {
        $router = new Router();
        $router->init();
    }
}
