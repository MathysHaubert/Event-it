<?php

declare(strict_types=1);

namespace App\Controller\UserList;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\User\User;
use App\Entity\Organization\Organization;

class UserListController extends Controller {
    public function index($data = []): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user-update-form'])) {
            $this->updateUser($_POST);
        }

        $userInstance = new User();
        $organizationInstance = new Organization();
        $userList = $userInstance->getUser([]);
        $organizationList = $organizationInstance->getOrganization();

        if (isset($_SESSION['user'])) {
            $currentUser = $_SESSION['user'];
            if ($currentUser->getRole() == 'ADMIN') {
                $userList = array_filter($userList, function($user) use ($currentUser) {
                    return $user->getOrganization() && $user->getOrganization()->getName() == $currentUser->getOrganization()->getName();
                });
            } elseif ($currentUser->getRole() == 'USER') {
                $userList = array_filter($userList, function($user) use ($currentUser) {
                    return $user->getOrganization() && $user->getOrganization()->getName() == $currentUser->getOrganization()->getName();
                });
            }
        }

        // Handle user filtering
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
            $userList = $this->filterUser($userList, $_GET['search']);
        }

        $this->webRender('public/userList/' . self::INDEX, [
            'title' => 'User List Page',
            'content' => 'Welcome to the user list page',
            'cookieSet' => CookieHandler::isCookieSet(),
            'users' => $userList,
            'currentUser' => $currentUser ?? null,
            'organizations' => $organizationList,
            'logged' => isset($_SESSION['user']),
        ]);
    }

    public function updateUser($data): void {
        foreach ($data as $key => $value) {
            if (strpos($key, 'role_') === 0) {
                $userId = str_replace('role_', '', $key);
                if ($userId !== '') {
                    $user = (new User())->getUser(["id" => $userId]);
                    if ($user) {
                        $user->setRole($value);
                        $user->updateUser([
                            'id' => $userId,
                            'role' => $value,
                        ]);
                    }
                }
            } elseif (strpos($key, 'organization_') === 0) {
                $userId = str_replace('organization_', '', $key);
                if ($userId !== '') {
                    $user = (new User())->getUser(["id" => $userId]);
                    $organization = (new Organization())->getOrganizationById(["id" => $value]);
                    error_log(json_encode($organization));
                    if ($user && $organization) {
                        $user->setOrganization($organization);
                        $user->updateUser([
                            'id' => $userId,
                            'organization' => $organization,
                        ]);
                    }
                }
            }
        }
    }




    private function filterUser($userList, $filter) {
        $filter = strtolower($filter);
        return array_filter($userList, function($user) use ($filter) {
            $organizationName = $user->getOrganization() ? $user->getOrganization()->getName() : '';
            $f = [
                stripos(strtolower($user->getRole()), $filter) !== false,
                stripos(strtolower($organizationName), $filter) !== false,
                stripos(strtolower($user->getFirstName()), $filter) !== false,
                stripos(strtolower($user->getLastName()), $filter) !== false
            ];
            return in_array(true, $f);
        });
    }
}
