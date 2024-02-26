<?php

declare(strict_types=1);

namespace App\Controller\Home;

use App\Kernel\Kernel;
use App\Controller\Controller;

class HomeController extends Controller{
    public function index(): void
{
    $this->twig->display('public/homePage/' . self::INDEX);
}

}