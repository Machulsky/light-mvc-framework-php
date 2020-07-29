<?php
/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 25.03.2019
 * Time: 17:03
 */

function app_autoload($class){
    Autoload::search(INC_DIR, $class.'.php');
}

function app_autoload_ns($class){
    $parts = explode('\\', $class);
    $path = dirname(__FILE__)."/";
    foreach ($parts as $part => $val){
        if (!next($parts)) {
            $path.=$val;
        }
        else {
            $path.=$val.'/';
        }

    }

    require $path . '.php';
}

function include_dir($path) {
    if(is_dir($path)) {
        foreach (glob($path.'*') as $filename) {
            if(is_file($filename) && pathinfo($filename, PATHINFO_EXTENSION) == 'php') {
                require_once $filename;
            } elseif(is_dir($filename)) {
                include_dir($filename.'/');
            }
        }
    }
}

function dd($var)
{
    die(var_dump($var));
}

function loadModels()
{
    $dir_data = scandir(INC_DIR.'Models');
    unset($dir_data[0]);
    unset($dir_data[1]);
    foreach ($dir_data as $item => $val) {
        $modelName = str_replace('.php', '', $val);

        if($modelName != 'Model'){
            $is = is_subclass_of($modelName, 'Model');
            if($is){
                $model = new $modelName();
            }
        }
    }

}