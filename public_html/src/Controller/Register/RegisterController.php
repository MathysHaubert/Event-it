<?php

declare(strict_types=1);

namespace App\Controller\Register;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\User\User;

class RegisterController extends Controller
{
    public function index($data = []): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fistName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            $userInstance = new User();
            if ($confirmPassword !== $password ) {
                self::webRender('public/Register/' . self::INDEX, [
                    'title' => 'Register Page',
                    'content' => 'Welcome to the register page',
                    'cookieSet' => CookieHandler::isCookieSet(),
                    'error' => 'Passwords do not match',
                ]);
                return;
            }
            $user = User::createUser(["email" => $email, "password" => $password, "lastName" => $lastName, "firstName" => $fistName, "role" => ""]);
            if (!empty($user)) {
                $userList = $userInstance->getUser([]);
                $this->webRender('public/VerifyEmail/' . self::INDEX, [
                    'title' => 'User List Page',
                    'content' => 'Welcome to the user list page',
                    'cookieSet' => CookieHandler::isCookieSet(),
                    'users' => $userList,
                ]);
            }
        } else {
            $this->webRender('public/Register/' . self::INDEX, [
                'title' => 'Register Page',
                'content' => 'Welcome to the register page',
                'cookieSet' => CookieHandler::isCookieSet(),
            ]);
        }
    }
}
