<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


class HomeController extends BaseController
{
    private $bind = [];
    private $sessions;

    function __construct()
    {
        $this->sessions = $this->sessionsInit()->getSessions();
        $this->bind = [
            'title' => 'Home',
            'name' => $this->sessions['name'],
            'admin' => $this->sessions['admin']
        ];
    }

    public function index()
    {
        $this->setView(__CLASS__, $this->bind);
    }
}