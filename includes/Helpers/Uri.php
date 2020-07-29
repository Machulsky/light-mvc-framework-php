<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 26.03.2019
 * Time: 0:36
 */
class Uri
{
    public static function baseUri()
    {
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }

        return $protocol . "://" . $_SERVER['HTTP_HOST'];
    }

    public static function scriptsUri()
    {
        return self::baseUri().'/includes/js/';
    }

}