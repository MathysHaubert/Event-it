<?php

declare(strict_types=1);

namespace App\Controller\Reservation;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\Reservation\Reservation;

class ReservationController extends Controller {
    public function index($data = []): void {
        try {
            $url = $_SERVER['REQUEST_URI'];
            $urlParts = explode('/', $url);
            $id = end($urlParts);

            $reservationList = Reservation::getReservations(['room' => ["id" => $id]]);
            $room = $id;

            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
                $reservationList = $this->filterReservation($reservationList, $_GET['search']);
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_reservation_date'])) {
                $reservationData = [
                    'startAt' => $_POST['new_reservation_date'] . "T00:00:00Z",
                    'endAt' => $_POST['new_reservation_date'] . "T00:00:00Z",
                    'room' => $room,
                    'organization' => $_SESSION['user']->getOrganization()->getId(),
                ];
                error_log(print_r($reservationData, true));
                Reservation::createReservation($reservationData);
                header('Location: /reservation/' . $room);
                exit();
            }

            $this->webRender('public/reservation/' . self::INDEX, [
                'title' => 'Home Page',
                'content' => 'Welcome to the home page',
                'cookieSet' => CookieHandler::isCookieSet(),
                'currentUser' => $_SESSION['user'] ?? '',
                'reservationList' => $reservationList,
                'logged' => isset($_SESSION['user']),
                'roomId' => $room,
            ]);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            echo 'An error occurred. Please check the logs for details.';
        }
    }

    private function filterReservation($reservationList, $filter) {
        $filter = strtolower($filter);
        return array_filter($reservationList, function ($reservation) use ($filter) {
            return $reservation->getDate() == $filter;
        });
    }
}
