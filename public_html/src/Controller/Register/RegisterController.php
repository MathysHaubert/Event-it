<?php

declare(strict_types=1);

namespace App\Controller\Register;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class RegisterController extends Controller{
    public function index($data = []): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username =  $_POST['_username'];
            $password =  $_POST['_password'];
            $email =  $_POST['_email'];
            header('Location: /login');
            $this->webRender('public/Home/' . self::INDEX, [
                'title' => 'Login Page',
                'content' => 'Welcome to the login page',
                'cookieSet' => CookieHandler::isCookieSet(),
            ]);

        } else {
            $this->webRender('public/Register/' . self::INDEX, [
                'title' => 'Register Page',
                'content' => 'Welcome to the register page',
                'cookieSet' => CookieHandler::isCookieSet(),
            ]);
        }
    }
}
