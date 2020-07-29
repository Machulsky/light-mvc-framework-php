<?php


Route::get('/?', 'PageController@showPage');

Route::get('/json/config', 'JsonController@config');

Route::get('/page/[:page]', 'PageController@showPage');

Route::get('/e/[i:id]', 'ErrorController@showError');

Route::post('/test/?', 'TestController@test');


//Авторизация и регистрация

Route::post('/auth/login', 'Auth/LoginController@doLogin');

Route::get('/auth/login/?', 'Auth/LoginController@showLogin');

Route::get('/auth/register/?', 'Auth/RegisterController@showRegister');

Route::post('/auth/register', 'Auth/RegisterController@doRegister');