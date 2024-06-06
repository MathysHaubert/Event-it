<?php

declare(strict_types=1);

namespace App\Controller\RoomList;

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
        // todo: si user admin/super_admin alors c'est ok
        // todo: si super_admin il a un bouton addroom en bas pour ajouter une room quand le bouton est cliqué ça fait pop un inpout avec un autre bouton
        // todo: et puis du coup après l'input tu rentres le room name et sa rajoute une room

    }
}
