<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


class LoginController extends BaseController
{
    private $bind;
    private $users;
    private $sessions;

    function __construct()
    {
        $this->sessions = $this->sessionsInit();
        $this->users = new User();
        $this->bind = [];
        $this->bind['title'] = 'Login to Madam v.2.0';
        $this->bind['error_message'] = '';
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

                    $admin = $this->isAdmin($user['user_role']);

                    $this->sessions->setSessions(
                        $user['id'],
                        $user['username'],
                        $user['name'],
                        $user['email'],
                        $user['user_role'],
                        $admin
                    );

                    // redirect to home page after sessions is configured
                    header('Location: /');
                    die();
                }
            }
        } else {
            $this->bind['error_message'] = 'Username or password cannot be empty!';
        }
        $this->setView(__CLASS__, $this->bind);
    }
}