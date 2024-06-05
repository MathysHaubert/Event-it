<?php

declare(strict_types=1);

namespace App\Controller\UserProfile;

use Api;
use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\User\User;

class UserProfileController extends Controller{
    public function index($data = []): void
{
    if(isset($_SESSION['user'])){
        $currentUser = $_SESSION['user'];
    }

    if(!isset($currentUser)){
        header('Location: /login');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->updateUser($_POST);
    }

    // define the default locale at french
    $this->webRender('public/UserProfile/' . self::INDEX, [
        'title' => 'Home Page',
        'content' => 'Welcome to the home page',
        'cookieSet' => CookieHandler::isCookieSet(),
        'user' => $currentUser,
    ]);
}

public function updateUser($data): void
    {
        if (!isset($data['id'])) {
            error_log("User ID is missing.");
            return;
        }

        $userId = $data['id'];
        $user = (new User())->getUser(["id" => $userId]);

        if (!$user) {
            error_log("User not found for ID: $userId");
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
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'password' => $user->getPassword(),
        ]);
        error_log(json_encode($response));
    }
}
