<?php

declare(strict_types=1);

namespace App\Controller\CGU;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class CguController extends Controller{
    public function index($data = []): void
{
    $this->webRender('public/cgu/' . self::INDEX, [
        'title' => 'Home Page',
        'content' => 'Welcome to the home page',
        'cookieSet' => CookieHandler::isCookieSet(),
        'user' => $_SESSION['user'] ?? '',
    ]);
}
}
