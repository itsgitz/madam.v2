<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


use Madam\Database;
use Symfony\Component\Dotenv\Dotenv;

class App
{
    const ENV = './.env';

    public function run()
    {
        $this->init();
    }

    private function init()
    {
        $this->loadEnv();

        $db = new Database();
        $db->init();
    }

    public function loadEnv()
    {
        $dotenv = new Dotenv();
        $dotenv->load(self::ENV);
    }
}