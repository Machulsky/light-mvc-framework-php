<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 26.03.2019
 * Time: 12:30
 */
class Router
{
    public function __construct()
    {
        Route::getInstance();
        $catalog = scandir(ROUTES_DIR);
        foreach ($catalog as $index => $file){
            $path = ROUTES_DIR.$file;
            if(is_file($path)){
                include $path;
            }
        }
        $router =  Route::getRouter();
        $router->onHttpError(function ($code, $router){
            $url  = '/e/'.$code;
            if($code == 404){
                $router->response()->redirect($url, 302);
            }

        });
        Route::getRouter()->dispatch();

    }

}