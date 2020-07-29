<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 25.03.2019
 * Time: 18:59
 */
class Route
{
    private static $router;
    private static $_instance;

    public function __construct()
    {
        self::InitRouter();
    }


    public static function get($uri, $callback)
    {

        if(is_object($callback)){
            self::$router->respond('GET', $uri, $callback);
        }else{


            self::$router->respond('GET', $uri, self::doAction($callback));
        }
    }

    public static function post($uri, $callback)
    {

        if(is_object($callback)){
            self::$router->respond('POST', $uri, $callback);
        }else{


            self::$router->respond('POST', $uri, self::doAction($callback));
        }
    }

    public static function put($uri, $callback)
    {

        if(is_object($callback)){
            self::$router->respond('PUT', $uri, $callback);
        }else{


            self::$router->respond('PUT', $uri, self::doAction($callback));
        }
    }

    public static function delete($uri, $callback)
    {

        if(is_object($callback)){
            self::$router->respond('DELETE', $uri, $callback);
        }else{


            self::$router->respond('DELETE', $uri, self::doAction($callback));
        }
    }

    public static function any($uri, $callback)
    {

        if(is_object($callback)){
            self::$router->respond(array('POST','GET', 'PUT', 'DELETE'), $uri, $callback);
        }else{


            self::$router->respond(array('POST','GET', 'PUT', 'DELETE'), $uri, self::doAction($callback));
        }
    }


    private static function getControllerAction($callback)
    {
        $path = explode("/", $callback);
        $last = $path[count($path) - 1];

        $lastKey =  count($path) - 1;

        unset($path[$lastKey]);

        $params = explode("@", $last);
        $data = [];
        $data['controller'] = $params[0];
        $data['action'] = $params[1];
        $data['path'] = implode("/", $path).'/'.$params[0];

        return $data;
    }


    private static function doAction($callback)
    {
        return function ($request, $response, $service, $app) use($callback){
            extract(self::getControllerAction($callback));
            require_once INC_DIR.'Http/Controllers/' .$path. '.php';

            $object = new $controller($request, $response, $service, $app);
            $object->$action();
        };
    }

    private static function hui()
    {

    }

    private static function InitRouter()
    {
        if(!is_object(self::$router)){
            self::$router = new \Klein\Klein();
        }
    }

    public static function getRouter()
    {
        return self::$router;
    }

    public static function getInstance()
    {
        if(null !== static::$_instance){
            return static::$_instance;
        }
        static::$_instance = new Route();
        return static::$_instance;
    }

}