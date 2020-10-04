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
        $name = $this->setFileNamePrefix($class);
        
        echo $this->blade->run($name, $data);
    }

    /**
     * setFileNamePrefix
     * 
     * @param string $class = class name, e.g: Madam\HomeController
     * @param string $fileName
     */
    private function setFileNamePrefix($class)
    {
        $spl    = explode('\\', $class);
        $lower  = strtolower($spl[1]);

        $endStr     = substr($lower, -10);
        $endLen     = strlen($endStr);
        $fullLen    = strlen($lower);
        $strPos     = $fullLen - $endLen;

        $fileName = substr($lower, 0, $strPos);
    
        return $fileName;
    }
}