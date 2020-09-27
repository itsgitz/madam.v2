<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


class Login extends Base
{
    private $title;

    function __construct()
    {
        $this->title = 'Login Page';
    }

    public function index()
    {
        $bind = [
            'title' => $this->title
        ];

        $this->setView(__CLASS__, $bind);
    }

    public function post()
    {
        var_dump($_POST);
    }
}