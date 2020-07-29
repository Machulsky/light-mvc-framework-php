<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 02.04.2019
 * Time: 16:38
 */
class Validator
{
    public static function username()
    {

    }

    public static function len($min, $max)
    {
        return function ($str) use($min, $max) {
            return strlen($str) >= $min or strlen($str) <= $max;

        };
    }

}