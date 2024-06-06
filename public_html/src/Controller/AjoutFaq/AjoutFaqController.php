<?php

declare(strict_types=1);

namespace App\Controller\AjoutFaq;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class AjoutFaqController extends Controller{
    public function index($data = []): void
{  
    // define the default locale at french
    $this->webRender('public/AjoutFaq/' . self::INDEX, [
        'title' => 'Gestion de la FAQ',
        'content' => 'Welcome to the FAQ gestion page',
        'cookieSet' => CookieHandler::isCookieSet(),
    ]);
}
}
