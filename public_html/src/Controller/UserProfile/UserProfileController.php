<?php

declare(strict_types=1);

namespace App\Controller\UserProfile;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\User\User;

class UserProfileController extends Controller
{
    public function index($data = []): void
    {
        error_log("Index method called");
        error_log("POST data: " . json_encode($_POST));

        if (isset($_SESSION['user'])) {
            $currentUser = $_SESSION['user'];
        }

        if (!isset($currentUser)) {
            header('Location: /login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['logout'])) {
                error_log("Updating user profile");
                $this->updateUser($_POST);
            } elseif (isset($_POST['logout'])) {
                error_log("Logging out");
                $this->logout();
            }
        }

        $this->webRender('public/UserProfile/' . self::INDEX, [
            'title' => 'Home Page',
            'content' => 'Welcome to the home page',
            'cookieSet' => CookieHandler::isCookieSet(),
            'user' => $currentUser,
        ]);
    }

    public function updateUser($data): void
    {
        error_log("UpdateUser method called");

        $user = $_SESSION['user'];
        $userId = $user->getUserId();
        error_log("User ID: " . $userId);

        if (!$userId) {
            error_log("User ID is missing.");
            return;
        }

        if (isset($data['email'])) {
            $user->setEmail($data['email']);
        }

        if (isset($data['first_name'])) {
            $user->setFirstName($data['first_name']);
        }

        if (isset($data['last_name'])) {
            $user->setLastName($data['last_name']);
        }

        if (isset($data['password'])) {
            $user->setPassword($data['password']);
        }

        $response = $user->updateUser([
            'id' => $userId,
            'email' => $user->getEmail(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'password' => $user->getPassword(),
        ]);
        error_log(json_encode($response));
    }

    public function logout(): void
    {
        error_log("Logout method called");

        unset($_SESSION['user']);
        unset($_SESSION['jwt']);
        header('Location: /login');
        exit();
    }
}
