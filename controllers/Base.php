<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


class Base
{
    function __construct()
    {
        
    }

    protected function setView($class, $data = [])
    {
        $v = new Views();
        $v->run($class, $data);
    }
}