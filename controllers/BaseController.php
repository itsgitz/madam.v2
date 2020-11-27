<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


class BaseController
{
    const ADMIN_USER = 'Administrator';
    const TECHNICIAN_USER = 'Technician';

    function __construct()
    {

    }

    protected function setView($class, $data = [])
    {
        $v = new Views();
        $v->run($class, $data);
    }

    protected function isAdmin($userRole)
    {
        if ($userRole == self::ADMIN_USER) {
            return true;
        } else {
            return false;
        }
    }

    protected function sessionsInit()
    {
        $s = new Sessions();
        
        return $s;
    }
}