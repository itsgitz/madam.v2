<?php

namespace Madam;

class VlanController extends BaseController
{
    const SUCCESS_ADD_VLAN_GROUP = 'add_vlan_group';
    const SUCCESS_REMOVE_VLAN_GROUP = 'remove_vlan_group';
    const SUCCESS_EDIT_VLAN_GROUP = 'edit_vlan_group';

    private $bind = [];
    private $networking;
    private $sessions;

    function __construct()
    {
        $this->sessions = $this->sessionsInit()->getSessions();
        $this->networking = new Networking();
        $this->bind = [
            'title' => 'VLAN Management - Madam v.2.0',
            'name' => $this->sessions['name'],
            'admin' => $this->sessions['admin'],
            'vlanGroups' => $this->networking->getVlanGroups(),
            'success_message' => '',
            'error_message' => '',
        ];
    }

    public function index()
    {
        if (isset($_GET)) {
            $successParam = isset($_GET['success']) ? $_GET['success'] : '';

            switch ($successParam) {
                case self::SUCCESS_ADD_VLAN_GROUP: // add vlan group
                    $this->bind['success_message'] = 'Successfully created a new VLAN Group!';
                    break;

                case self::SUCCESS_EDIT_VLAN_GROUP: // edit vlan group
                    $this->bind['success_message'] = 'Successfully updated a VLAN Group data!';
                    break;

                case self::SUCCESS_REMOVE_VLAN_GROUP: // remove vlan group
                    $this->bind['success_message'] = 'Successfully removed a VLAN Group!';
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
                $this->addVlanGroup($_POST);
                break;
            
            case Http::REMOVE_REQUEST:
                $this->removeVlanGroup($_POST);
                break;

            case Http::EDIT_REQUEST:
                $this->editVlanGroup($_POST);
                break;

            case Http::SEARCH_REQUEST:
                $this->searchVlanGroup($_POST);
                break;
        }
    }

    private function addVlanGroup($post)
    {
    }

    private function removeVlanGroup($post)
    {
    }

    private function editVlanGroup($post)
    {
    }

    private function searchVlanGroup($post)
    {
    }
}
