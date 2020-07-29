<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 26.03.2019
 * Time: 1:14
 */
class JsonController extends Controller
{
    public function config()
    {

       echo file_get_contents(ROOT_DIR.'config/config.json');
    }

}