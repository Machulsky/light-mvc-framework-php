<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 25.03.2019
 * Time: 19:28
 */
class DI
{
    public static $_di;

    public static function set($var, $value)
    {
        self::$_di[$var] = $value;
    }

    public static function get($var)
    {
        return self::$_di[$var];
    }

    public static function init()
    {
        return 1;
    }

}