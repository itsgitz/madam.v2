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

    public function run($class, $data = [])
    {
        $name = $this->setViewName($class);
        
        echo $this->blade->run($name, $data);
    }

    private function setViewName($class)
    {
        $spl = explode('\\', $class);
        $lower = strtolower($spl[1]);

        return $lower;
    }
}