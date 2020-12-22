<?php

namespace Madam;


class CIDController extends BaseController
{
    const SUCCESS_ADD_CID = 'add_cid';
    const SUCCESS_REMOVE_CID = 'remove_cid';
    const SUCCESS_EDIT_CID = 'edit_cid';

    private $bind = [];
    private $cid;
    private $sessions;

    function __construct()
    {
        $this->cid = new CID();
        $this->sessions = $this->sessionsInit()->getSessions();
        $this->bind = [
            'title' => 'CID - Madam v.2.0',
            'name' => $this->sessions['name'],
            'admin' => $this->sessions['admin'],
            'cid' => $this->cid->getCIDs(),
            'success_message' => '',
            'error_message' => ''
        ];
    }

    public function index()
    {
        if (isset($_GET)) {
            $successParam = isset($_GET['success']) ? $_GET['success'] : '';

            switch ($successParam) {
                case self::SUCCESS_ADD_CID: // add cid
                    $this->bind['success_message'] = 'Successfully created a new CID!';
                    break;

                case self::SUCCESS_EDIT_CID: // edit cid
                    $this->bind['success_message'] = 'Successfully updated a CID!';
                    break;

                case self::SUCCESS_REMOVE_CID: // remove cid
                    $this->bind['success_message'] = 'Successfully removed a CID!';
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
                $this->addCID($_POST);
                break;

            case Http::REMOVE_REQUEST:
                $this->removeCID($_POST);
                break;

            case Http::EDIT_REQUEST:
                $this->editCID($_POST);
                break;

            case Http::SEARCH_REQUEST:
                $this->searchCID($_POST);
                break;
        }

        $this->setView(__CLASS__, $this->bind);
    }

    private function addCID($post)
    {
        if (isset($post)) {
            $validated = $this->cidValidateForm($post);

            if ($validated['error']) {
                $this->bind['error_message'] = 'Something went wrong, cannot created new CID. Please contact administrator.';
            } else {
                $param = [
                    'cid' => $post['cid'],
                    'service_name' => $post['service_name'],
                    'customer_name' => $post['customer_name'],
                    'location' => $post['location'],
                    'rack_location' => $post['rack_location'],
                    'u_location' => $post['u_location']
                ];

                $created = $this->cid->addCID($param);

                if (!$created) {
                    $this->bind['error_message'] = 'Something went wrong, cannot created new CID. Please contact administrator.';
                } else {
                    header('Location: /cid?success=add_cid');
                    die();
                }
            }
        }
    }

    private function removeCID($post)
    {
        if (isset($post)) {
            $id = isset($post['id']) ? $post['id'] : '';
            $validated = $this->removeCIDValidateForm($id);

            if ($validated['error']) {
                $this->bind['error_message'] = $validated['message'];
            } else {
                $removed = $this->cid->removeCID($id);

                if (!$removed) {
                    $this->bind['error_message'] = 'Something went wrong, cannot removed CID. Please contact administrator.';
                } else {
                    header('Location: /cid?success=remove_cid');
                    die();
                }
            }
        }
    }

    private function editCID($post)
    {
        if (isset($post)) {
            $validated = $this->cidValidateForm($post);

            if ($validated['error']) {
                $this->bind['error_message'] = $validated['message'];
            } else {
                $id = isset($post['id']) ? $post['id'] : '';

                $param = [
                    'cid' => $post['cid'],
                    'service_name' => $post['service_name'],
                    'customer_name' => $post['customer_name'],
                    'location' => $post['location'],
                    'rack_location' => $post['rack_location'],
                    'u_location' => $post['u_location']
                ];

                $updated = $this->cid->updateCID($id, $param);

                if (!$updated) {
                    $this->bind['error_message'] = 'Something went wrong, cannot updated CID data. Please contact administrator.';
                } else {
                    header('Location: /cid?success=edit_cid');
                    die();
                }
            }
        }
    }

    private function searchCID($post)
    {
        if (isset($post)) {
            $key = isset($post['key']) ? $post['key'] : '';

            $result = $this->cid->searchCID($key);

            if (isset($result)) {
                $this->bind['cid'] = $result;
            } else {
                $this->bind['error_message'] = 'Result not found :(';
            }
        }
    }

    public function cidValidateForm($param = [])
    {
        if (!isset($param)) {
            return [
                'error' => true,
                'message' => 'The all input is empty!'
            ];
        } else {
            if (!isset($param['cid'])) {
                return [
                    'error' => true,
                    'message' => 'The CID cannot be empty!'
                ];
            } else if (!isset($param['service_name'])) {
                return [
                    'error' => true,
                    'message' => 'The Service Name cannot be empty!'
                ];
            } else if (!isset($param['customer_name'])) {
                return [
                    'error' => true,
                    'message' => 'The Customer Name cannot be empty!'
                ];
            } else if (!isset($param['location'])) {
                return [
                    'error' => true,
                    'message' => 'The Location cannot be empty!'
                ];
            } else if (!isset($param['rack_location'])) {
                return [
                    'error' => true,
                    'message' => 'The Rack Location cannot be empty!'
                ];
            } else if (!isset($param['u_location'])) {
                return [
                    'error' => true,
                    'message' => 'The Unit Location cannot be empty!'
                ];
            } else {
                return [
                    'error' => false,
                    'message' => null
                ];
            }
        }
    }

    public function removeCIDValidateForm($id)
    {
        if (!isset($id)) {
            return [
                'error' => true,
                'message' => "CID's ID cannot be empty!"
            ];
        } else {
            return [
                'error' => false,
                'message' => null,
            ];
        }
    }
}
