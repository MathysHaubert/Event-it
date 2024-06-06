<?php

namespace App\Tools\Email;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EmailChek
{
    public function sendVerify($email):void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $mail = new PHPMailer(true);

            try {
                // Configuration de l'envoi
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->Username = 'rayenkhader123@gmail.com';
                $mail->Password = 'ayhz ktev dzcu byra';
                $code = $this->getRandomStringRandomInt();
                $_SESSION['verifyEmail_code'] = $code;
                // Destinataire
                $mail->setFrom( 'rayenkhader123@gmail.com' , 'Sonotech');
                $mail->addAddress($email);

                // Contenu
                $mail->isHTML(true);
                $mail->Subject = "Verification Email";
                $mail->Body = "Here your code:\n".$code;

                // Envoi du mail
                $mail->send();
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }

            $subject = 'Sujet';
            $message = 'Bonjour, ceci est un email de test.';
            $headers = 'From: webmaster@example.com' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        }
    }

    public function getRandomStringRandomInt($length = 6): string
    {
        $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pieces = [];
        $max = mb_strlen($stringSpace, '8bit') - 1;
        for ($i = 0; $i < $length; ++ $i) {
            $pieces[] = $stringSpace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}
