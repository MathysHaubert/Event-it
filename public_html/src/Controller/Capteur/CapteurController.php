<?php

declare(strict_types=1);

namespace App\Controller\Capteur;

use App\Controller\Controller;
use App\Cookie\CookieHandler;
use App\Entity\Capteur\Capteur;

class CapteurController extends Controller{
    public function index($data = []): void
{
    $url = $_SERVER['REQUEST_URI'];
    $urlParts = explode('/', $url);
    $roomId = end($urlParts);
    $currentType = $_POST['capteur'] ?? 'temp';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['capteur'])) {
        $currentType = $_POST['capteur'];
    }

    $capteur = Capteur::getCapteurByRoomId($roomId);

    $capteur = array_filter($capteur, function ($capteur) use ($currentType) {
        return $capteur->getType() === $currentType || $currentType === 'all';
    });

    $lastCurrentValue = 0;
    if (!empty($capteur)) {
        $lastCurrentValue = end($capteur)->getValue();
    }

    $valueList = array_map(function ($capteur) {
        return $capteur->getValue();
    }, $capteur);

    $this->webRender('public/Capteur/' . self::INDEX, [
        'title' => 'Home Page',
        'content' => 'Welcome to the home page',
        'cookieSet' => CookieHandler::isCookieSet(),
        'user' => $_SESSION['user'] ?? '',
        'capteur' => $capteur,
        'lastCurrentValue' => $lastCurrentValue,
        'currentType' => $currentType,
        'valueList' => $valueList,
        'roomId' => $roomId,
        'logged' => isset($_SESSION['user']),
    ]);
}
}
