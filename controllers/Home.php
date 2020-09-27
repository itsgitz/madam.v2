<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


class Home extends Base
{
    private $title;

    function __construct()
    {
        $this->title = 'Home Page';
    }

    public function index()
    {
        $bind = [
            'title' => $this->title,
        ];

        $this->setView(__CLASS__, $bind);
    }
}