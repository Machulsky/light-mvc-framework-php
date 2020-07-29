<?php

class Autoload {

    //Список директорий, которые следует исключить из поиска
    private static $exception_list = [];

    //Список ранее найденных директорий
    private static $founded_list = [];


    public static function search($dir, $file_to_search) {
        //Если попали на директорию, исключенную из поиска, или уже подключали требуемый класс то игнорируем ее

        //Сканируем текущую директорию в поисках класса
        $scan = glob("$dir/*");
        foreach ($scan as $path) {
            if (preg_match('/\.php$/', $path) && is_file($path)) {
                //Если нашли, то "запоминаем" директорию и подключаем файл
                static::$founded_list[basename($path)] = $path;
                if(basename($path) == $file_to_search) {
                    //if(is_file($path)){die(var_dump($path));}
                    require_once $path;
                    return $path;
                }
            }
            elseif (is_dir($path)) {
                self::search($path, $file_to_search);
            }
        }
    }
}