<?php

namespace App\Cookie;

use App\Kernel\Kernel;
use App\Tools\JsonResponse;

class CookieHandler
{
    public function setCookieAccepted(): bool|int
    {
        $_SESSION['cookiesAccepted'] = true;
        setcookie("cookiesAccepted", "true", time() + (24 * 60 * 60), "/");
        return http_response_code(200);
    }

    public function handleRequest()
    {
        if (isset($_POST['action']) && $_POST['action'] === 'acceptCookies') {
            $this->setCookieAccepted();
        } else {
            $_SESSION['cookiesAccepted'] = false;
        }
    }
    public static function isCookieSet(): bool
    {
        if (isset($_SESSION['cookiesAccepted']) || isset($_COOKIE['cookiesAccepted'])) {
            return true;
        }
        return false;
    }
}
