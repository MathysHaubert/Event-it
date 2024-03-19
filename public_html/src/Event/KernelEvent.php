<?php

declare(strict_types=1);

namespace App\Event;

class KernelEvent
{
    const PRE_REQUEST = 'pre_request';
    const POST_REQUEST = 'post_request';
    const PRE_RESPONSE = 'pre_response';
    const POST_RESPONSE = 'post_response';

    private $eventManager;

    public function __construct($eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function preRequest()
    {
        $this->eventManager->dispatchEvent(self::PRE_REQUEST);
    }

    public function postRequest()
    {
        $this->eventManager->dispatchEvent(self::POST_REQUEST);
    }

    public function preResponse()
    {
        $this->eventManager->dispatchEvent(self::PRE_RESPONSE);
    }

    public function postResponse()
    {
        $this->eventManager->dispatchEvent(self::POST_RESPONSE);
    }
}
