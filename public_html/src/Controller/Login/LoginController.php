<?php

declare(strict_types=1);

namespace App\Controller\Login;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\User\User;

class LoginController extends Controller{
    public function index($data = [])
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username =  $_POST['_username'];
            $password =  $_POST['_password'];
            echo $password;
            $user = User::login(["email" => $username, "password" => $password]);   //todo : actually login the user on the app
            if ($user) {
                header('Location: /');
                exit;
            } else {
                $this->render();
            }

        } else {
            $this->render();
        }
    }

    private function render(){  //todo: this just rerender the page, need to add error messages on why user cant log in @EnzoDEPRE your job now
        $this->webRender('public/Login/' . self::INDEX, [
            'title' => 'Login Page',
            'content' => 'Welcome to the login page',
            'cookieSet' => CookieHandler::isCookieSet(),
        ]);
    }


}
