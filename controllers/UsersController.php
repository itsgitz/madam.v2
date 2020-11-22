<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


class UsersController extends BaseController
{
    const SUCCESS_ADD_USER = 'add_user';
    const SUCCESS_REMOVE_USER = 'remove_user';
    const SUCCESS_EDIT_USER = 'edit_user';

    private $bind = [];
    private $users;
    private $sessions;

    function __construct()
    {
        $this->sessions = $this->sessionsInit()->getSessions();
        $this->users = new User();
        $this->bind = [
            'title' => 'Users - Madam v.2.0',
            'name' => $this->sessions['name'],
            'admin' => $this->sessions['admin'],
            'users' => $this->users->getUsers(),
            'success_message' => '',
            'error_message' => ''
        ];
    }

    public function index()
    {
        if (isset($_GET)) {
            $successParam = isset($_GET['success']) ? $_GET['success'] : '';

            switch ($successParam) {

                case self::SUCCESS_ADD_USER: // add user
                    $this->bind['success_message'] = 'Successfully created a new user!';
                    break;

                case self::SUCCESS_EDIT_USER: // edit user
                    $this->bind['success_message'] = 'Successfully updated a user data!';
                    break;

                case self::SUCCESS_REMOVE_USER: // remove user
                    $this->bind['success_message'] = 'Successfully removed a user!';
                    break;
            }
        }

        $this->setView(__CLASS__, $this->bind);
    }

    public function post()
    {
        $requestParam = isset($_GET['request']) ? $_GET['request'] : '';

        switch ($requestParam) {
            case Http::ADD_REQUEST:
                $this->addUser($_POST);
                break;

            case Http::REMOVE_REQUEST:
                $this->removeUser($_POST);
                break;

            case Http::EDIT_REQUEST:
                $this->editUser($_POST);
                break;

            case Http::SEARCH_REQUEST:
                $this->searchUser($_POST);
                break;

            default:
                die('Invalid request');
                break;
        }

        $this->setView(__CLASS__, $this->bind);
    }

    private function addUser($post)
    {
        if (isset($post)) {
            $validated = $this->userValidateForm($post);

            if ($validated['error']) {
                $this->bind['error_message'] = $validated['message'];
            } else {
                $hashedPassword = password_hash($post['password'], PASSWORD_DEFAULT);

                $param = [
                    'username' => $post['username'],
                    'name' => $post['name'],
                    'password' => $hashedPassword,
                    'role' => $post['role'],
                    'email' => $post['email'],
                    'status' => $post['status'],
                ];

                $created = $this->users->addUser($param);

                if (!$created) {
                    $this->bind['error_message'] = 'Something went wrong, cannot created new user. Please contact administrator.';
                } else {
                    header('Location: /users?success=add_user');
                    die();
                }
            }
        }
    }

    private function editUser($post)
    {
        if (isset($post)) {
            $validated = $this->userValidateForm($post);

            if ($validated['error']) {
                $this->bind['error_message'] = $validated['message'];
            } else {
                $id = isset($post['user_id']) ? $post['user_id'] : '';
                $hashedPassword = password_hash($post['password'], PASSWORD_DEFAULT);

                $param = [
                    'username' => $post['username'],
                    'name' => $post['name'],
                    'password' => $hashedPassword,
                    'user_role' => $post['role'],
                    'email' => $post['email'],
                    'activated' => $post['status']
                ];

                $updated = $this->users->updateUser($id, $param);

                if (!$updated) {
                    $this->bind['error_message'] = 'Something went wrong, cannot updated user data. Please contact administrator.';
                } else {
                    header('Location: /users?success=edit_user');
                    die();
                }
            }
        }
    }

    private function removeUser($post)
    {
        if (isset($post)) {
            $id = isset($post['user_id']) ? $post['user_id'] : '';
            $validated = $this->removeUserValidateForm($id);

            if ($validated['error']) {
                $this->bind['error_message'] = $validated['message'];
            } else {
                $removed = $this->users->removeUser($id);

                if (!$removed) {
                    $this->bind['error_message'] = 'Something went wrong, cannot removed user. Please contact administrator';
                } else {
                    header('Location: /users?success=remove_user');
                    die();
                }
            }
        }
    }

    private function searchUser()
    {
        if (isset($post)) {
            $key = isset($post['key']) ? $post['key'] : '';

            $result = $this->users->searchUser($key);

            if (isset($result)) {
                $this->bind['users'] = $result;
            } else {
                $this->bind['error_message'] = 'Result not found :(';
            }
        }
    }

    private function userValidateForm($param = [])
    {
        if (!isset($param)) {
            return [
                'error' => true,
                'message' => 'The all input is empty!'
            ];
        } else {
            if (!isset($param['username'])) { // username
                return [
                    'error' => true,
                    'message' => 'The user name cannot be empty!'
                ];
            } else if (!isset($param['name'])) { // name
                return [
                    'error' => true,
                    'message' => 'The name for user cannot be empty!'
                ];
            } else if (!isset($param['password'])) { // password
                return [
                    'error' => true,
                    'message' => 'The password cannot be empty!'
                ];
            } else if (!isset($param['email'])) { // email
                return [
                    'error' => true,
                    'message' => 'The e-mail address cannot be empty!'
                ];
            } else if (!isset($param['status'])) { // status
                return [
                    'error' => true,
                    'message' => 'The user status cannot be empty!'
                ];
            } else if (!isset($param['role'])) { // role
                return [
                    'error' => true,
                    'message' => 'The user role cannot be empty!'
                ];
            } else {
                return [
                    'error' => false,
                    'message' => null
                ];
            }
        }
    }

    private function removeUserValidateForm($id)
    {
        if (!isset($id)) {
            return [
                'error' => true,
                'message' => 'User ID cannot be empty!'
            ];
        } else {
            return [
                'error' => false,
                'message' => null,
            ];
        }
    }
}
