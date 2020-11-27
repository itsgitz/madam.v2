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
    ) {
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

        if (isset($_SESSION)) {
            $s = [
                'id' => $_SESSION['id'],
                'username' => $_SESSION['username'],
                'name' => $_SESSION['name'],
                'email' => $_SESSION['email'],
                'user_role' => $_SESSION['user_role'],
                'admin' => $_SESSION['admin']
            ];

            return $s;
        } else {
            return null;
        }
    }

    public function removeSessions()
    {
        session_unset();
        session_destroy();
    }
}
