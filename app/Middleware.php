<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


class Auth
{
    function __construct()
    {
        
    }

    public function isLoggedIn()
    {
        $s = new Sessions();
        $sess = $s->getSessions();

        if ( empty($sess['id']) && empty($sess['username']) && empty($sess['name']) && empty($sess['email']) ) {
            return false;
        } else {
            return true;
        }
    }
}