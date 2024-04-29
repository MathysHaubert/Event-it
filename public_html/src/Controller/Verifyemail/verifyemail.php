<?php

declare(strict_types=1);

namespace App\Controller\Verifyemail;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class verifyemail extends Controller{
    public function index($data = []): void
    {
        // define the default locale at french
        $this->webRender('public/verifyEmail/' . self::INDEX, [
            'title' => 'Verify Email',
            'content' => 'Welcome to the home page',
            'cookieSet' => CookieHandler::isCookieSet(),
        ]);
    }
}
