<?php

namespace Madam;


class SettingController extends BaseController
{
    const SUCCESS_EDIT_USER = 'edit_user';

    private $bind = [];
    private $users;
    private $sessions;

    function __construct()
    {
        $this->sessions = $this->sessionsInit()->getSessions();
        $this->users = new User();
        $this->bind = [
            'title' => 'Settings - Madam v.2.0',
            'id' => $this->sessions['id'],
            'name' => $this->sessions['name'],
            'admin' => $this->sessions['admin'],
            'user' => $this->users->getUserById($this->sessions['id']),
            'success_message' => '',
            'error_message' => ''
        ];
    }

    public function index()
    {
        if (isset($_GET)) {
            $successParam = isset($_GET['success']) ? $_GET['success'] : '';

            switch ($successParam) {
                case self::SUCCESS_EDIT_USER: // update user data
                    $this->bind['success_message'] = 'Successfully updated setting!';
                    break;
            }
        }

        $this->setView(__CLASS__, $this->bind);
    }

    public function post()
    {
        $requestParam = isset($_GET['request']) ? $_GET['request'] : '';

        switch ($requestParam) {
            case Http::EDIT_REQUEST:
                $this->updateSetting($_POST);
                break;
        }

        $this->setView(__CLASS__, $this->bind);
    }

    private function updateSetting($post)
    {
        if (isset($post)) {
            $id = isset($post['id']) ? $post['id'] : '';

            $param = [
                'username' => $post['username'],
                'name' => $post['name'],
                'user_role' => $post['user_role'],
                'email' => $post['email'],
            ];

            if (!empty($post['password'])) {
                $hashedPassword = password_hash($post['password'], PASSWORD_DEFAULT);
                $param['password'] = $hashedPassword;
            }

            $updated = $this->users->updateUser($id, $param);

            if (!$updated) {
                $this->bind['error_message'] = 'Something went wront, cannot updated setting. Please contact administrator';
            } else {
                $this->updateSession($param['name']);
                header('Location: /settings?success=edit_user');
                die();
            }
        }
    }

    // this method is used only for settings
    private function updateSession($name)
    {
        $_SESSION['name'] = $name;
    }
}
