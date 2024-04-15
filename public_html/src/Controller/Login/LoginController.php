<?php

declare(strict_types=1);

namespace App\Controller\Login;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
class LoginController extends Controller{
    public function index($data = []): void
    {
        $this->webRender('public/Login/' . self::INDEX, [
            'title' => 'Login Page',
            'content' => 'Welcome to the login page',
            'cookieSet' => CookieHandler::isCookieSet(),
        ]);
    }
}
