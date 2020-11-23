<?php

namespace Madam;


class SettingController extends BaseController
{
    private $bind = [];
    private $users;
    private $sessions;

    function __construct()
    {
        $this->sessions = $this->sessionsInit()->getSessions();
        $this->users = new User();
        $this->bind = [
            'title' => 'Settings - Madam v.2.0',
            'id' => $this->sessions['id'],
            'name' => $this->sessions['name'],
            'admin' => $this->sessions['admin'],
            'user' => $this->users->getUserById($this->sessions['id']),
            'success_message' => '',
            'error_message' => ''
        ];
    }

    public function index()
    {
        $this->setView(__CLASS__, $this->bind);
    }

    public function post()
    {
        
    }
}