<?php

declare(strict_types=1);

namespace App\Controller\RoomList;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class RoomListController extends Controller{
    public function index($data = []): void
{
    $this->webRender('public/roomList/' . self::INDEX, [
        'title' => 'Home Page',
        'content' => 'Welcome to the home page',
        'cookieSet' => CookieHandler::isCookieSet(),
        'currentUser' => $_SESSION['user'] ?? '',
        'logged' => isset($_SESSION['user']),
    ]);
}
}
