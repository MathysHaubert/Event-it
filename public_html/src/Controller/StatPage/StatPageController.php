<?php

declare(strict_types=1);

namespace App\Controller\StatPage;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class StatPageController extends Controller
{
    public function index($data = []): void
    {
        $this->webRender('public/StatPage/' . self::INDEX, [
            'title' => 'Stat Page',
            'content' => 'Welcome to the stat page',
            'cookieSet' => CookieHandler::isCookieSet(),
        ]);
    }
}