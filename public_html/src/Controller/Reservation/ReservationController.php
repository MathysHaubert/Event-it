<?php

declare(strict_types=1);

namespace App\Controller\Reservation;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\Reservation\Reservation;

class ReservationController extends Controller{
    public function index($data = []): void
{
    $reservationList = Reservation::getReservations();

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
        $reservationList = $this->filterReservation($reservationList, $_GET['search']);
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){

    }

    $this->webRender('public/reservation/' . self::INDEX, [
        'title' => 'Home Page',
        'content' => 'Welcome to the home page',
        'cookieSet' => CookieHandler::isCookieSet(),
        'currentUser' => $_SESSION['user'] ?? '',
        'reservationList' => $reservationList,
        'logged' => isset($_SESSION['user']),
    ]);
}

private function filterReservation($reservationList, $filter) {
    $filter = strtolower($filter);
    return array_filter($reservationList, function($reservation) use ($filter) {
        return $reservation->getDate() == $filter;
    });
}
}
