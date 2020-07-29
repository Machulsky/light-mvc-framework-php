<?php

require 'functions.php';
require 'Helpers/Autoload.php';

spl_autoload_register('app_autoload');

$cfg = [
    'host' => '127.0.0.1',
    'username' => 'root',
    'password' => 'i7DXOA230a',
    'database'   => 'mc_site',
    'port' => 3306
];



DI::set('db', DB::getInstance($cfg));

loadModels();
require_once 'Http/bootstrap.php';




