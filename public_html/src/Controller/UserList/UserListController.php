<?php

declare(strict_types=1);

namespace App\Controller\UserList;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\User\User;
use App\Entity\Organization\Organization;

class UserListController extends Controller{
    public function index($data = []): void
    {
        $userInstance = new User();
        $organizationInstance = new Organization();
        $userList = $userInstance->getUser([]);
        if(isset($_SESSION['user'])){
            $userInstance = $_SESSION['user'];
        }
        $organizationList = $organizationInstance->getOrganization([]);
        foreach ($organizationList as $organization) {
            echo $organization->getName();
        }
        $this->webRender('public/userList/' . self::INDEX , [
            'title' => 'User List Page',
            'content' => 'Welcome to the user list page',
            'cookieSet' => CookieHandler::isCookieSet(),
            'users' => $userList,
            'user' => $userInstance,
            'organizations' => $organizationList,
        ]);
    }
}
