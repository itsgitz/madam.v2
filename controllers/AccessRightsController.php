<?php

namespace Madam;


class AccessRightsController extends BaseController
{
    const ADD_ACCESS_RIGHTS_VIEW = 'subpage/access_rights/add.blade.php';
    const EDIT_ACCESS_RIGHTS_VIEW = 'subpage/access_rights/edit.blade.php';
    const REMOVE_ACCESS_RIGHTS_VIEW = 'subpage/access_rights/remove.blade.php';
    const SUB_PAGE = true;

    private $bind = [];
    private $accessRights;
    private $customer;
    private $sessions;

    function __construct()
    {
        $this->sessions = $this->sessionsInit()->getSessions();
        $this->customer = new Customer();
        $this->accessRights = new AccessRights();
        $this->bind = [
            'title' => 'Access Rights - Madam v.2.0',
            'name' => $this->sessions['name'],
            'admin' => $this->sessions['admin'],
            'access_rights' => $this->accessRights->getAccessRights(),
            'success_message' => '',
            'error_message' => ''
        ];
    }

    public function index()
    {
        if (!empty($_GET)) {
            switch ($_GET['action']) {
                case Http::ADD_REQUEST:
                    $this->addAccessRightsView($_GET);
                    break;

                case Http::EDIT_REQUEST:
                    $this->editAccessRightsView($_GET);
                    break;

                case Http::REMOVE_REQUEST:
                    $this->removeAccessRightsView($_GET);
                    break;

                default:
                    $this->apiGetAccessRightByCustomerId($_GET);
                    break;
            }
        } else {

            $this->setView(__CLASS__, $this->bind);
        }
    }

    /**
     * @param $_POST request
     * 
     * Paths:
     * 
     * Create /access_rights?customer_id={integer}&action=add
     * Read /access_rights
     * Read api/json /access_rights?id={integer}&request_type=json
     * Update /access_rights?id={integer}&action=edit
     * Delete /access_rights?request=remove
     */
    public function post()
    {
        if (isset($_POST)) {
            if (!empty($_GET)) {
                switch ($_GET['action']) {
                    case Http::ADD_REQUEST:
                        $this->addAccessRightsProcess($_GET, $_POST);
                        break;

                    case Http::EDIT_REQUEST:
                        $this->editAccessRightsProccess($_GET, $_POST);
                        break;

                    case Http::REMOVE_REQUEST:
                        $this->removeAccessRightsProcess($_GET);
                        break;
                }
            }
        }
    }

    /**
     * endpoint example: http://developer.itsgitz.com:8080/access_rights?customer_id=1&request_type=json
     */
    private function apiGetAccessRightByCustomerId($get)
    {
        $customer_id = isset($get['customer_id']) ? $get['customer_id'] : '';
        $requestType = isset($get['request_type']) ? $get['request_type'] : '';

        switch ($requestType) {

            case Http::JSON:
                $accessRights = $this->accessRights->getAccessRightByCustomerId($customer_id);

                if ($accessRights != null) {
                    $json = json_encode($accessRights);

                    header(Http::CONTENT_TYPE_JSON);
                    echo $json;

                    die();
                } else {
                    $json = json_encode(array('status' => 404));

                    header(Http::CONTENT_TYPE_JSON);
                    echo $json;

                    die();
                }

                break;
        }
    }

    private function addAccessRightsView($get)
    {
        $customer_id = isset($get['customer_id']) ? $get['customer_id'] : '';
        $getCustomerData = $this->customer->getCustomerById($customer_id);

        $this->bind['customer_name'] = $getCustomerData['customer_name'];

        $this->setView(self::ADD_ACCESS_RIGHTS_VIEW, $this->bind, self::SUB_PAGE);
    }

    private function addAccessRightsProcess($get, $post)
    {
        if (!empty($get['customer_id'])) {
            $customer_id    = isset($get['customer_id']) ? $get['customer_id'] : '';
            $name           = isset($post['name']) ? $post['name'] : '';
            $companyName    = isset($post['company_name']) ? $post['company_name'] : '';
            $identityNumber = isset($post['identity_number']) ? $post['identity_number'] : '';
            $email          = isset($post['email']) ? $post['email'] : '';
            $status         = isset($post['status']) ? $post['status'] : '';

            $param = [
                'customer_id' => $customer_id,
                'name' => $name,
                'company_name' => $companyName,
                'identity_number' => $identityNumber,
                'email' => $email,
                'status' => $status,
            ];

            $created = $this->accessRights->addAccessRight($param);

            if (!$created) {
                $this->bind['error_message'] = 'Something went wrong, cannot created new access rights. Please contact the administrator!';
            } else {
                header('Location: /customers?success=add_access_right');
                die();
            }
        }
    }

    private function editAccessRightsView($get)
    {
        $id = isset($get['id']) ? $get['id'] : '';
        $getAccessRights = $this->accessRights->getAccessRightById($id);

        $this->bind['access_rights'] = $getAccessRights;
        $this->setView(self::EDIT_ACCESS_RIGHTS_VIEW, $this->bind, self::SUB_PAGE);
    }

    private function editAccessRightsProccess($get, $post)
    {
        if (!empty($get['id'])) {
            $id             = isset($get['id']) ? $get['id'] : '';
            $customer_id    = isset($post['customer_id']) ? $post['customer_id'] : '';
            $name           = isset($post['name']) ? $post['name'] : '';
            $companyName    = isset($post['company_name']) ? $post['company_name'] : '';
            $identityNumber = isset($post['identity_number']) ? $post['identity_number'] : '';
            $email          = isset($post['email']) ? $post['email'] : '';
            $status         = isset($post['status']) ? $post['status'] : '';

            $param = [
                'customer_id' => $customer_id,
                'name' => $name,
                'company_name' => $companyName,
                'identity_number' => $identityNumber,
                'email' => $email,
                'status' => $status
            ];

            $updated = $this->accessRights->updateAccessRight($id, $param);

            if (!$updated) {
                $this->bind['error_message'] = 'Something went wrong, cannot updated the access rights. Please contact the administrator!';
            } else {
                header('Location: /customers?success=edit_access_right');
                die();
            }
        }
    }

    private function removeAccessRightsView($get)
    {
        $id = isset($get['id']) ? $get['id'] : '';
        $getAccessRights = $this->accessRights->getAccessRightById($id);

        $this->bind['access_rights'] = $getAccessRights;
        $this->setView(self::REMOVE_ACCESS_RIGHTS_VIEW, $this->bind, self::SUB_PAGE);
    }

    private function removeAccessRightsProcess($get)
    {
        if (!empty($get)) {
            $id = isset($get['id']) ? $get['id'] : '';

            $removed = $this->accessRights->removeAccessRight($id);

            if (!$removed) {
                $this->bind['error_message'] = 'Something went wrong, cannot removed access right. Please contact the administrator!';
            } else {
                header('Location: /customers?success=remove_access_right');
                die();
            }
        }
    }
}
