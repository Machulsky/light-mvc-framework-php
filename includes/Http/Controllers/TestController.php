<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 27.03.2019
 * Time: 1:57
 */
class TestController extends Controller
{
    public function test()
    {
        die(var_dump(CSRF::isValidRequest()));
    }


}