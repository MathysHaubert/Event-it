<?php

namespace App\Tools\Email;

class EmailChek
{
    public function sendVerify($to, $subject, $message, $headers): bool
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $to = $email;
            $subject = 'Sujet';
            $message = 'Bonjour, ceci est un email de test.';
            $headers = 'From: webmaster@example.com' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            if(mail($to, $subject, $message, $headers)) {
                echo "Email envoyé avec succès";
            } else {
                echo "L'envoi de l'email a échoué";
            }
        }
        return mail($to, $subject, $message, $headers);
    }
}
