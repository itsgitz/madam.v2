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
    private $vlanGroupName;
    private $vlanGroupId;

    function __construct()
    {
        $this->vlanGroupName = isset($_GET['vlan_name']) ? $_GET['vlan_name'] : '';
        $this->vlanGroupId = isset($_GET['id']) ? $_GET['id'] : '';

        $this->sessions = $this->sessionsInit()->getSessions();
        $this->networking = new Networking();
        $this->bind = [
            'title' => 'VLAN Site Management - Madam v.2.0',
            'name' => $this->sessions['name'],
            'admin' => $this->sessions['admin'],
            'vlan_group_name' => $this->vlanGroupName,
            'vlan_group_id' => $this->vlanGroupId,
            'vlan_group_name_title' => \strtoupper($this->vlanGroupName),
            'success_message' => '',
            'error_message' => '',
        ];
    }

    public function index()
    {
        if (!empty($this->vlanGroupName) && !empty($this->vlanGroupId)) {
            if (isset($_GET)) {
                $successParam = isset($_GET['success']) ? $_GET['success'] : '';

                switch ($successParam) {
                    case self::SUCCESS_ADD_VLAN_SITE: // add vlan site
                        $this->bind['success_message'] = 'Successfully created a new VLAN!';
                        break;

                    case self::SUCCESS_EDIT_VLAN_SITE: // edit vlan site
                        $this->bind['success_message'] = 'Successfully updated a VLAN!';
                        break;

                    case self::SUCCESS_REMOVE_VLAN_SITE: // remove vlan site
                        $this->bind['success_message'] = 'Successfully removed a VLAN!';
                        break;
                }
            }

            $this->setVlanData();
        } else {
            $this->bind['error_message'] = 'Invalid request! VLAN Group Name and ID cannot be empty!';
        }

        $this->setView(__CLASS__, $this->bind);
    }

    public function post()
    {
        if (!empty($this->vlanGroupName) && !empty($this->vlanGroupId)) {
            $requestParam = isset($_GET['request']) ? $_GET['request'] : '';

            switch ($requestParam) {
                case Http::ADD_REQUEST:
                    $this->addVlan($_POST);
                    break;

                case Http::REMOVE_REQUEST:
                    $this->removeVlan($_POST);
                    break;

                case Http::EDIT_REQUEST:
                    $this->editVlan($_POST);
                    break;

                case Http::SEARCH_REQUEST:
                    $this->searchVlan($_POST);
                    break;
            }


            // $this->setVlanData();
        } else {
            $this->bind['error_message'] = 'Invalid request! VLAN Group Name and ID cannot be empty!';
        }

        $this->setView(__CLASS__, $this->bind);
    }

    private function setVlanData()
    {
        if (!empty($this->vlanGroupName)) {
            $data = $this->networking->getVlanSubTableData($this->vlanGroupName);

            $this->bind['vlan'] = $data;
        }
    }
    private function addVlan($post)
    {
        if (isset($post)) {
            $param = [
                'vlan_id' => $post['vlan_id'],
                'group_id' => $post['group_id'],
                'prefixes' => $post['prefixes'],
                'tenant' => $post['tenant'],
                'status' => $post['status'],
                'role' => $post['role'],
                'description' => $post['description']
            ];

            $created = $this->networking->addVlanSubTableData($this->vlanGroupName, $param);

            if (!$created) {
                $this->bind['error_message'] = 'Something went wrong, cannot created new VLAN. Please contact the administrator.';
            } else {
                $h = 'Location: /vlan_site?success=' . self::SUCCESS_ADD_VLAN_SITE . '&id=' . $this->vlanGroupId . '&vlan_name=' . $this->vlanGroupName;

                \header($h);
                die();
            }
        }
    }

    private function removeVlan($post)
    {
        if (isset($post)) {
            $id = isset($post['id']) ? $post['id'] : '';

            $removed = $this->networking->removeVlanSubTableData($this->vlanGroupName, $id);

            if (!$removed) {
                $this->bind['error_message'] = 'Something went wrong, cannot removed VLAN. Please contact the administrator.';
            } else {
                $h = 'Location: /vlan_site?success=' . self::SUCCESS_REMOVE_VLAN_SITE . '&id=' . $this->vlanGroupId . '&vlan_name=' . $this->vlanGroupName;

                \header($h);
                die();
            }
        }   
    }

    private function editVlan($post)
    {
        $id = isset($post['id']) ? $post['id'] : '';
        $param = [
            'vlan_id' => $post['vlan_id'],
            'prefixes' => $post['prefixes'],
            'tenant' => $post['tenant'],
            'status' => $post['status'],
            'role' => $post['role'],
            'description' => $post['description']
        ];

        $updated = $this->networking->updateVlanSubTableData($id, $this->vlanGroupName, $param);

        if (!$updated) {
            $this->bind['error_message'] = 'Something went wrong, cannot updated VLAN';
        } else {
            $h = 'Location: /vlan_site?success=' . self::SUCCESS_EDIT_VLAN_SITE . '&id=' . $this->vlanGroupId . '&vlan_name=' . $this->vlanGroupName;
            \header($h);
            die();
        }
    }

    private function searchVlan($post)
    {
        if (isset($post)) {
            $key = isset($post['key']) ? $post['key'] : '';

            $result = $this->networking->searchVlanSubTableData($this->vlanGroupName, $key);

            if (isset($result)) {
                $this->bind['vlan'] = $result;
            } else {
                $this->bind['error_message'] = 'Result not found :(';
            }

            $this->bind['search'] = true;
        }
    }
}
