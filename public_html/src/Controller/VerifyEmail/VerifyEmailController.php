<?php

declare(strict_types=1);

namespace App\Controller\VerifyEmail;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\User\User;


class VerifyEmailController extends Controller {
    public function index($data = []): void
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
            $this->webRender('public/register/' . self::INDEX, [
                'title' => 'Home Page',
                'content' => 'Welcome to the home page',
                'cookieSet' => CookieHandler::isCookieSet(),
            ]);
        } else {
            if ($_SESSION['verifyEmail_code'] === $_POST['code_email']) {
                $user = User::createUser($_SESSION['temporary_user']);
                $user = User::login(["email" => $user->getEmail(), "password" => $user->getPassword()]);
                if (!empty($user)){
                    $_SESSION['jwt'] = $user->getJwt();
                    $_SESSION['user'] = $user;
                }
                header('Location: /');
                exit();
            } else {
                $this->webRender('public/VerifyEmail/' . self::INDEX, [
                    'title' => 'Home Page',
                    'content' => 'Welcome to the home page',
                    'cookieSet' => CookieHandler::isCookieSet(),
                    'error' => 'Code is not correct'
                ]);
            }
        }
    }
}
