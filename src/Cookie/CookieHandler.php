<?php

namespace App\Cookie;

use App\Kernel\Kernel;

class CookieHandler
{
    public function setCookieAccepted(): bool|int
    {
        setcookie("cookiesAccepted", "true", time() + (365 * 24 * 60 * 60), "/");
        Kernel::logger('Cookies accepted');
        return http_response_code(200);
    }

    public function handleRequest()
    {
        if (isset($_POST['action']) && $_POST['action'] === 'acceptCookies') {
            $this->setCookieAccepted();
        }
    }
}
