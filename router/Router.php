<?php

/**
 * Author: anggit.ginanjar@outlook.com <itsgitz.com>
 */

namespace Madam;


use \Klein\Klein;

class Router
{
    private $controllers;

    function __construct()
    {
        $this->controllers = [];
    }

    public function init()
    {
        // initialize klein router library
        $r = new Klein();

        // define list of route or endpoint
        $this->routes($r);

        // run http error handler
        $this->errorHandler($r);

        // run the router
        $r->dispatch();
    }

    // Define controllers for pointing to route / endpoint here:
    private function setController()
    {
        return [
            'Home' => new Home(),
            'Login' => new Login(),
            'Users' => new Users(),
        ];
    }

    private function routes($r = null)
    {
        $this->controllers = $this->setController();

        $r->respond('GET', '/', $this->setCallbackController($this->controllers['Home']));
        $r->respond('GET', '/login', $this->setCallbackController($this->controllers['Login']));
        $r->respond('GET', '/users', $this->setCallbackController($this->controllers['Users']));
    }

    private function setCallbackController($obj = null)
    {
        return [$obj, 'index'];
    }

    private function errorHandler($r = null)
    {
        $r->onHttpError(function ($code, $router) {
            switch ($code) {
                    // if not found
                case 404:
                    $router->response()->body(
                        '404 page not found'
                    );
                    break;
                    // default error
                default:
                    $router->response()->body(
                        'Something went wrong :('
                    );
                    break;
            }
        });
    }
}
