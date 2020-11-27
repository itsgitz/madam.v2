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

    public function run($showError = false)
    {
        // show error if true
        $this->showError($showError);

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

    public function showError($show = false)
    {
        if ($show) {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        }
    }

    private function setMemoryLimit($memoryInMegaByte)
    {
        ini_set('memory_limit', $memoryInMegaByte);
    }
}
