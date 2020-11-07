<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


class Sessions
{
    function __construct()
    {
        
    }

    public function setSessions(
        $id,
        $username,
        $name,
        $email,
        $userRole,
        $admin
    )
    {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['user_role'] = $userRole;
        $_SESSION['admin'] = $admin;
    }

    public function getSessions()
    {
        $s = [];
        $s['id'] = isset($_SESSION['id']) ? $_SESSION['id'] : '';
        $s['username'] = isset($_SESSION['username']) ? $_SESSION['username'] : '';
        $s['name'] = isset($_SESSION['name']) ? $_SESSION['name'] : '';
        $s['email'] = isset($_SESSION['email']) ? $_SESSION['email'] : '';
        $s['user_role'] = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : '';
        $s['admin'] = isset($_SESSION['admin']) ? $_SESSION['admin'] : '';

        return $s;
    }

    public function removeSessions()
    {
        session_unset();
        session_destroy();
    }
}