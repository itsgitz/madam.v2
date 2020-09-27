<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


class Login extends Base
{
    private $bind = [];
    private $users;

    function __construct()
    {
        $this->users = new User();
        $this->bind['title'] = 'Login Page';
    }

    public function index()
    {
        $this->setView(__CLASS__, $this->bind);
    }

    public function post()
    {
        $username = ( isset($_POST['username']) ? $_POST['username'] : '' );
        $password = ( isset($_POST['password']) ? $_POST['password'] : '' );


        if ( !empty($username) && !empty($password) ) {
            $user = $this->users->getUserByUsername($username);

            // if user is not exist or password doesn't match, throw error message for 'invalid username or password'
            if (!$user) {
                $this->bind['error_message'] = "Username or password doesn't exist!";
            } else {
                if (!password_verify($password, $user['password'])) {
                    $this->bind['error_message'] = 'Username or password is incorrect!';
                } else {
                    // set session if password verify
                    $sess = new Sessions();
                    $sess->setSessions(
                        $user['id'],
                        $user['username'],
                        $user['name'],
                        $user['email']
                    );

                    // redirect to home page after sessions is configured
                    header('Location: /');
                }
            }
        } else {
            $this->bind['error_message'] = 'Username or password cannot be empty!';
        }
        $this->setView(__CLASS__, $this->bind);
    }
}