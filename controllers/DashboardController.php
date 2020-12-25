<?php

namespace Madam;

class DashboardController extends BaseController
{
    private $bind = [];
    private $customer;
    private $cid;
    private $sessions;

    function __construct()
    {
        $this->sessions = $this->sessionsInit()->getSessions();
        $this->customer = new Customer();
        $this->cid      = new CID();
        $this->bind     = [
            'title' => 'Dashboard - Madam v.2.0',
            'segmentations' => $this->customer->getCustomerSegmentations(),
            'name' => $this->sessions['name'],
            'admin' => $this->sessions['admin']
        ];
    }

    public function index()
    {
        $request = isset($_GET['request_type']) ? $_GET['request_type'] : '';

        if (!empty($request)) {
            switch ($request) {
                case Http::JSON:
                    $this->getCustomerSegmentationsApi();
                    break;
                default:
                    die('Invalid request!');
            }
        }
        
        $this->bind['total_customers'] = $this->customer->getCustomersTotal();
        $this->bind['total_cid'] = $this->cid->getCIDsTotal();
        $this->bind['segmentations_table'] = $this->setCustomerSegmentations($this->bind['segmentations']);
        $this->setView(__CLASS__, $this->bind);
    }

    public function post()
    {
    }

    private function getCustomerSegmentationsApi()
    {
        $data = [];
        $segmentations = $this->customer->getCustomerSegmentations();

        foreach ($segmentations as $s) {
            $total = $this->customer->getCustomerSegmentationTotal($s);
            \array_push($data, ["name" => $s, "total" => $total]);
        }

        $json = \json_encode($data);

        \header(Http::CONTENT_TYPE_JSON);

        echo $json;
        die();
    }

    private function setCustomerSegmentations($segmentations = [])
    {
        $data = [];
        foreach ($segmentations as $s) {
            $total = $this->customer->getCustomerSegmentationTotal($s);
            \array_push($data, ['name' => $s, 'total' => $total]);
        }

        return $data;
    }

    private function setHtmlDataForSegmentations($s = [])
    {
        $openGate   = '[';
        $closeGate  = ']';
        $data       = '';

        $data       .= $openGate;
        $len        = \count($s);

        foreach ($s as $k => $v) {
            $num = $this->customer->getCustomerSegmentationTotal($v);

            if ($k != ($len - 1)) {
                $data .= '{"name":"' . $v . '","total":"' . $num . '"},';
            } else {
                $data .= '{"name":"' . $v . '","total:"' . $num . '"}';
            }
        }

        $data .= $closeGate;

        return $data;
    }
}
