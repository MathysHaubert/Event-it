<?php

namespace App\Controller\Contact;

use App\Controller\Controller;
use App\Cookie\CookieHandler;

class ContactController extends Controller {
    public function index($data = []): void
    {
        $this->webRender('public/contactPage/' . self::INDEX, [
            'title' => 'Contact',
        ]);
        }
}
