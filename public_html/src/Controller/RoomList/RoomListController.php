<?php

declare(strict_types=1);

namespace App\Controller\RoomList;

use App\Entity\User\Api;
use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\Room\Room;
use App\Entity\User\User;

class RoomListController extends Controller{
    public function index($data = []): void
    {
        $userInstance = new User();
        $userList = $userInstance->getUser([]);
        if (isset($_SESSION['user'])) {
            $currentUser = $_SESSION['user'];
            if ($currentUser->getRole() == 'ADMIN') {
                $rooms = Room::getRooms();
                $this->webRender('public/RoomList/' . self::INDEX, [
                    'title' => 'Room List Page',
                    'content' => 'Welcome to the room list page',
                    'cookieSet' => CookieHandler::isCookieSet(),
                    'rooms' => $rooms,
                    'user' => $currentUser,
                    'logged' => isset($_SESSION['user']),
                    'buttonAddRoom' => false,
                ]);
            } elseif ($currentUser->getRole() == 'USER') {
                $this->webRender('public/homePage/' . self::INDEX, [
                    'title' => 'Home Page',
                    'content' => 'Welcome to the home page',
                    'cookieSet' => CookieHandler::isCookieSet(),
                ]);
                return;
            } elseif ($currentUser->getRole() == 'SUPER_ADMIN') {
                $rooms = Room::getRooms();
                $this->webRender('public/RoomList/' . self::INDEX, [
                    'title' => 'Room List Page',
                    'content' => 'Welcome to the room list page',
                    'cookieSet' => CookieHandler::isCookieSet(),
                    'rooms' => $rooms,
                    'user' => $currentUser,
                    'logged' => isset($_SESSION['user']),
                    'buttonAddRoom' => true,
                ]);
            }
        }
    }

    public function createRoom($data = []) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            (new Api())->post($_ENV['API_URL'].'/room',array("location" => $_POST['room_name']));
        }
        header('Location: /roomlist');
    }
}
