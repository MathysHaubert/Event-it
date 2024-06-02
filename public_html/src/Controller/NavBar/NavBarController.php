<?php

declare(strict_types=1);

namespace App\Controller\Home;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class HomeController extends Controller{
    public function index($data = []): void
{
    $this->webRender('public/homePage/' . self::INDEX, [
        'title' => 'Home Page',
        'content' => 'Welcome to the home page',
        'cookieSet' => CookieHandler::isCookieSet(),
        'user' => $_SESSION['user'] ?? '',
    ]);
}
}
