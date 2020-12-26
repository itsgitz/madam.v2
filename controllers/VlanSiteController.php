<?php

namespace Madam;

class VlanSiteController extends BaseController
{
    const SUCCESS_ADD_VLAN_SITE = 'add_vlan_site';
    const SUCCESS_REMOVE_VLAN_SITE = 'remove_vlan_site';
    const SUCCESS_EDIT_VLAN_SITE = 'edit_vlan_site';

    private $bind = [];
    private $networking;
    private $sessions;

    function __construct()
    {
        $this->sessions = $this->sessionsInit()->getSessions();
        $this->networking = new Networking();
        $this->bind = [
            'title' => 'VLAN Site Management - Madam v.2.0',
            'name' => $this->sessions['name'],
            'admin' => $this->sessions['admin'],
            'success_message' => '',
            'error_message' => '',
        ];
    }

    public function index()
    {
        $this->setView(__CLASS__, $this->bind);
    }

    public function post()
    {
    }
}
