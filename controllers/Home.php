<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


class Home extends Base
{
    private $bind = [];

    function __construct()
    {
        $this->bind['title'] = 'Home Page';
    }

    public function index()
    {
        $sessions = new Sessions();
        $s = $sessions->getSessions();
        
        var_dump($s);

        $this->setView(__CLASS__, $this->bind);
    }
}