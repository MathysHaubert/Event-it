<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class LanguageController extends Controller
{
    public function changeLanguage($data = []): void
    {
        if (isset($_POST['language'])) {
            $_SESSION['locale'] = $_POST['language'];
        }

        error_log("Language changed to: " . $_SESSION['locale']);

        $redirectUrl = $_SERVER['HTTP_REFERER'] ?? '/';
        header('Location: ' . $redirectUrl);
        exit();
    }
}
