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
            error_log("User :".json_encode($user));
            if (!empty($user)){
                $_SESSION['jwt'] = $user->getJwt();
                $_SESSION['user'] = $user;
                }
                $this->webRender('public/userList/' . self::INDEX , [
                    'title' => 'User List Page',
                    'content' => 'Welcome to the user list page',
                    'cookieSet' => CookieHandler::isCookieSet(),
                    'users' => $user,
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
