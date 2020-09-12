<?php
/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


use eftec\bladeone\BladeOne;

class Views
{
    const VIEW = './views';
    const CACHE = './cache';

    private $blade;

    function __construct()
    {
        $this->blade = new BladeOne(self::VIEW, self::CACHE, BladeOne::MODE_DEBUG);
    }

    public function run()
    {
        echo $this->blade->run('home', ['var' => 'val']);
    }
}