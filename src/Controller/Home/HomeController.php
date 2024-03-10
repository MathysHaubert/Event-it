<?php

declare(strict_types=1);

namespace App\Controller\Home;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Trait\dd as dd;
class HomeController extends Controller{
    public function index(): void
{
    // define the default locale at french
    $this->webRender('public/homePage/' . self::INDEX, [
        'title' => 'Home Page',
        'content' => 'Welcome to the home page',
        'cookieSet' => CookieHandler::isCookieSet(),
    ]);
}

}