<?php

declare(strict_types=1);

namespace App\Controller\UserProfile;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class UserProfileController extends Controller{
    public function index($data = []): void
{
    if(isset($_SESSION['user'])){
        $currentUser = $_SESSION['user'];
    }

    if(!isset($currentUser)){
        header('Location: /login');
        exit();
    }

    // define the default locale at french
    $this->webRender('public/UserProfile/' . self::INDEX, [
        'title' => 'Home Page',
        'content' => 'Welcome to the home page',
        'cookieSet' => CookieHandler::isCookieSet(),
        'user' => $currentUser,
    ]);
}
}
