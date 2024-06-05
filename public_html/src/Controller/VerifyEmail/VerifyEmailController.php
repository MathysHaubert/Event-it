<?php

declare(strict_types=1);

namespace App\Controller\VerifyEmail;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\User\User;


class VerifyEmailController extends Controller {
    public function index($data = []): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
            $this->webRender('public/homePage/' . self::INDEX, [
                'title' => 'Home Page',
                'content' => 'Welcome to the home page',
                'cookieSet' => CookieHandler::isCookieSet(),
            ]);
        } else {
            $this->webRender('public/VerifyEmail/' . self::INDEX, [
                'title' => 'Verify Email Page',
                'content' => 'Error verifying email. Please try again.',
                'cookieSet' => CookieHandler::isCookieSet(),
            ]);
        }
    }
}
