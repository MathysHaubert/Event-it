<?php

declare(strict_types=1);

namespace App\Controller\Home;

use App\Controller\Controller;

class HomeController extends Controller{
    public function index(): void
{
    $this->webRender('public/homePage/' . self::INDEX, [
        'title' => 'Home Page',
        'content' => 'Welcome to the home page'
    ]);
}

}