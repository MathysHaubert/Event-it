<?php

declare(strict_types=1);

namespace App\Controller\FAQ;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class FaqController extends Controller{
    public function index($data = []): void
{  
    // define the default locale at french
    $this->webRender('public/faqPage/' . self::INDEX, [
        'title' => 'Home Page',
        'content' => 'Welcome to the home page',
        'cookieSet' => CookieHandler::isCookieSet(),
    ]);
}
}