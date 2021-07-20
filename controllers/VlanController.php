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
            'title' => 'VLAN Group Management - Madam v.2.0',
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

        $this->setView(__CLASS__, $this->bind);
    }

    private function addVlanGroup($post)
    {
        if (isset($post)) {
            if (!$this->isWhiteSpace($post['name'])) {

                $param = [
                    'name' => \strtoupper($post['name']),
                    'site' => $post['site'],
                ];

                $param['slug'] = \strtolower($param['name']);

                $created = $this->networking->addVlanGroup($param);

                if (!$created) {
                    $this->bind['error_message'] = 'Something went wrong, cannot created new VLAN Group';
                } else {
                    $h = 'Location: /vlan?success=' . self::SUCCESS_ADD_VLAN_GROUP;

                    \header($h);
                    die();
                }
            } else {
                $this->bind['error_message'] = "Cannot created new VLAN Group. Make sure the VLAN Group's name has no whitespace.";
            }
        }
    }

    private function isWhiteSpace($s)
    {
        if (!preg_match('/\s/', $s)) {
            return false;
        } else {
            return true;
        }
    }

    private function removeVlanGroup($post)
    {
        if (isset($post)) {
            $id = isset($post['id']) ? $post['id'] : '';

            $removed = $this->networking->removeVlanGroup($id);

            if (!$removed) {
                $this->bind['error_message'] = 'Something went wrong, cannot removed VLAN Group';
            } else {
                $h = 'Location: /vlan?success=' . self::SUCCESS_REMOVE_VLAN_GROUP;

                \header($h);
                die();
            }
        }
    }

    private function editVlanGroup($post)
    {
        if (isset($post)) {
            $id = isset($post['id']) ? $post['id'] : '';

            if (!empty($post['name'])) {
                $mustRename = true;
                $oldSubVlanTableData = $this->networking->getVlanGroupById($id);
            }

            $param = [
                'id' => $id,
                'name' => \strtoupper($post['name']),
                'site' => $post['site']
            ];

            $param['slug'] = \strtolower($param['name']);

            $updated = $this->networking->updateVlanGroup($id, $param);

            if (!$updated) {
                $this->bind['error_message'] = 'Something went wrong, cannot updated VLAN Group';
            } else {
                if ($mustRename) {
                    $renamed = $this->networking->renameSubVlanTable($oldSubVlanTableData['slug'], $param['slug']);

                    if (!$renamed) {
                        $this->bind['error_message'] = 'Something went wrong, cannot updated VLAN Group';
                    } else {
                        $h = 'Location: /vlan?success=' . self::SUCCESS_EDIT_VLAN_GROUP;

                        \header($h);
                        die();
                    }
                }

                $h = 'Location: /vlan?success=' . self::SUCCESS_EDIT_VLAN_GROUP;

                \header($h);
                die();
            }
        }
    }

    private function searchVlanGroup($post)
    {
    }
}
