<?php

declare(strict_types=1);

namespace App\Controller\UserList;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\User\User;

class UserListController extends Controller{
    public function index($data = []): void
    {
        $userInstance = new User();
        $userList = $userInstance->getUser([]);
        if (!empty($_SESSION['jwt'])) {
            $userInstance->setJwt($_SESSION['jwt']);
        }
        $currentUser = $userInstance->getCurrentUser($userInstance->getJwt());  
        $this->webRender('public/userList/' . self::INDEX , [
            'title' => 'User List Page',
            'content' => 'Welcome to the user list page',
            'cookieSet' => CookieHandler::isCookieSet(),
            'users' => $userList,
        ]);
    }
}
