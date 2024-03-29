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

        // start session
        $r->service()->startSession();

        // define list of route or endpoint
        $this->routes($r);

        // run http error handler
        $this->errorHandler($r);

        // auth middleware
        $this->auth($r);

        // run the router
        $r->dispatch();
    }

    // Define controllers for pointing to route / endpoint here:
    private function setController()
    {
        return [
            'HomeController' => new HomeController(),
            'LoginController' => new LoginController(),
            'UsersController' => new UsersController(),
            'LogoutController' => new LogoutController(),
            'CustomersController' => new CustomersController(),
            'CIDController' => new CIDController(),
            'SettingController' => new SettingController(),
            'AccessRightsController' => new AccessRightsController(),
            'VlanController' => new VlanController(),
            'DashboardController' => new DashboardController(),
            'VlanSiteController' => new VlanSiteController(),
        ];
    }

    private function routes($r = null)
    {
        $this->controllers = $this->setController();

        $r->respond(Http::METHOD_GET, '/', $this->setCallbackController($this->controllers['HomeController'], Http::METHOD_GET));
        $r->respond(Http::METHOD_GET, '/login', $this->setCallbackController($this->controllers['LoginController'], Http::METHOD_GET));
        $r->respond(Http::METHOD_POST, '/login', $this->setCallbackController($this->controllers['LoginController'], Http::METHOD_POST));
        $r->respond(Http::METHOD_GET, '/logout', $this->setCallbackController($this->controllers['LogoutController'], Http::METHOD_GET));
        $r->respond(Http::METHOD_GET, '/customers', $this->setCallbackController($this->controllers['CustomersController'], Http::METHOD_GET));
        $r->respond(Http::METHOD_GET, '/users', $this->setCallbackController($this->controllers['UsersController'], Http::METHOD_GET));
        $r->respond(Http::METHOD_GET, '/cid', $this->setCallbackController($this->controllers['CIDController'], Http::METHOD_GET));
        $r->respond(Http::METHOD_POST, '/customers', $this->setCallbackController($this->controllers['CustomersController'], Http::METHOD_POST));
        $r->respond(Http::METHOD_POST, '/users', $this->setCallbackController($this->controllers['UsersController'], Http::METHOD_POST));
        $r->respond(Http::METHOD_POST, '/cid', $this->setCallbackController($this->controllers['CIDController'], Http::METHOD_POST));
        $r->respond(Http::METHOD_GET, '/settings', $this->setCallbackController($this->controllers['SettingController'], Http::METHOD_GET));
        $r->respond(Http::METHOD_POST, '/settings', $this->setCallbackController($this->controllers['SettingController'], Http::METHOD_POST));
        $r->respond(Http::METHOD_GET, '/access_rights', $this->setCallbackController($this->controllers['AccessRightsController'], Http::METHOD_GET));
        $r->respond(Http::METHOD_POST, '/access_rights', $this->setCallbackController($this->controllers['AccessRightsController'], Http::METHOD_POST));
        $r->respond(Http::METHOD_GET, '/vlan', $this->setCallbackController($this->controllers['VlanController'], Http::METHOD_GET));
        $r->respond(Http::METHOD_POST, '/vlan', $this->setCallbackController($this->controllers['VlanController'], Http::METHOD_POST));
        $r->respond(Http::METHOD_GET, '/dashboard', $this->setCallbackController($this->controllers['DashboardController'], Http::METHOD_GET));
        $r->respond(Http::METHOD_GET, '/vlan_site', $this->setCallbackController($this->controllers['VlanSiteController'], Http::METHOD_GET));
        $r->respond(Http::METHOD_POST, '/vlan_site', $this->setCallbackController($this->controllers['VlanSiteController'], Http::METHOD_POST));
    }

    private function setCallbackController($obj = null, $method)
    {
        switch ($method) {
            case Http::METHOD_GET:
                return [$obj, 'index'];
                break;

            case Http::METHOD_POST:
                return [$obj, 'post'];
                break;

            case Http::METHOD_PUT:
                return [$obj, 'put'];
                break;

            case Http::METHOD_DELETE:
                return [$obj, 'delete'];
                break;

            default:
                break;
        }
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
                        'Something went wrong, this error is occured from router :('
                    );
                    break;
            }
        });
    }

    private function auth($r = null)
    {
        $auth = new Auth();

        if (!$auth->isLoggedIn()) {
            $r->respond(function ($request, $response) {
                if ($request->uri() != '/login' && $request->uri() != '/logout') {
                    $response->redirect('/login')->send();
                    die();
                }
            });
        } else {
            $r->respond(function ($request, $response) {
                if ($request->uri() == '/login') {
                    $response->redirect('/')->send();
                }
            });
        }
    }
}
