<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 01.04.2019
 * Time: 19:02
 */
class RegisterController extends Controller
{
    public function doRegister()
    {
        
        $name = $this->request->param('name');
        $email = $this->request->param('email');
        $password = $this->request->param('password');

        $user = new User();

        $user->name = $name;
        $user->type("name","varchar(255)");
        $user->unique("name");

        $user->email = $email;
        $user->type("email","text");

        $user->password = password_hash($password, PASSWORD_BCRYPT);
        $user->type("password","text");

        $user->save();
    }

    public function showRegister()
    {
        echo "Registration";
    }

}