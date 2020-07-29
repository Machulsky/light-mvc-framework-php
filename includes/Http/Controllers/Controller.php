<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 25.03.2019
 * Time: 19:55
 */
abstract class Controller
{
    public function __construct($request, $response, $service, $app)
    {
        $this->request = $request;
        $this->response = $response;
        $this->service = $service;
        $this->klein = $app;
        $this->view = new View($service);

        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) or empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
        {
            $this->ajax = false;
        }else{
            $this->ajax = true;
        }


    }

    protected function includes()
    {
        $uri = Uri::scriptsUri();

        return '<script src="'.$uri.'jquery.js"></script> <script src="'.$uri.'app.js"></script>'.CSRF::putTokenField();

    }

    public function index(){

    }

}