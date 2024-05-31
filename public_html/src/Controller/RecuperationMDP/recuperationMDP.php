<?php

declare(strict_types=1);

namespace App\Controller\PasswordRecovery;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class PasswordRecoveryController extends Controller {
    public function index($data = []): void
    {
        $this->webRender('public/passwordRecovery/' . self::INDEX, [
            'title' => 'Password Recovery',
            'content' => 'Welcome to the password recovery page',
            'cookieSet' => CookieHandler::isCookieSet(),
        ]);
    }

    public function recoverPassword(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            // Logique de récupération du mot de passe, envoi de l'email, etc.
            // Redirigez vers une page de confirmation ou affichez un message de succès.
            header('Location: /password-recovery-confirmation');
        } else {
            $this->webRender('public/passwordRecovery/' . self::INDEX, [
                'title' => 'Password Recovery',
                'content' => 'Welcome to the password recovery page',
                'cookieSet' => CookieHandler::isCookieSet(),
            ]);
        }
    }
}
