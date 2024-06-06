<?php

declare(strict_types=1);

namespace App\Controller\Login;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\User\User;

class LoginController extends Controller{
    public function index($data = [])
    {
        if(isset($_SESSION['user']) && ($_SESSION['user'] instanceof User)){
            header('Location: /userprofile');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username =  $_POST['_username'];
            $password =  $_POST['_password'];
            $user = User::login(["email" => $username, "password" => $password]);
            if(is_array($user) && isset($user['error'])){
                $this->webRender('public/Login/' . self::INDEX, [
                    'title' => 'Login Page',
                    'content' => 'Welcome to the login page',
                    'cookieSet' => CookieHandler::isCookieSet(),
                    'error' => $user['error']
                ]);
                exit();
            }
            if (!empty($user)){
                $_SESSION['jwt'] = $user->getJwt();
                $_SESSION['user'] = $user;
                }
                header('Location: /');
                exit();
        } else {
            $this->webRender('public/Login/' . self::INDEX, [
                'title' => 'Login Page',
                'content' => 'Welcome to the login page',
                'cookieSet' => CookieHandler::isCookieSet(),
            ]);
        }

    }


}
