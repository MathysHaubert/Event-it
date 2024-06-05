<?php

declare(strict_types=1);

namespace App\Controller\Reservation;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class ReservationController extends Controller{
    public function index($data = []): void
{
    $this->webRender('public/reservation/' . self::INDEX, [
        'title' => 'Home Page',
        'content' => 'Welcome to the home page',
        'cookieSet' => CookieHandler::isCookieSet(),
        'user' => $_SESSION['user'] ?? '',
    ]);
}
}
