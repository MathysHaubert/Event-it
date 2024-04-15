<?php

declare(strict_types=1);

namespace App\Controller\Register;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class RegisterController extends Controller{
    public function index($data = []): void
    {
        // define the default locale at french
        $this->webRender('public/Register/' . self::INDEX , [
            'title' => 'Register Page',
            'content' => 'Welcome to the register page',
            'cookieSet' => CookieHandler::isCookieSet(),
        ]);
    }
}
