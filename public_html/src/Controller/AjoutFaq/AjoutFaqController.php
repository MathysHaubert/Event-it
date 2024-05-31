<?php

namespace App\Controller\AjoutFaq;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

$servername = "http://176.147.224.139:8899/";
$username = "event-it";
$password = "password-for-event-it";
$dbname = "event-API";

$conn = new mysqli($servername, $username, $password, $dbname);

class AjoutFaqController extends Controller {
    public function index($data = []): void
    {
        require_once 'public_html/vendor/autoload.php';




if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT question, answer FROM faq";
$result = $conn->query($sql);

$faq = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $faq[] = $row;
    }
}

$conn->close();

echo $twig->render('index.html.twig', ['faqs' => $faq]);
        }
}



?>