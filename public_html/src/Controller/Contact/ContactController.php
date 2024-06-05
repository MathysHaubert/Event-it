<?php
namespace App\Controller\Contact;
use App\Controller\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class ContactController extends Controller {
    public function index($data = []): void {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->submit();
        } else {
            $this->webRender('public/contactPage/' . self::INDEX, [
                'title' => 'Contact',
            ]);
        }
    }

    public function submit(): void {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $comment = $_POST['comment'];
        $phone = $_POST['phone'];
        $contactByPhone = isset($_POST['contactByPhone']) ? 1 : 0;

        $filePath = null;
        if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['fileUpload']['tmp_name'];
            $fileName = $_FILES['fileUpload']['name'];
            $uploadDir = 'uploads/';
            $destPath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $filePath = $destPath;
            } else {
                echo "There was an error moving the uploaded file.";
                exit();
            }
        }

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

            // Destinataire
            $mail->setFrom('rayenkhader123@gmail.com', 'Votre Site');
            $mail->addAddress('rayenkhader345@gmail.com');

            // Contenu
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $this->buildEmailBody($firstName, $lastName, $email, $subject, $comment, $phone, $contactByPhone);

            // Envoi du mail
            $mail->send();
            echo $this->showSuccessMessage();
        } catch (Exception $e) {
            echo $this->showErrorMessage();
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    private function buildEmailBody($firstName, $lastName, $email, $subject, $comment, $phone, $contactByPhone): string {
        $body = "Nom: " . $firstName . " " . $lastName . "<br>";
        $body .= "Email: " . $email . "<br>";
        $body .= "Sujet: " . $subject . "<br>";
        $body .= "Commentaire: " . $comment . "<br>";
        $body .= "Téléphone: " . $phone . "<br>";
        $body .= "Contacter par téléphone: " . ($contactByPhone ? "Oui" : "Non") . "<br>";

        return $body;
    }

    private function showSuccessMessage(): string {
        return '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Message envoyé avec succès</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            </head>
            <body>
                <div class="container my-5">
                    <div class="alert alert-success">
                        <h4 class="alert-heading">Merci !</h4>
                        <p>Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.</p>
                        <hr>
                        <p class="mb-0">Vous pouvez <a href="/">retourner à la page d\'accueil</a>.</p>
                    </div>
                </div>
            </body>
            </html>
        ';
    }
    private function showErrorMessage(): string {
        return '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Erreur lors de l\'envoi du message</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            </head>
            <body>
                <div class="container my-5">
                    <div class="alert alert-danger">
                        <h4 class="alert-heading">Erreur !</h4>
                        <p>Une erreur s\'est produite lors de l\'envoi de votre message. Veuillez réessayer plus tard.</p>
                        <hr>
                        <p class="mb-0">Vous pouvez <a href="/">retourner à la page d\'accueil</a>.</p>
                    </div>
                </div>
            </body>
            </html>
        ';
    }
}