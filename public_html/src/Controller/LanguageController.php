<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class LanguageController extends Controller
{
    public function changeLanguage($data = [], $currentPage = "/"): void
    {
        if (isset($data['locale'])) {
            $_SESSION['locale'] = $data['locale'];
        }

        $redirectUrl = $_SERVER['HTTP_REFERER'] ?? '/';
        header('Location: ' . $currentPage);
        exit();
    }
}
