<?php

namespace Madam;


class AccessRightsController extends BaseController
{
    private $bind = [];
    private $accessRights;
    private $sessions;

    function __construct()
    {
        // $this->sessions = $this->sessionsInit()->getSessions();
        $this->accessRights = new AccessRights();
        // $this->bind = [
        //     'title' => 'Access Rights - Madam v.2.0',
        //     // 'name' => $this->sessions['name'],
        //     // 'admin' => $this->sessions['admin'],
        //     'access_rights' => $this->accessRights->getAccessRights(),
        //     'success_message' => '',
        //     'error_message' => ''
        // ];
    }

    public function index()
    {
        $this->setView(__CLASS__, $this->bind);
    }

    public function post()
    {

    }
}