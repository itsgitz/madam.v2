<?php

namespace Madam;


class CIDController extends BaseController
{
    private $bind = [];
    private $cid;
    private $sessions;

    function __construct()
    {
        $this->sessions = $this->sessionsInit()->getSessions();
        $this->bind = [
            'title' => 'CID',
            'name' => $this->sessions['name'],
            'admin' => $this->sessions['admin']
        ];
        $this->cid = new CID();
    }

    public function index()
    {
        $this->bind['cid'] = $this->cid->getCIDs();
        $this->setView(__CLASS__, $this->bind);
    }
}