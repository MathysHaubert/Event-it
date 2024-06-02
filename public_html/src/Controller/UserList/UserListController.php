<?php

declare(strict_types=1);

namespace App\Controller\UserList;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\User\User;
use App\Entity\Organization\Organization;

class UserListController extends Controller {
    public function index($data = []): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->updateUser($_POST);
        }

        $userInstance = new User();
        $organizationInstance = new Organization();
        $userList = $userInstance->getUser([]);
        $organizationList = $organizationInstance->getOrganization([]);

        if (isset($_SESSION['user'])) {
            $currentUser = $_SESSION['user'];
        } else {
            die('User not set in session');
        }

        if ($currentUser->getRole() == 'ADMIN') {
            $userList = array_filter($userList, function($user) use ($currentUser) {
                return $user->getOrganization() && $user->getOrganization()->getName() == $currentUser->getOrganization()->getName();
            });
        } elseif ($currentUser->getRole() == 'USER') {
            $userList = array_filter($userList, function($user) use ($currentUser) {
                return $user->getOrganization() && $user->getOrganization()->getName() == $currentUser->getOrganization()->getName();
            });
        }

        $this->webRender('public/userList/' . self::INDEX, [
            'title' => 'User List Page',
            'content' => 'Welcome to the user list page',
            'cookieSet' => CookieHandler::isCookieSet(),
            'users' => $userList,
            'currentUser' => $currentUser,
            'organizations' => $organizationList,
        ]);
    }

    public function updateUser($data): void {
        foreach ($data as $key => $value) {
            if (strpos($key, 'role_') === 0) {
                $userId = str_replace('role_', '', $key);
                $user = (new User())->getUser(["id" => $userId]);
                if ($user) {
                    $user->setRole($value);
                    $user->updateUser([
                        'userId' => $userId,
                        'role' => $value,
                    ]);
                }
            } elseif (strpos($key, 'organization_') === 0) {
                $userId = str_replace('organization_', '', $key);
                $user = (new User())->getUser(["id" => $userId]);
                if ($user) {
                    $organizationId = $value;
                    $user->setOrganizationId($organizationId);
                    $user->updateUser([
                        'userId' => $userId,
                        'organizationId' => $organizationId,
                    ]);
                }
            }
        }
    }
}
