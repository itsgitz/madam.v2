<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


class UsersController extends BaseController
{
    private $bind = [];
    private $users;
    private $sessions;

    function __construct()
    {
        $this->sessions = $this->sessionsInit()->getSessions();
        $this->users = new User();
        $this->bind = [
            'title' => 'Users',
            'name' => $this->sessions['name'],
            'admin' => $this->sessions['admin'],
            'users' => $this->users->getUsers()
        ];
    }

    public function index()
    {
        $this->setView(__CLASS__, $this->bind);
    }

    public function post()
    {
        var_dump($_POST);
    }
}