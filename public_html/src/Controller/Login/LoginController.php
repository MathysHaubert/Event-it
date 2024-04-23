<?php

declare(strict_types=1);

namespace App\Controller\Login;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
class LoginController extends Controller{
    public function index($data = [])
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //TODO: handle login and render the homepage
            $username =  $_POST['_username'];
            $password =  $_POST['_password'];
            header('Location: /');
            $this->webRender('public/Home/' . self::INDEX, [
                'title' => 'Home Page',
                'content' => 'Welcome to the home page',
                'cookieSet' => CookieHandler::isCookieSet(),
            ]);

        } else {
            $this->webRender('public/Login/' . self::INDEX, [
                'title' => 'Login Page',
                'content' => 'Welcome to the login page',
                'cookieSet' => CookieHandler::isCookieSet(),
            ]);
        }

    }


}
