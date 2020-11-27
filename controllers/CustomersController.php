<?php

namespace Madam;


class CustomersController extends BaseController
{
    const SUCCESS_ADD_CUSTOMER = 'add_customer';
    const SUCCESS_REMOVE_CUSTOMER = 'remove_customer';
    const SUCCESS_EDIT_CUSTOMER = 'edit_customer';

    private $bind = [];
    private $customers;
    private $sessions;

    function __construct()
    {
        $this->sessions = $this->sessionsInit()->getSessions();

        $this->bind = [
            'title' => 'Customer - Madam v.2.0',
            'name' => $this->sessions['name'],
            'admin' => $this->sessions['admin']
        ];

        $this->customers = new Customer();
        $this->bind['customers'] = $this->customers->getCustomers();
        $this->bind['success_message'] = '';
        $this->bind['error_message'] = '';
    }

    public function index()
    {
        if (isset($_GET)) {
            $successParam = isset($_GET['success']) ? $_GET['success'] : '';

            switch ($successParam) {

                case self::SUCCESS_ADD_CUSTOMER: // add customer
                    $this->bind['success_message'] = 'Successfully created a new customer!';
                    break;

                case self::SUCCESS_EDIT_CUSTOMER: // edit customer
                    $this->bind['success_message'] = 'Successfully updated a customer!';
                    break;


                case self::SUCCESS_REMOVE_CUSTOMER: // remove customer
                    $this->bind['success_message'] = 'Successfully removed customer!';
                    break;
            }
        }

        $this->setView(__CLASS__, $this->bind);
    }

    public function post()
    {
        $requestParam = isset($_GET['request']) ? $_GET['request'] : '';

        switch ($requestParam) {

            case Http::ADD_REQUEST: // add a new customer request
                $this->addCustomer($_POST);
                break;


            case Http::REMOVE_REQUEST: // remove a customer
                $this->removeCustomer($_POST);
                break;

            case Http::EDIT_REQUEST:
                $this->editCustomer($_POST);
                break;

            case Http::SEARCH_REQUEST:
                $this->searchCustomer($_POST);
                break;
        }

        $this->setView(__CLASS__, $this->bind);
    }

    private function addCustomer($post)
    {
        // check html input data
        if (isset($post)) {
            // validated data using validator method
            $validated = $this->customerValidateForm($post);

            // if error is true or occured, show error message
            if ($validated['error']) {
                $this->bind['error_message'] = $validated['message'];
                // else, continue
            } else {
                // add customer, insert new data into customers table
                $param = [
                    'customer_name' => $post['customer_name'],
                    'sales_name' => $post['sales_name'],
                    'segmentation' => $post['segmentation']
                ];

                $success = $this->customers->addCustomer($param);

                if (!$success) {
                    $this->bind['error_message'] = 'Something went wrong, cannot created new customer data. Please contact administrator.';
                } else {
                    header('Location: /customers?success=add_customer');
                    die();
                }
            }
        }
    }

    private function editCustomer($post)
    {
        if (isset($post)) {
            $validated = $this->customerValidateForm($post);

            if ($validated['error']) {
                $this->bind['error_message'] = $validated['message'];
            } else {
                $id = (isset($post['customer_id']) ? $post['customer_id'] : '');
                $param = [
                    'customer_name' => $post['customer_name'],
                    'sales_name' => $post['sales_name'],
                    'segmentation' => $post['segmentation']
                ];

                $update = $this->customers->updateCustomer($id, $param);

                if (!$update) {
                    $this->bind['error_message'] = 'Something went wrong, cannot updated customer data. Please contact administrator';
                } else {
                    header('Location: /customers?success=edit_customer');
                    die();
                }
            }
        }
    }

    private function removeCustomer($post)
    {
        if (isset($post)) {
            $id = (isset($post['customer_id']) ? $post['customer_id'] : '');
            $validated = $this->removeCustomerValidateForm($id);

            if ($validated['error']) {
                $this->bind['error_message'] = $validated['message'];
            } else {
                $success = $this->customers->removeCustomer($id);

                if (!$success) {
                    $this->bind['error_message'] = 'Something went wrong, cannot removed customer data. Please contact administrator.';
                } else {
                    header('location: /customers?success=remove_customer');
                    die();
                }
            }
        }
    }

    private function searchCustomer($post)
    {
        if (isset($post)) {
            $key = (isset($post['key']) ? $post['key'] : '');

            $result = $this->customers->searchCustomer($key);

            if (isset($result)) {
                // array_push($result, $data);
                $this->bind['customers'] = $result;
            } else {
                $this->bind['error_message'] = 'Result not found :(';
            }
        }
    }

    private function customerValidateForm($param = [])
    {
        if (!isset($param)) {
            return [
                'error' => true,
                'message' => 'The all input is empty!'
            ];
        } else {
            if (!isset($param['customer_name'])) {
                return [
                    'error' => true,
                    'message' => 'The customer name cannot be empty!'
                ];
            } else if (!isset($param['sales_name'])) {
                return [
                    'error' => true,
                    'message' => 'The sales name cannot be empty!'
                ];
            } else if (!isset($param['segmentation'])) {
                return [
                    'error' => true,
                    'message' => 'The segmentation cannot be empty!'
                ];
            } else {
                return [
                    'error' => false,
                    'message' => null
                ];
            }
        }
    }

    private function removeCustomerValidateForm($id)
    {
        if (!isset($id)) {
            return [
                'error' => true,
                'message' => 'Customer ID cannot be empty!'
            ];
        } else {
            return [
                'error' => false,
                'message' => null
            ];
        }
    }
}
