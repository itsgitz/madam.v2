<?php

namespace Madam;


class LogoutController extends BaseController
{
    function __construct()
    {
        $this->sessions = new Sessions();    
    }

    public function index()
    {
        // remove sessions
        $this->sessions->removeSessions();

        header('Location: /');
        die();
    }
}