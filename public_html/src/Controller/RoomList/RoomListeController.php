<?php

declare(strict_types=1);

namespace App\Controller\UserList;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

use App\Entity\Room\Room;
use App\Entity\User\User;

class UserListController extends Controller{
    public function index($data = []): void
    {
        if (empty($currentUser)) {
            //todo: currentUser is empty, so no user is recognize
        }
        if (!isset($_SESSION['user'])) {
            throw new \Exception("User is not recognize");
        }
        $rooms = Room::getLinkedRooms($_SESSION['user']);
        $this->webRender('public/RoomList/' . self::INDEX , [
            'title' => 'User List Page',
            'content' => 'Welcome to the user list page',
            'cookieSet' => CookieHandler::isCookieSet(),
            'rooms' => $rooms,
        ]);
    }
}
